<?php
/**
 * NexiFy EN — Homepage (index.php)
 * English version of /index.php
 */

$pageTitle       = 'NexiFy — Smart Solutions, Fast Results';
$pageDescription = 'Integrated sales, energy, technology and support services for businesses and individuals. One partner, one ecosystem.';
$pageCanonical   = 'https://nexify.gr/en/index.php';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ==================== HERO ==================== -->
<section class="hero" data-testid="hero-section">
  <div class="container hero-grid">
    <div class="reveal">
      <span class="eyebrow">Smart Solutions · Fast Results</span>
      <h1>One <span class="accent">partner</span>.<br>One complete <span class="accent">ecosystem</span>.</h1>
      <p class="lead">NexiFy brings together in a single contact: energy sales, call centre, technology solutions and business support — for professionals, companies and individuals who want to save time and money.</p>
      <div class="btn-row mt-3">
        <a href="energy.php" class="btn btn-primary btn-lg" data-testid="hero-btn-energy">Compare electricity &amp; gas →</a>
        <a href="ecosystem.php" class="btn btn-outline btn-lg" data-testid="hero-btn-ecosystem">Explore the Ecosystem</a>
      </div>
      <div class="hero-stats">
        <div class="stat"><div class="num">5</div><div class="lab">Service pillars</div></div>
        <div class="stat"><div class="num">1</div><div class="lab">Single point of contact</div></div>
        <div class="stat"><div class="num">100%</div><div class="lab">Delivery accountability</div></div>
      </div>
    </div>
    <div class="hero-visual reveal">
      <div class="hero-visual-inner">
        <span class="badge">Energy</span>
        <h3 style="margin-top:14px">Compare all providers in 30 seconds</h3>
        <p style="font-size:.95rem">Electricity &amp; natural gas · Residential &amp; business · Home, shop, office</p>
        <div style="margin-top:auto;display:flex;justify-content:space-between;align-items:flex-end">
          <div>
            <div style="font-size:.85rem;color:var(--c-muted)">Potential savings</div>
            <div style="font-family:var(--font-display);font-size:2.4rem;font-weight:800;color:var(--c-orange);line-height:1">up to 40%</div>
          </div>
          <a href="energy.php" class="btn btn-primary btn-sm" data-testid="hero-card-start-btn">Start →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==================== PARTNERS ==================== -->
<section class="section section-soft" data-testid="partners-section">
  <div class="container">
    <div class="text-center reveal" style="margin-bottom:50px">
      <span class="eyebrow">Technology partners</span>
      <h2 style="max-width:780px;margin:0 auto">We work with established technology partners</h2>
      <p class="lead mt-2">Ready-built infrastructure — you get production-grade tools from day 1.</p>
    </div>
    <div class="partners-logos reveal">
      <div class="partner-logo"><img src="../partner-oxygen.png" alt="Oxygen — Certified Reseller" loading="lazy"></div>
      <div class="partner-logo"><img src="../partner-c2.png" alt="C2 Cloud Concept" loading="lazy"></div>
      <div class="partner-logo"><img src="../partner-mynext.png" alt="MyNext" loading="lazy"></div>
      <div class="partner-logo"><img src="../partner-mynext-market.png" alt="MyNext Market" loading="lazy"></div>
      <div class="partner-logo"><img src="../partner-codehero.png" alt="CodeHero PRO" loading="lazy"></div>
    </div>
  </div>
</section>

<!-- ==================== 5 PILLARS ==================== -->
<section class="section" data-testid="pillars-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:760px;margin:0 auto 60px">
      <span class="eyebrow">5 Pillars, 1 Partner</span>
      <h2>Everything a business needs — in one ecosystem.</h2>
      <p class="lead">Not everyone needs everything. You choose what fits. We guarantee they work together.</p>
    </div>
    <div class="grid grid-3 reveal">
      <div class="pillar">
        <div class="pillar-num">01</div>
        <h3>Energy</h3>
        <p>Electricity &amp; natural gas contracts for individuals, professionals and businesses. Compare all providers in seconds.</p>
        <a href="energy.php" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-energy">Compare →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">02</div>
        <h3>Call Centre</h3>
        <p>Organised outbound call centre for boosting sales and professional customer communication. AI-enabled, multilingual, scalable.</p>
        <a href="ecosystem.php#callcenter" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-callcenter">Learn More →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">03</div>
        <h3>Technology &amp; Infrastructure</h3>
        <p>CRM, ERP, WMS, Cloud Hosting, AI Development. Compatible with tax authorities, digital employee card, soft POS — all plug-and-play.</p>
        <a href="ecosystem.php#tech" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-tech">Learn More →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">04</div>
        <h3>Registered Address</h3>
        <p>Legal professional business address. Meeting room. Ideal for startups &amp; freelancers.</p>
        <a href="virtual-office.php" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-virtual-office">Packages →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">05</div>
        <h3>Corporate Presence</h3>
        <p>Corporate website creation, brand identity, sales support &amp; administrative operations. Not an e-shop.</p>
        <a href="ecosystem.php#presence" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-presence">Learn More →</a>
      </div>
      <div class="pillar">
        <div class="pillar-num">+</div>
        <h3>Partners</h3>
        <p>Expand your service portfolio without investment. We provide the backbone — you own the client relationship.</p>
        <a href="partners.php" class="btn btn-outline btn-sm mt-3" data-testid="pillar-btn-partners">See how →</a>
      </div>
    </div>
  </div>
</section>

<!-- ==================== WHY NEXIFY ==================== -->
<section class="section section-soft" data-testid="why-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Why NexiFy</span>
      <h2>Less complexity. More results.</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z" fill="currentColor"/>
          </svg>
        </div>
        <h3>One point of contact</h3>
        <p>You don't need 5 different partners. One phone, one email, one account manager — for everything.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>
          </svg>
        </div>
        <h3>Speed of delivery</h3>
        <p>Ready infrastructure and processes mean an immediate start. A few hours for simple projects, a few days for more complex ones.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 12h4l3-9 4 18 3-9h4"/>
          </svg>
        </div>
        <h3>Transparent pricing</h3>
        <p>Clear fees, no hidden setup costs. You pay for what you use, with no commitment to fixed packages.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
          </svg>
        </div>
        <h3>Scalability</h3>
        <p>From a sole trader to a chain of stores or a multi-site company. The infrastructure adapts — not the other way around.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <h3>Coordination accountability</h3>
        <p>You don't have to coordinate 5 providers yourself. We take ownership of coordination and delivery.</p>
      </div>
      <div class="card">
        <div class="card-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
        <h3>Pilot-first approach</h3>
        <p>We always start with a small, controlled scope. We scale when we deliver results — not before.</p>
      </div>
    </div>
  </div>
</section>

<!-- ==================== CTA BOX ==================== -->
<section class="section" data-testid="cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <span class="eyebrow" style="color:#fff">Get started</span>
      <h2>Tell us what you need. We'll call you within 1 business day.</h2>
      <p class="lead" style="max-width:540px;margin:0 auto 30px">A brief needs discussion, no commitments, no generic packages — just to see if and how we can help.</p>
      <div class="btn-row center">
        <a href="contact.php" class="btn btn-primary btn-lg" data-testid="cta-contact-btn">Start a conversation →</a>
        <a href="tel:+302109996300" class="btn btn-ghost btn-lg" data-testid="cta-phone-btn">📞 210 999 6300</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
