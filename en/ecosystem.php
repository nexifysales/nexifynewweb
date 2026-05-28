<?php
/**
 * NexiFy EN — Ecosystem
 * English version of /ecosystem.php
 */
$pageTitle       = 'Service Ecosystem — NexiFy';
$pageDescription = 'Comprehensive ecosystem of business services: energy, call centre, CRM/ERP, cloud hosting, AI development, corporate presence.';
$pageCanonical   = 'https://nexify.gr/en/ecosystem.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Ecosystem</div>
    <h1>
      <!-- Desktop: full title. Mobile: shorter title that fits on 1 line -->
      <span class="title-desktop">One <span style="color:var(--c-orange-light)">ecosystem</span> of services — not a package</span>
      <span class="title-mobile">Service <span style="color:var(--c-orange-light)">Ecosystem</span></span>
    </h1>
    <p>We bring together under one roof services that usually require 5+ different partners. You choose what you need, when you need it.</p>
  </div>
</section>

<section class="section" id="energy" data-testid="pillar-energy-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Pillar 01</span>
        <h2>Energy — electricity &amp; natural gas</h2>
        <p class="lead">Electricity and natural gas contracts for:</p>
        <ul class="list-check">
          <li><b>Individuals</b> — residential &amp; professional tariffs</li>
          <li><b>Businesses</b> — single meter to chain of stores</li>
          <li><b>Multi-site chains</b> &amp; office complexes</li>
        </ul>
        <p>Comparison of all major Greek energy and gas providers, negotiation and completion of the switch — all through the <a href="energy.php">MR. Revmas comparison engine</a>.</p>
        <a href="energy.php" class="btn btn-primary mt-3" data-testid="pillar-energy-btn">Compare programmes →</a>
      </div>
      <div class="reveal">
        <div class="card-blue card">
          <h3>What the client gains</h3>
          <ul class="list-check" style="color:#fff">
            <li>Up to 40% cost reduction</li>
            <li>Professional price negotiation</li>
            <li>One contract per installation</li>
            <li>Consumption &amp; cost reporting</li>
            <li>Annual review at no charge</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" id="callcenter" data-testid="pillar-callcenter-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="card-blue card reveal" style="order:2">
        <h3>Call centre use cases</h3>
        <ul class="list-check" style="color:#fff">
          <li>Outbound sales for energy programmes</li>
          <li>Lead qualification &amp; appointment setting</li>
          <li>Professional customer communication</li>
          <li>Customer retention &amp; satisfaction</li>
          <li>Product &amp; service information</li>
        </ul>
      </div>
      <div class="reveal" style="order:1">
        <span class="eyebrow">Pillar 02</span>
        <h2>Call Centre &amp; Sales Support</h2>
        <p class="lead">Organised outbound call centre for businesses that want to grow sales without building an internal team.</p>
        <p>We combine <b>experienced agents</b> with <b>AI-powered tools</b> to maximise conversion and reduce cost-per-call.</p>
        <ul class="list-check">
          <li>Multilingual: Greek &amp; English</li>
          <li>CRM integration (HubSpot, Salesforce, Pipedrive)</li>
          <li>Call analytics &amp; recording</li>
          <li>Scaling 10 → 10,000 calls/day</li>
        </ul>
        <a href="contact.php?topic=callcenter" class="btn btn-primary mt-3" data-testid="callcenter-contact-btn">Start a conversation →</a>
      </div>
    </div>
  </div>
</section>

