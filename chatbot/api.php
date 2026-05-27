<?php
/**
 * NexiFy Chatbot Knowledge Base API
 *
 * Endpoints:
 *   GET  ?action=search&q=...        — keyword search
 *   GET  ?action=category&cat=...    — entries by category
 *   GET  ?action=all                 — full knowledge base
 *   GET  ?action=faq                 — all FAQ entries
 *   GET  ?action=service&name=...    — specific service info
 *   GET  ?action=contact             — contact information
 *   POST ?action=chat                — chatbot query (returns best answer)
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Load knowledge base
$kbFile = __DIR__ . '/knowledge-base.json';
if (!file_exists($kbFile)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Knowledge base not found']);
    exit;
}

$kb = json_decode(file_get_contents($kbFile), true);
if (!$kb) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Knowledge base parse error']);
    exit;
}

$action = $_GET['action'] ?? 'search';

switch ($action) {
    case 'all':
        echo json_encode(['success' => true, 'data' => $kb]);
        break;

    case 'faq':
        $category = $_GET['category'] ?? null;
        $faqs = $kb['faq'];
        if ($category) {
            $faqs = array_values(array_filter($faqs, fn($f) => $f['category'] === $category));
        }
        echo json_encode(['success' => true, 'count' => count($faqs), 'data' => $faqs]);
        break;

    case 'category':
        $cat = strtolower(trim($_GET['cat'] ?? ''));
        if (!$cat) {
            echo json_encode(['success' => false, 'error' => 'Missing category parameter']);
            break;
        }
        $results = array_values(array_filter($kb['faq'], fn($f) => $f['category'] === $cat));
        echo json_encode(['success' => true, 'category' => $cat, 'count' => count($results), 'data' => $results]);
        break;

    case 'service':
        $name = strtolower(trim($_GET['name'] ?? ''));
        if (!$name) {
            echo json_encode(['success' => false, 'error' => 'Missing service name']);
            break;
        }
        $services = $kb['services'] ?? [];
        if (isset($services[$name])) {
            echo json_encode(['success' => true, 'data' => $services[$name]]);
        } else {
            // Try partial match
            foreach ($services as $key => $svc) {
                if (str_contains($key, $name) || str_contains($name, $key)) {
                    echo json_encode(['success' => true, 'service_key' => $key, 'data' => $svc]);
                    exit;
                }
            }
            echo json_encode(['success' => false, 'error' => 'Service not found', 'available' => array_keys($services)]);
        }
        break;

    case 'contact':
        echo json_encode(['success' => true, 'data' => $kb['company']['contact'] ?? []]);
        break;

    case 'company':
        echo json_encode(['success' => true, 'data' => $kb['company'] ?? []]);
        break;

    case 'search':
    case 'chat':
        $query = '';

        // Support both GET and POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            $query = strtolower(trim($body['q'] ?? $body['query'] ?? $body['message'] ?? ''));
        } else {
            $query = strtolower(trim($_GET['q'] ?? $_GET['query'] ?? ''));
        }

        if (!$query) {
            echo json_encode(['success' => false, 'error' => 'Missing query parameter (q or query)']);
            break;
        }

        $results = searchKnowledgeBase($kb, $query);

        if ($action === 'chat') {
            // Return chatbot-formatted response
            $response = buildChatResponse($kb, $query, $results);
            echo json_encode(['success' => true, 'query' => $query, 'response' => $response, 'sources' => $results]);
        } else {
            echo json_encode(['success' => true, 'query' => $query, 'count' => count($results), 'results' => $results]);
        }
        break;

    default:
        echo json_encode([
            'success' => false,
            'error' => 'Unknown action',
            'available_actions' => ['all', 'faq', 'category', 'service', 'contact', 'company', 'search', 'chat']
        ]);
}

/**
 * Search the knowledge base for relevant entries
 */
