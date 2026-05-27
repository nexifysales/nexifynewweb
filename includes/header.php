<?php
/**
 * NexiFy — Site Header & Navigation
 * Included at the top of every page.
 *
 * Variables expected from calling page (optional):
 *   $pageTitle       — <title> tag value (default: site name)
 *   $pageDescription — <meta description> content
 *   $pageCanonical   — canonical URL
 */

// Load site config (GA4, GSC verification, etc.) if not already loaded
if (!defined('GA_MEASUREMENT_ID')) {
    $configPath = __DIR__ . '/../config.php';
    if (file_exists($configPath)) {
        require_once $configPath;
    }
}

$pageTitle       = $pageTitle       ?? 'NexiFy — Smart Solutions, Fast Results';
$pageDescription = $pageDescription ?? 'Ολοκληρωμένες υπηρεσίες πωλήσεων, ενέργειας, τεχνολογίας και υποστήριξης για επιχειρήσεις και ιδιώτες. Ένας συνεργάτης, ένα οικοσύστημα.';
$pageCanonical   = $pageCanonical   ?? 'https://nexify.gr/';

// Determine which nav link is active based on current filename
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#3268ac">
<title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">

<!-- Canonical URL -->
<link rel="canonical" href="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="https://nexify.gr/logo-nexify.png">
<meta property="og:site_name" content="NexiFy">
<meta property="og:locale" content="el_GR">

<!-- Twitter / X Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta name="twitter:image" content="https://nexify.gr/logo-nexify.png">

<!-- Google Search Console Verification -->
<?php if (defined('GSC_VERIFICATION') && GSC_VERIFICATION !== ''): ?>
<meta name="google-site-verification" content="<?= htmlspecialchars(GSC_VERIFICATION, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>

<!-- Google Analytics 4 (GDPR Consent Mode v2 — fires only after user accepts) -->
<?php require_once __DIR__ . '/analytics.php'; ?>

<!-- Favicon -->
<link rel="icon" href="logo-nexify.png">

<!-- Local Fonts (Inter + Poppins, Greek support, no external CDN) -->
<link rel="preload" href="fonts/inter-greek.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="fonts/inter-greek-ext.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="fonts/fonts.css">

<!-- Design System CSS -->
<link rel="stylesheet" href="style.css?v=20260527a">
<!-- Responsive Enhancement System -->
<link rel="stylesheet" href="css/responsive.css?v=20260527a">
</head>
<body>

<header class="site-header" data-testid="site-header">
  <div class="container nav-inner">
    <a href="index.php" class="brand" aria-label="NexiFy" data-testid="nav-logo">
      <img src="logo-nexify-transparent.png" alt="NexiFy">
    </a>
    <!-- Desktop nav shown inline inside header -->
    <nav id="main-nav" class="main-nav main-nav-desktop" aria-label="Κύρια πλοήγηση" data-testid="main-nav-desktop">
      <a href="index.php"
         class="<?= ($currentPage === 'index.php') ? 'active' : '' ?>"
         data-testid="nav-home">Αρχική</a>
      <a href="energy.php"
         class="<?= ($currentPage === 'energy.php') ? 'active' : '' ?>"
         data-testid="nav-energy">Ενέργεια</a>
      <a href="ecosystem.php"
         class="<?= ($currentPage === 'ecosystem.php') ? 'active' : '' ?>"
         data-testid="nav-ecosystem">Ecosystem</a>
      <a href="virtual-office.php"
         class="<?= ($currentPage === 'virtual-office.php') ? 'active' : '' ?>"
         data-testid="nav-virtual-office">Φορολογική Έδρα</a>
      <a href="partners.php"
         class="<?= ($currentPage === 'partners.php') ? 'active' : '' ?>"
         data-testid="nav-partners">Συνεργάτες</a>
      <a href="careers.php"
         class="<?= ($currentPage === 'careers.php') ? 'active' : '' ?>"
         data-testid="nav-careers">Καριέρα</a>
      <a href="faq.php"
         class="<?= ($currentPage === 'faq.php') ? 'active' : '' ?>"
         data-testid="nav-faq">FAQ</a>
      <a href="contact.php"
         class="btn btn-primary nav-cta btn-sm <?= ($currentPage === 'contact.php') ? 'active' : '' ?>"
         data-testid="nav-contact">Επικοινωνία</a>
    </nav>
    <button class="menu-toggle"
            aria-label="Άνοιγμα μενού"
            aria-expanded="false"
            aria-controls="mobile-nav"
            data-testid="menu-toggle"
            type="button"><span></span></button>
  </div>
</header>

<!-- Mobile nav OUTSIDE <header> — gets root stacking context, not trapped inside header's z-index:100 -->
<nav id="mobile-nav" class="main-nav main-nav-mobile" aria-label="Κύρια πλοήγηση" data-testid="main-nav" aria-hidden="true">
  <a href="index.php"
     class="<?= ($currentPage === 'index.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-home">Αρχική</a>
  <a href="energy.php"
     class="<?= ($currentPage === 'energy.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-energy">Ενέργεια</a>
  <a href="ecosystem.php"
     class="<?= ($currentPage === 'ecosystem.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-ecosystem">Ecosystem</a>
  <a href="virtual-office.php"
     class="<?= ($currentPage === 'virtual-office.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-virtual-office">Φορολογική Έδρα</a>
  <a href="partners.php"
     class="<?= ($currentPage === 'partners.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-partners">Συνεργάτες</a>
  <a href="careers.php"
     class="<?= ($currentPage === 'careers.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-careers">Καριέρα</a>
  <a href="faq.php"
     class="<?= ($currentPage === 'faq.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-faq">FAQ</a>
  <a href="contact.php"
     class="btn btn-primary nav-cta btn-sm <?= ($currentPage === 'contact.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-contact">Επικοινωνία</a>
</nav>