<section class="section" id="tech" data-testid="pillar-tech-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:760px;margin:0 auto 50px">
      <span class="eyebrow">Pillar 03</span>
      <h2>Technology &amp; Infrastructure</h2>
      <p class="lead">Modern technology solutions, tailored to each business's needs. All fully compliant with Greek tax authority (AADE) &amp; myDATA.</p>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card"><h3>Oxygen ERP / CRM</h3><p>Online organisation &amp; electronic invoicing. Full technical support, free upgrades, AADE compliance.</p></div>
      <div class="card"><h3>Cloud Cash Register</h3><p>Point-of-sale on mobile, tablet or PC. No Z-reports, no consumables, no maintenance.</p></div>
      <div class="card"><h3>Provider Services</h3><p>Online receipt issuance &amp; automatic transmission of documents to myDATA.</p></div>
      <div class="card"><h3>Soft POS &amp; Payments</h3><p>Oxygen Payments + Soft POS — turn your smartphone into a POS for contactless card payments.</p></div>
      <div class="card"><h3>Digital Employee Card</h3><p>Time management, leave requests, Digital Work Card operation — all in one app.</p></div>
      <div class="card"><h3>Premium Cloud Hosting</h3><p>Website hosting with 99.9% uptime. Semi-dedicated, reseller, HPC — you choose.</p></div>
      <div class="card"><h3>Managed Kubernetes</h3><p>Outsource up to 100% of IT tasks. 24/7 technical support, auto-heal, disaster redundancy.</p></div>
      <div class="card"><h3>MyNext.io — Logistics</h3><p>Delivery management, real-time tracking, signature/photo proof of delivery, integration with e-shop &amp; ERP.</p></div>
      <div class="card"><h3>CodeHero Pro — AI Dev</h3><p>AI development platform. Anthropic, OpenAI, Gemini, xAI, DeepSeek, Ollama — self-hosted or cloud.</p></div>
    </div>
    <div class="text-center mt-4">
      <a href="contact.php?topic=tech" class="btn btn-outline" data-testid="tech-demo-btn">Request a technology solution demo →</a>
    </div>
  </div>
</section>

<section class="section section-soft" id="virtual-office" data-testid="pillar-virtual-office-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Pillar 04</span>
        <h2>Registered Address &amp; Virtual Office</h2>
        <p class="lead">Legal professional business address for service companies — without renting a physical office.</p>
        <p>Ideal for <b>startups</b>, <b>freelancers</b> and <b>new or growing businesses</b> that want a professional image and administrative infrastructure.</p>
        <ul class="list-check">
          <li>Legal professional business address</li>
          <li>Mail reception &amp; storage</li>
          <li>Meeting room (pay-per-use)</li>
          <li>Corporate landline &amp; mobile number</li>
          <li>Catering available on request</li>
        </ul>
        <a href="virtual-office.php" class="btn btn-primary mt-3" data-testid="virtual-office-btn">Packages &amp; pricing →</a>
      </div>
      <div class="reveal">
        <div class="card">
          <h3>From <span style="color:var(--c-orange);font-family:var(--font-display);font-size:2.4rem;font-weight:800">€180</span></h3>
          <p style="color:var(--c-muted)">per quarter, no hidden costs</p>
          <p>The package includes a legal professional business address, mail management and coverage of all utility bills — no additional charges.</p>
          <a href="virtual-office.php" class="btn btn-outline btn-block">See all packages →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" id="presence" data-testid="pillar-presence-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Pillar 05</span>
      <h2>Corporate presence &amp; administrative support</h2>
      <p class="lead">We build your professional image and handle back-office task management.</p>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card"><h3>Corporate Website</h3><p>Custom design, responsive, SEO-ready. <b>Not an e-shop.</b> One-off cost €500 (excluding domain &amp; hosting).</p></div>
      <div class="card"><h3>Google Business Profile</h3><p>Setup &amp; optimisation of Google profile, Maps, attributes, photos.</p></div>
      <div class="card"><h3>Secretarial Support</h3><p>Document generation, calendar management, meeting scheduling, templates for recurring tasks.</p></div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="ecosystem-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Do you have a specific problem in mind?</h2>
      <p>In a 30-minute conversation we show you which service (or combination) suits you — and what it costs.</p>
      <div class="btn-row center">
        <a href="contact.php" class="btn btn-primary btn-lg" data-testid="ecosystem-cta-btn">Book an appointment →</a>
        <a href="tel:+302109996300" class="btn btn-ghost btn-lg">📞 210 999 6300</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
