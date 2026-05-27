<?php
/**
 * NexiFy — Contact Form PHP Handler
 *
 * Accepts POST (JSON or form-encoded) from forms.js
 * Stores submission in DB or falls back to JSON file.
 * Returns JSON { success: true|false, message: "..." }
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// ─── Parse incoming data ─────────────────────────────────────────────────────
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
if (str_contains($contentType, 'application/json')) {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?: [];
} else {
    $data = $_POST;
}

// ─── Honeypot check ──────────────────────────────────────────────────────────
if (!empty($data['_gotcha'])) {
    // Silent drop for bots
    echo json_encode(['success' => true, 'message' => 'OK']);
    exit;
}

// ─── Sanitize & validate ─────────────────────────────────────────────────────
function clean(string $v): string {
    return htmlspecialchars(strip_tags(trim($v)), ENT_QUOTES, 'UTF-8');
}

$name     = clean($data['name']     ?? '');
$email    = filter_var(trim($data['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone    = clean($data['phone']    ?? '');
$topic    = clean($data['topic']    ?? '');
$message  = clean($data['message']  ?? '');
$formType = clean($data['_formType'] ?? 'contact');
$gdpr     = !empty($data['gdpr_consent']) ? 1 : 0;

$errors = [];
if (empty($name))    $errors[] = 'Το όνομα είναι υποχρεωτικό.';
if (!$email)         $errors[] = 'Μη έγκυρη διεύθυνση email.';
if (empty($message)) $errors[] = 'Το μήνυμα είναι υποχρεωτικό.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$ip        = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
$timestamp = date('Y-m-d H:i:s');

// ─── Save to DB ──────────────────────────────────────────────────────────────
$saved = false;
$dbError = '';

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=nexifynewweb_db;charset=utf8mb4',
        'nexifynewweb_user',
        'IC684uwjinsHPZrQ',
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // Create table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS contact_submissions (
        id            INT UNSIGNED    PRIMARY KEY AUTO_INCREMENT,
        name          VARCHAR(200)    NOT NULL,
        email         VARCHAR(255)    NOT NULL,
        phone         VARCHAR(50)     DEFAULT '',
        topic         VARCHAR(100)    DEFAULT '',
        message       TEXT            NOT NULL,
        form_type     VARCHAR(50)     DEFAULT 'contact',
        gdpr_consent  TINYINT(1)      DEFAULT 0,
        ip_address    VARCHAR(45)     DEFAULT '',
        created_at    TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_email (email),
        INDEX idx_created (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    $stmt = $pdo->prepare(
        "INSERT INTO contact_submissions (name, email, phone, topic, message, form_type, gdpr_consent, ip_address)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->execute([$name, $email, $phone, $topic, $message, $formType, $gdpr, $ip]);

    $saved = true;
    error_log("[NexiFy] Contact submission saved to DB. ID=" . $pdo->lastInsertId() . " from $name <$email>");

} catch (Exception $e) {
    $dbError = $e->getMessage();
    error_log("[NexiFy] DB error: " . $dbError);
}

// ─── Fallback: save to JSON file ─────────────────────────────────────────────
if (!$saved) {
    $dataDir = __DIR__ . '/../data';
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    $file = $dataDir . '/contact_submissions.json';

    // Load existing
    $submissions = [];
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $submissions = json_decode($content, true) ?: [];
    }

    // Append new submission
    $submissions[] = [
        'id'           => count($submissions) + 1,
        'name'         => $name,
        'email'        => $email,
        'phone'        => $phone,
        'topic'        => $topic,
        'message'      => $message,
        'form_type'    => $formType,
        'gdpr_consent' => (bool)$gdpr,
        'ip_address'   => $ip,
        'created_at'   => $timestamp,
    ];

    if (file_put_contents($file, json_encode($submissions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
        $saved = true;
        error_log("[NexiFy] Contact submission saved to JSON file from $name <$email>");
    } else {
        error_log("[NexiFy] Failed to save submission to JSON file!");
    }
}

// ─── Try to send notification email (best effort) ────────────────────────────
$emailTo      = 'info@nexify.gr';
$emailSubject = '[NexiFy] Νέο μήνυμα από ' . $name . ' — ' . ($topic ?: 'Επικοινωνία');
$emailBody    = "Νέο μήνυμα από τη φόρμα επικοινωνίας:\n\n"
    . "Όνομα:    $name\n"
    . "Email:    $email\n"
    . "Τηλέφωνο: $phone\n"
    . "Θέμα:     $topic\n"
    . "Μήνυμα:\n$message\n\n"
    . "---\n"
    . "Φόρμα:    $formType\n"
    . "Ημερομηνία: $timestamp\n"
    . "IP:       $ip\n";

$headers = implode("\r\n", [
    'From: noreply@nexify.gr',
    'Reply-To: ' . $email,
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'X-Mailer: NexiFy Contact Form',
]);

@mail($emailTo, $emailSubject, $emailBody, $headers);

// ─── Response ────────────────────────────────────────────────────────────────
if ($saved) {
    echo json_encode([
        'success' => true,
        'message' => 'Το μήνυμά σας ελήφθη. Θα σας απαντήσουμε σε 1 εργάσιμη ημέρα.',
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Σφάλμα κατά την αποθήκευση. Παρακαλώ επικοινωνήστε μαζί μας στο info@nexify.gr.',
    ]);
}