function searchKnowledgeBase(array $kb, string $query): array {
    $results = [];
    $queryWords = array_filter(explode(' ', $query), fn($w) => strlen($w) > 2);

    // Search FAQ
    foreach ($kb['faq'] as $faq) {
        $score = scoreEntry($faq['question'] . ' ' . $faq['answer'] . ' ' . implode(' ', $faq['keywords']), $queryWords, $query);
        if ($score > 0) {
            $results[] = [
                'type' => 'faq',
                'id' => $faq['id'],
                'category' => $faq['category'],
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'score' => $score
            ];
        }
    }

    // Search services
    foreach ($kb['services'] as $serviceKey => $service) {
        $searchText = $service['name'] . ' ' . $service['description'];

        // Add features/benefits to search text
        if (!empty($service['features'])) {
            $searchText .= ' ' . implode(' ', $service['features']);
        }
        if (!empty($service['benefits'])) {
            $searchText .= ' ' . implode(' ', $service['benefits']);
        }
        if (!empty($service['solutions'])) {
            foreach ($service['solutions'] as $sol) {
                $searchText .= ' ' . $sol['name'] . ' ' . $sol['description'];
            }
        }

        $score = scoreEntry($searchText, $queryWords, $query);
        if ($score > 0) {
            $results[] = [
                'type' => 'service',
                'service_key' => $serviceKey,
                'name' => $service['name'],
                'description' => $service['description'],
                'page_url' => $service['page_url'] ?? null,
                'score' => $score
            ];
        }
    }

    // Search company info
    $companyText = $kb['company']['name'] . ' ' . $kb['company']['description'] . ' ' . implode(' ', $kb['company']['key_messages']);
    $companyScore = scoreEntry($companyText, $queryWords, $query);
    if ($companyScore > 0) {
        $results[] = [
            'type' => 'company',
            'data' => [
                'name' => $kb['company']['name'],
                'description' => $kb['company']['description'],
                'contact' => $kb['company']['contact'],
                'address' => $kb['company']['address']
            ],
            'score' => $companyScore
        ];
    }

    // Sort by score descending
    usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

    return array_slice($results, 0, 5);
}

/**
 * Score relevance of text to query
 */
function scoreEntry(string $text, array $queryWords, string $fullQuery): int {
    $text = strtolower($text);
    $score = 0;

    // Exact phrase match (highest score)
    if (str_contains($text, $fullQuery)) {
        $score += 20;
    }

    // Individual word matches
    foreach ($queryWords as $word) {
        if (str_contains($text, $word)) {
            $score += 3;
        }
    }

    // Greek transliteration helpers (common search patterns)
    $transliterations = [
        'energy' => 'ενέργεια ρεύμα αέριο',
        'office' => 'γραφείο έδρα virtual',
        'call center' => 'τηλεφωνικό κέντρο',
        'price' => 'τιμή κόστος τιμολόγιο',
        'cheap' => 'φθηνό εξοικονόμηση',
        'crm' => 'crm erp τεχνολογία',
        'partner' => 'συνεργάτης συνεργασία',
        'career' => 'καριέρα θέση εργασία',
        'contact' => 'επικοινωνία τηλέφωνο email'
    ];

    foreach ($transliterations as $en => $gr) {
        if (str_contains($fullQuery, $en)) {
            if (str_contains($text, $gr) || str_contains($text, $en)) {
                $score += 5;
            }
        }
    }

    return $score;
}

/**
 * Build a chatbot-friendly response from search results
 */
function buildChatResponse(array $kb, string $query, array $results): array {
    $lang = detectLanguage($query);

    if (empty($results)) {
        return [
            'message' => $kb['chatbot_responses']['fallback'][$lang] ?? $kb['chatbot_responses']['fallback']['el'],
            'type' => 'fallback',
            'suggestions' => [
                'Πληροφορίες για ενέργεια',
                'Φορολογική έδρα τιμές',
                'Επικοινωνία NexiFy',
                'Υπηρεσίες τεχνολογίας'
            ]
        ];
    }

    $top = $results[0];
    $message = '';
    $links = [];

    if ($top['type'] === 'faq') {
        $message = $top['answer'];
        // Add page link based on category
        $categoryUrls = [
            'energy' => 'energy.php',
            'virtual_office' => 'virtual-office.php',
            'technology' => 'ecosystem.php#tech',
            'partners' => 'partners.php',
            'general' => 'contact.php'
        ];
        if (isset($categoryUrls[$top['category']])) {
            $links[] = ['label' => 'Μάθε περισσότερα', 'url' => $categoryUrls[$top['category']]];
        }
    } elseif ($top['type'] === 'service') {
        $message = $top['name'] . ': ' . $top['description'];
        if ($top['page_url']) {
            $links[] = ['label' => 'Δες περισσότερα', 'url' => $top['page_url']];
        }
    } elseif ($top['type'] === 'company') {
        $message = $kb['company']['description'];
        $links[] = ['label' => 'Δες το Ecosystem', 'url' => 'ecosystem.php'];
        $links[] = ['label' => 'Επικοινωνία', 'url' => 'contact.php'];
    }

    // Add contact CTA if multiple results
    if (count($results) >= 2) {
        $links[] = ['label' => 'Μίλα με σύμβουλο', 'url' => 'contact.php'];
    }

    return [
        'message' => $message,
        'type' => $top['type'],
        'confidence' => min(100, $top['score'] * 5),
        'links' => $links,
        'related' => array_map(fn($r) => [
            'question' => $r['question'] ?? $r['name'] ?? '',
            'type' => $r['type']
        ], array_slice($results, 1, 3))
    ];
}

/**
 * Detect language from query
 */
function detectLanguage(string $text): string {
    // Simple heuristic: if it contains Greek characters, it's Greek
    return preg_match('/[\x{0370}-\x{03FF}\x{1F00}-\x{1FFF}]/u', $text) ? 'el' : 'en';
}
