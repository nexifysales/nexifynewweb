<?php
/**
 * NexiFy EN — Site Header & Navigation (English)
 * Included at the top of every English page in /en/.
 *
 * Variables expected from calling page (optional):
 *   $pageTitle       — <title> tag value (default: site name)
 *   $pageDescription — <meta description> content
 *   $pageCanonical   — canonical URL
 *
 * Assets: all relative paths use ../ to reach project root.
 */

// Load site config (GA4, GSC verification, etc.) if not already loaded
if (!defined('GA_MEASUREMENT_ID')) {
    $configPath = dirname(__DIR__, 2) . '/config.php';
    if (file_exists($configPath)) {
        require_once $configPath;
    }
}

$pageTitle       = $pageTitle       ?? 'NexiFy — Smart Solutions, Fast Results';
$pageDescription = $pageDescription ?? 'Integrated sales, energy, technology and support services for businesses and individuals. One partner, one ecosystem.';
$pageCanonical   = $pageCanonical   ?? 'https://nexify.gr/en/';

// Determine which nav link is active based on current filename
$currentPage = basename($_SERVER['PHP_SELF']);

// Language switcher: compute GR equivalent link (/en/page.php → ../page.php)
$_langPage   = basename($_SERVER['PHP_SELF'], '.php');
$_langGrLink = '../' . $_langPage . '.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#3268ac">
<title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">

<!-- Canonical URL -->
<link rel="canonical" href="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">

<!-- Alternate hreflang: tell search engines GR/EN equivalents -->
<link rel="alternate" hreflang="el" href="<?= htmlspecialchars('https://nexify.gr/' . $_langPage . '.html', ENT_QUOTES, 'UTF-8') ?>">
<link rel="alternate" hreflang="en" href="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">
<link rel="alternate" hreflang="x-default" href="<?= htmlspecialchars('https://nexify.gr/' . $_langPage . '.html', ENT_QUOTES, 'UTF-8') ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= htmlspecialchars($pageCanonical, ENT_QUOTES, 'UTF-8') ?>">
<meta property="og:image" content="https://nexify.gr/logo-nexify.png">
<meta property="og:site_name" content="NexiFy">
<meta property="og:locale" content="en_US">
<meta property="og:locale:alternate" content="el_GR">

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
<link rel="icon" href="../logo-nexify.png">

<!-- Local Fonts (Inter + Poppins, no external CDN) -->
<link rel="preload" href="../fonts/inter-greek.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="../fonts/inter-greek-ext.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="../fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="../fonts/fonts.css">

<!-- Design System CSS (shared with GR site) -->
<link rel="stylesheet" href="../style.css?v=20260527a">
<!-- Responsive Enhancement System -->
<link rel="stylesheet" href="../css/responsive.css?v=20260527a">
<!-- EN overrides: translate CSS-generated content strings to English -->
<style>
  /* Override Greek badge text on .featured price cards */
  .price-card.featured::before { content: 'POPULAR'; }
</style>
</head>
<body>

<header class="site-header" data-testid="site-header">
  <div class="container nav-inner">
    <a href="index.php" class="brand" aria-label="NexiFy" data-testid="nav-logo">
      <img src="../logo-nexify-transparent.png" alt="NexiFy">
    </a>
    <!-- Desktop nav shown inline inside header -->
    <nav id="main-nav" class="main-nav main-nav-desktop" aria-label="Main navigation" data-testid="main-nav-desktop">
      <a href="index.php"
         class="<?= ($currentPage === 'index.php') ? 'active' : '' ?>"
         data-testid="nav-home">Home</a>
      <a href="energy.php"
         class="<?= ($currentPage === 'energy.php') ? 'active' : '' ?>"
         data-testid="nav-energy">Energy</a>
      <a href="ecosystem.php"
         class="<?= ($currentPage === 'ecosystem.php') ? 'active' : '' ?>"
         data-testid="nav-ecosystem">Ecosystem</a>
      <a href="virtual-office.php"
         class="<?= ($currentPage === 'virtual-office.php') ? 'active' : '' ?>"
         data-testid="nav-virtual-office">Virtual Office</a>
      <a href="partners.php"
         class="<?= ($currentPage === 'partners.php') ? 'active' : '' ?>"
         data-testid="nav-partners">Partners</a>
      <a href="careers.php"
         class="<?= ($currentPage === 'careers.php') ? 'active' : '' ?>"
         data-testid="nav-careers">Careers</a>
      <a href="faq.php"
         class="<?= ($currentPage === 'faq.php') ? 'active' : '' ?>"
         data-testid="nav-faq">FAQ</a>
      <a href="contact.php"
         class="btn btn-primary nav-cta btn-sm <?= ($currentPage === 'contact.php') ? 'active' : '' ?>"
         data-testid="nav-contact">Contact</a>
      <!-- Language Switcher -->
      <div class="lang-switcher" data-testid="lang-switcher" aria-label="Language selection">
        <a href="<?= htmlspecialchars($_langGrLink, ENT_QUOTES, 'UTF-8') ?>"
           class="lang-link" hreflang="el" lang="el"
           title="Αλλαγή σε Ελληνικά" data-testid="lang-gr-link">🇬🇷 ΕΛ</a>
        <span class="lang-sep" aria-hidden="true">|</span>
        <span class="lang-active" title="English language">🇬🇧 EN</span>
      </div>
    </nav>
    <button class="menu-toggle"
            aria-label="Open menu"
            aria-expanded="false"
            aria-controls="mobile-nav"
            data-testid="menu-toggle"
            type="button"><span></span></button>
  </div>
</header>

<!-- Mobile nav OUTSIDE <header> — gets root stacking context -->
<nav id="mobile-nav" class="main-nav main-nav-mobile" aria-label="Main navigation" data-testid="main-nav" aria-hidden="true">
  <a href="index.php"
     class="<?= ($currentPage === 'index.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-home">Home</a>
  <a href="energy.php"
     class="<?= ($currentPage === 'energy.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-energy">Energy</a>
  <a href="ecosystem.php"
     class="<?= ($currentPage === 'ecosystem.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-ecosystem">Ecosystem</a>
  <a href="virtual-office.php"
     class="<?= ($currentPage === 'virtual-office.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-virtual-office">Virtual Office</a>
  <a href="partners.php"
     class="<?= ($currentPage === 'partners.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-partners">Partners</a>
  <a href="careers.php"
     class="<?= ($currentPage === 'careers.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-careers">Careers</a>
  <a href="faq.php"
     class="<?= ($currentPage === 'faq.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-faq">FAQ</a>
  <a href="contact.php"
     class="btn btn-primary nav-cta btn-sm <?= ($currentPage === 'contact.php') ? 'active' : '' ?>"
     data-testid="mobile-nav-contact">Contact</a>
  <!-- Language Switcher (mobile) -->
  <div class="lang-switcher" data-testid="mobile-lang-switcher" aria-label="Language selection">
    <a href="<?= htmlspecialchars($_langGrLink, ENT_QUOTES, 'UTF-8') ?>"
       class="lang-link" hreflang="el" lang="el"
       title="Αλλαγή σε Ελληνικά" data-testid="mobile-lang-gr-link">🇬🇷 ΕΛ</a>
    <span class="lang-sep" aria-hidden="true">|</span>
    <span class="lang-active" title="English language">🇬🇧 EN</span>
  </div>
</nav>
