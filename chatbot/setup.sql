-- ============================================================
-- NexiFy Chatbot Knowledge Base — Database Setup
-- Run this when MySQL access is granted
-- Database: nexifynewweb_db
-- ============================================================

-- Table: kb_categories
CREATE TABLE IF NOT EXISTS `kb_categories` (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `slug` VARCHAR(50) NOT NULL UNIQUE,
  `name_el` VARCHAR(100) NOT NULL,
  `name_en` VARCHAR(100) NOT NULL,
  `icon` VARCHAR(10) DEFAULT NULL,
  `sort_order` TINYINT UNSIGNED DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: kb_articles (Knowledge Base entries)
CREATE TABLE IF NOT EXISTS `kb_articles` (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `category_slug` VARCHAR(50) NOT NULL,
  `question_el` TEXT NOT NULL,
  `answer_el` TEXT NOT NULL,
  `question_en` TEXT DEFAULT NULL,
  `answer_en` TEXT DEFAULT NULL,
  `keywords` JSON DEFAULT NULL COMMENT 'Array of search keywords',
  `priority` TINYINT UNSIGNED DEFAULT 5 COMMENT '1=highest, 10=lowest',
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_category (category_slug),
  INDEX idx_priority (priority),
  INDEX idx_active (is_active),
  FOREIGN KEY (category_slug) REFERENCES kb_categories(slug) ON DELETE CASCADE ON UPDATE CASCADE,
  FULLTEXT KEY ft_question_answer (question_el, answer_el)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: chatbot_conversations (Log chatbot interactions)
CREATE TABLE IF NOT EXISTS `chatbot_conversations` (
  `id` BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `session_id` CHAR(36) NOT NULL COMMENT 'UUID session',
  `user_message` TEXT NOT NULL,
  `bot_response` TEXT DEFAULT NULL,
  `matched_article_id` INT UNSIGNED DEFAULT NULL,
  `confidence_score` TINYINT UNSIGNED DEFAULT 0,
  `language` CHAR(2) DEFAULT 'el',
  `page_source` VARCHAR(100) DEFAULT NULL COMMENT 'Page where chatbot was used',
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_session (session_id),
  INDEX idx_created (created_at),
  FOREIGN KEY (matched_article_id) REFERENCES kb_articles(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Seed data: Categories
-- ============================================================

INSERT INTO `kb_categories` (slug, name_el, name_en, icon, sort_order) VALUES
('general',       'Γενικά',                     'General',              '🏢', 1),
('energy',        'Ενέργεια',                   'Energy',               '⚡', 2),
('virtual_office','Φορολογική Έδρα',            'Virtual Office',       '🏛️', 3),
('technology',    'Τεχνολογία & Υποδομή',       'Technology',           '💻', 4),
('call_center',   'Τηλεφωνικό Κέντρο',          'Call Center',          '📞', 5),
('partners',      'Συνεργάτες',                  'Partners',             '🤝', 6),
('careers',       'Καριέρα',                     'Careers',              '👔', 7);

-- ============================================================
-- Seed data: Knowledge Base Articles (from FAQ)
-- ============================================================

INSERT INTO `kb_articles` (category_slug, question_el, answer_el, keywords, priority) VALUES

-- General
('general', 'Τι ακριβώς είναι η NexiFy;',
'Η NexiFy είναι ο συνδυασμός call center, εταιρείας ενέργειας και IT — με μη κλασικό τρόπο. Λειτουργούμε ως ενιαίος συνεργάτης που καλύπτει πωλήσεις, τεχνολογία και υποστήριξη, ώστε ο πελάτης να μη χρειάζεται να συντονίζει πολλούς διαφορετικούς παρόχους.',
'["nexify", "τι είναι", "εταιρεία", "υπηρεσίες"]', 1),

('general', 'Γιατί να μη συνεργαστώ ξεχωριστά με ειδικούς;',
'Μπορείς. Αλλά συνήθως: (1) δεν μιλάνε μεταξύ τους, (2) δεν υπάρχει ένας υπεύθυνος, (3) χάνεται χρόνος και χρήμα στους συντονισμούς. Εμείς αναλαμβάνουμε τον συντονισμό και την ευθύνη delivery.',
'["γιατί", "ξεχωριστά", "συντονισμός", "πλεονέκτημα"]', 2),

('general', 'Θα πληρώνω περισσότερα;',
'Συνήθως το αντίθετο. Επειδή τα περισσότερα services είναι ήδη οργανωμένα, ο πελάτης πληρώνει μόνο ό,τι χρειάζεται — χωρίς κόστος setup ή πειραματισμού.',
'["τιμή", "κόστος", "ακριβό", "πληρώ", "πόσο"]', 2),

('general', 'Αν χρειαστώ μόνο μία υπηρεσία;',
'Κανένα πρόβλημα. Πολλοί πελάτες ξεκινούν από ένα κομμάτι (π.χ. ενέργεια ή website) και βλέπουμε στην πορεία αν χρειάζεται κάτι επιπλέον. Δεν υπάρχει δέσμευση για «πακέτα».',
'["μία υπηρεσία", "μόνο", "δέσμευση", "πακέτο"]', 3),

('general', 'Πόσο γρήγορα μπορούμε να ξεκινήσουμε;',
'Εξαρτάται από την υπηρεσία. Σε αρκετές περιπτώσεις ξεκινάμε άμεσα. Σε πιο σύνθετες ανάγκες μιλάμε για λίγες ημέρες έως εβδομάδες.',
'["έναρξη", "γρήγορα", "πότε", "χρόνος"]', 3),

-- Energy
('energy', 'Τι κερδίζω αλλάζοντας πάροχο μέσω NexiFy;',
'Συγκρίνουμε όλους τους παρόχους και διαπραγματευόμαστε το καλύτερο πρόγραμμα για το προφίλ κατανάλωσής σου. Συνήθως μιλάμε για 15-40% εξοικονόμηση σε ετήσια βάση. Δεν χρειάζεται να τηλεφωνήσεις πουθενά — αναλαμβάνουμε τη διαδικασία αλλαγής.',
'["εξοικονόμηση", "αλλαγή παρόχου", "ρεύμα", "φθηνό", "κέρδος"]', 1),

('energy', 'Πληρώνω κάτι για την υπηρεσία σύγκρισης ενέργειας;',
'Όχι. Η σύγκριση είναι δωρεάν. Πληρωνόμαστε από τον πάροχο που τελικά επιλέγεις — σαν agency commission.',
'["δωρεάν", "κόστος", "commission", "τιμή σύγκρισης"]', 1),

('energy', 'Τι είναι ο MR. Revmas;',
'Ο MR. Revmas είναι ένας AI-powered μηχανισμός που ελέγχει 179+ προγράμματα ηλεκτρικής ενέργειας και φυσικού αερίου σε πραγματικό χρόνο. Δίνει τα 3 φθηνότερα προγράμματα ταξινομημένα με ετήσιο κόστος και πιθανή εξοικονόμηση — δωρεάν, χωρίς εγγραφή.',
'["revmas", "mr revmas", "σύγκριση", "πλατφόρμα", "AI"]', 1),

('energy', 'Έχω επιχείρηση με πολλαπλούς μετρητές. Με καλύπτετε;',
'Ναι. Έχουμε εξειδικευμένη ομάδα για επιχειρηματικούς πελάτες, συγκροτήματα γραφείων και πολυ-καταστηματικές αλυσίδες. Διαπραγματευόμαστε corporate συμβόλαια και custom όρους.',
'["επιχείρηση", "πολλαπλοί μετρητές", "corporate", "αλυσίδα"]', 2),

-- Virtual Office
('virtual_office', 'Η φορολογική έδρα είναι νόμιμη;',
'Ναι, απολύτως. Αφορά επιχειρήσεις παροχής υπηρεσιών, με νόμιμη επαγγελματική διεύθυνση. Δεν αφορά εμπορική δραστηριότητα ή αποθήκευση προϊόντων.',
'["νόμιμο", "νομιμότητα", "φορολογική", "legal"]', 1),

('virtual_office', 'Παίρνω πραγματικά την αλληλογραφία μου;',
'Ναι. Λαμβάνουμε όλη την αλληλογραφία στο όνομά σου (συστημένα, εφορία, τράπεζες) και την ψηφιοποιούμε. Σε ενημερώνουμε άμεσα για επείγοντα.',
'["αλληλογραφία", "συστημένο", "εφορία", "mail"]', 2),

('virtual_office', 'Πόσο κοστίζει η φορολογική έδρα;',
'Τα πακέτα: Τρίμηνο 180€, Εξάμηνο 340€, Ετήσιο 500€, Διετές 900€, Πενταετές 2.000€. Καμία κρυφή χρέωση — οι λογαριασμοί κοινής ωφέλειας καλύπτονται.',
'["τιμή", "180", "πακέτο", "τρίμηνο", "κόστος", "500"]', 1),

('virtual_office', 'Πόσο κοστίζει η αίθουσα συνεδριάσεων;',
'2 ώρες: 20€ | 4 ώρες: 35€ | 6 ώρες: 50€ | 8 ώρες (full day): 70€. Χωρητικότητα 8 ατόμων, οθόνη, WiFi.',
'["αίθουσα", "συνεδριάσεων", "meeting room", "τιμή", "booking"]', 2),

-- Technology
('technology', 'Είστε προγραμματιστές ή re-sellers;',
'Και τα δύο. Έχουμε εσωτερική τεχνική ομάδα για custom AI development, automations και integrations. Παράλληλα είμαστε επίσημοι συνεργάτες για Oxygen ERP, MyNext, Pelatologio και Cloud Hosting providers.',
'["προγραμματιστές", "reseller", "custom", "development"]', 1),

('technology', 'Μπορείτε να κάνετε integration με το CRM/ERP μου;',
'Ναι. Δουλεύουμε με HubSpot, Salesforce, Pipedrive, Odoo και τα περισσότερα ελληνικά ERP. Αν δεν υπάρχει έτοιμο integration, χτίζουμε custom API.',
'["crm", "erp", "integration", "hubspot", "salesforce", "pipedrive"]', 2),

-- Partners
('partners', 'Ποιο είναι το μοντέλο συνεργασίας;',
'Revenue share ή commission — πληρώνεσαι μόνο όταν κλείνει η πώληση. Καμία δέσμευση exclusivity, καμία επένδυση σε υποδομές.',
'["revenue share", "commission", "μοντέλο", "συνεργάτης"]', 1),

('partners', 'Σε ποιους απευθύνεται το πρόγραμμα συνεργατών;',
'Σε λογιστικά/συμβουλευτικά γραφεία, δικηγορικά γραφεία, brokers ασφαλειών, real estate professionals, web agencies, IT consultants και freelance advisors.',
'["λογιστής", "δικηγόρος", "broker", "real estate", "agency", "consultant"]', 2),

-- Careers
('careers', 'Τι θέσεις έχετε ανοιχτές;',
'Τρέχουσες θέσεις: (1) Ενεργειακός Σύμβουλος Πωλήσεων, (2) AI/Automation Engineer, (3) Full-Stack Developer (Next.js/FastAPI), (4) Customer Success / Account Manager. Στείλε CV στο hr@nexify.gr για open application.',
'["θέση εργασίας", "πρόσληψη", "developer", "sales", "AI engineer"]', 1);

-- ============================================================
-- View: Full-text search ready view
-- ============================================================

CREATE OR REPLACE VIEW `v_kb_search` AS
SELECT
    a.id,
    c.slug AS category_slug,
    c.name_el AS category_name,
    c.icon AS category_icon,
    a.question_el,
    a.answer_el,
    a.keywords,
    a.priority,
    CONCAT(a.question_el, ' ', a.answer_el) AS search_text
FROM kb_articles a
JOIN kb_categories c ON c.slug = a.category_slug
WHERE a.is_active = 1
ORDER BY a.priority ASC, a.id ASC;
