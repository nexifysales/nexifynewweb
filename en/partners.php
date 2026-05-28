<?php
/**
 * NexiFy — Partners (English)
 */
$pageTitle       = 'Partners — NexiFy';
$pageDescription = 'Expand your portfolio with NexiFy services. Revenue share model, no infrastructure investment required.';
$pageCanonical   = 'https://nexify.gr/en/partners.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Partners</div>
    <h1>
      <span class="title-desktop">Expand your portfolio, <span style="color:var(--c-orange-light)">without investing in infrastructure</span></span>
      <span class="title-mobile">Become a <span style="color:var(--c-orange-light)">NexiFy Partner</span></span>
    </h1>
    <p>NexiFy operates as a services backbone — you offer your clients comprehensive solutions, while we handle implementation, support and back-office operations.</p>
  </div>
</section>

<section class="section" data-testid="partners-who-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Who it's for</span>
        <h2>For professionals &amp; companies that want more from their clients</h2>
        <p class="lead">We partner with:</p>
        <ul class="list-check">
          <li>Accounting &amp; advisory firms</li>
          <li>Law firms</li>
          <li>Insurance brokers &amp; agents</li>
          <li>Real estate professionals</li>
          <li>Web agencies &amp; IT consultants</li>
          <li>Sales reps &amp; freelance advisors</li>
        </ul>
        <p>Instead of referring your clients to 3–4 different providers, you offer them a <b>fully integrated service under your own brand</b> — or with co-branding.</p>
      </div>
      <div class="reveal">
        <div class="card-blue card">
          <h3>What you gain as a partner</h3>
          <ul class="list-check" style="color:#fff">
            <li>Additional revenue per client</li>
            <li>Strengthened client trust</li>
            <li>Differentiation from the competition</li>
            <li>No development costs</li>
            <li>Revenue share or commission model</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="partners-services-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">What you can offer</span>
      <h2>The entire NexiFy ecosystem — with your own client relationship</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="pillar" data-testid="partner-pillar-energy">
        <div class="pillar-num">⚡</div>
        <h3>Energy</h3>
        <p>Electricity &amp; natural gas, organised sales processes, commission per application.</p>
      </div>
      <div class="pillar" data-testid="partner-pillar-calling">
        <div class="pillar-num">📞</div>
        <h3>Outbound Calling</h3>
        <p>Call centre for campaigns, lead qualification or customer support.</p>
      </div>
      <div class="pillar" data-testid="partner-pillar-tech">
        <div class="pillar-num">💻</div>
        <h3>Tech Stack</h3>
        <p>CRM, ERP, WMS, Cloud Hosting, AI development. In partnership with Oxygen, MyNext, Pelatologio.</p>
      </div>
      <div class="pillar" data-testid="partner-pillar-vo">
        <div class="pillar-num">🏢</div>
        <h3>Registered Office</h3>
        <p>Virtual office &amp; legal address for your clients starting a new business.</p>
      </div>
      <div class="pillar" data-testid="partner-pillar-presence">
        <div class="pillar-num">🌐</div>
        <h3>Corporate Presence</h3>
        <p>Website, Google Business, branding — complete professional presence.</p>
      </div>
      <div class="pillar" data-testid="partner-pillar-backoffice">
        <div class="pillar-num">🛠️</div>
        <h3>Back Office</h3>
        <p>Administrative &amp; secretarial support, document workflows, scheduling.</p>
      </div>
    </div>
  </div>
</section>

<section class="section" data-testid="partners-steps-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">How we get started</span>
      <h2>4 steps from handshake to live clients</h2>
    </div>
    <div class="grid grid-4 reveal">
      <div class="card text-center" data-testid="partners-step-1">
        <div class="pillar-num">1</div>
        <h3>First Contact</h3>
        <p>A 30-minute discussion to understand your client base and their needs.</p>
      </div>
      <div class="card text-center" data-testid="partners-step-2">
        <div class="pillar-num">2</div>
        <h3>Partnership Model</h3>
        <p>We present rev-share / commission options, financials &amp; SLAs.</p>
      </div>
      <div class="card text-center" data-testid="partners-step-3">
        <div class="pillar-num">3</div>
        <h3>Onboarding &amp; Training</h3>
        <p>1–2 days, sales materials, team training, ready-to-use templates.</p>
      </div>
      <div class="card text-center" data-testid="partners-step-4">
        <div class="pillar-num">4</div>
        <h3>Launch &amp; Scaling</h3>
        <p>First clients, weekly reviews, gradual scale-up.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="partners-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Ready to try with no risk?</h2>
      <p>No exclusivity commitment. No investment. You earn commission only when a sale is closed.</p>
      <div class="btn-row center">
        <a href="contact.php?topic=partners" class="btn btn-primary btn-lg" data-testid="partners-contact-btn">Book a Meeting →</a>
        <a href="mailto:sales@nexify.gr" class="btn btn-ghost btn-lg">✉️ sales@nexify.gr</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
