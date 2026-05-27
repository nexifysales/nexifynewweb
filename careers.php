<?php
/**
 * NexiFy — Καριέρα
 */
$pageTitle       = 'Καριέρα — NexiFy';
$pageDescription = 'Δουλειά στη NexiFy. Tech, sales, operations, AI engineering. Hybrid setup, ευελιξία, ευθύνη από day 1.';
$pageCanonical   = 'https://nexify.gr/careers.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Αρχική</a> · Καριέρα</div>
    <h1>Καριέρα στη <span style="color:var(--c-orange-light)">NexiFy</span></h1>
    <p>Χτίζουμε ένα οικοσύστημα που συνδυάζει πωλήσεις, τεχνολογία και επιχειρηματική σκέψη. Ψάχνουμε ανθρώπους που θέλουν να φτιάξουν κάτι μεγάλο — όχι απλώς να γεμίσουν 9 με 5.</p>
  </div>
</section>

<section class="section" data-testid="careers-why-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Γιατί NexiFy</span>
      <h2>Δεν είμαστε corporate. Δεν είμαστε startup. Είμαστε κάτι ενδιάμεσο.</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card" data-testid="careers-card-responsibility">
        <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>Ευθύνη από day 1</h3>
        <p>Δεν περιμένεις 6 μήνες onboarding. Πιάνεις πραγματικά projects από την πρώτη εβδομάδα.</p>
      </div>
      <div class="card" data-testid="careers-card-stack">
        <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z" fill="currentColor"/></svg></div>
        <h3>Σύγχρονο stack</h3>
        <p>Δουλεύουμε με AI, automation, modern frameworks. Κανείς δεν σου ζητάει να κάνεις χειρωνακτική δουλειά που λύνει ένα script.</p>
      </div>
      <div class="card" data-testid="careers-card-flex">
        <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
        <h3>Ευελιξία</h3>
        <p>Hybrid setup, ευέλικτο ωράριο, αποτέλεσμα-driven. Όχι presenteeism.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="careers-positions-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Open positions</span>
      <h2>Τρέχουσες θέσεις</h2>
      <p class="lead">Δεν βλέπεις τη θέση σου; Στείλε μας έτσι κι αλλιώς το βιογραφικό σου — αν ταιριάζεις με την κουλτούρα μας, βρίσκουμε τρόπο.</p>
    </div>
    <div class="grid grid-2 reveal">
      <div class="card" data-testid="job-card-sales">
        <span class="badge">Sales</span>
        <h3 style="margin-top:14px">Ενεργειακός Σύμβουλος Πωλήσεων</h3>
        <p>Outbound πωλήσεις προγραμμάτων ρεύματος &amp; αερίου σε ιδιώτες και επιχειρήσεις. Bonus structure βάσει αποτελέσματος.</p>
        <a href="contact.php?topic=careers&amp;pos=sales" class="btn btn-outline btn-sm" data-testid="apply-sales-btn">Κάνε αίτηση →</a>
      </div>
      <div class="card" data-testid="job-card-ai">
        <span class="badge badge-blue">Tech</span>
        <h3 style="margin-top:14px">AI / Automation Engineer</h3>
        <p>Χτίζεις voice AI agents, scrapers, automations με Python/Node. LangChain, n8n, Firecrawl, ElevenLabs, Retell.</p>
        <a href="contact.php?topic=careers&amp;pos=ai" class="btn btn-outline btn-sm" data-testid="apply-ai-btn">Κάνε αίτηση →</a>
      </div>
      <div class="card" data-testid="job-card-dev">
        <span class="badge badge-blue">Tech</span>
        <h3 style="margin-top:14px">Full-Stack Developer (Next.js / FastAPI)</h3>
        <p>Web platforms, dashboards, integrations με providers. Next.js, Tailwind, FastAPI, Supabase, Stripe.</p>
        <a href="contact.php?topic=careers&amp;pos=dev" class="btn btn-outline btn-sm" data-testid="apply-dev-btn">Κάνε αίτηση →</a>
      </div>
      <div class="card" data-testid="job-card-cs">
        <span class="badge">Operations</span>
        <h3 style="margin-top:14px">Customer Success / Account Manager</h3>
        <p>Διαχείριση χαρτοφυλακίου B2B πελατών, retention, upsells, καθημερινό σημείο επαφής για τις υπηρεσίες μας.</p>
        <a href="contact.php?topic=careers&amp;pos=cs" class="btn btn-outline btn-sm" data-testid="apply-cs-btn">Κάνε αίτηση →</a>
      </div>
    </div>
  </div>
</section>

<section class="section" data-testid="careers-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Δεν βρήκες ταίρι;</h2>
      <p>Στείλε μας το CV σου με μια σύντομη παράγραφο για το τι σε ενδιαφέρει. Διαβάζουμε όλα τα emails.</p>
      <div class="btn-row center">
        <a href="mailto:hr@nexify.gr?subject=CV — Open application" class="btn btn-primary btn-lg" data-testid="careers-email-btn">✉️ hr@nexify.gr</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
