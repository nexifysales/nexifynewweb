<?php
/**
 * NexiFy EN — Registered Address / Virtual Office
 * English version of /virtual-office.php
 */
$pageTitle       = 'Registered Address / Virtual Office — NexiFy';
$pageDescription = 'Legal professional business address for startups and professionals. Packages from €180/quarter.';
$pageCanonical   = 'https://nexify.gr/en/virtual-office.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Registered Address / Virtual Office</div>
    <h1>Registered Address &amp; <span style="color:var(--c-orange-light)">Virtual Office</span></h1>
    <p>The smart choice for businesses, startups and freelancers who want a professional presence without the cost of a physical office.</p>
  </div>
</section>

<section class="section" data-testid="pricing-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Rental packages</span>
      <h2>Choose the duration that suits you</h2>
      <p class="lead">No hidden charges — utility bills are covered by us.</p>
    </div>
    <div class="grid grid-3 reveal" style="padding-top:36px">
      <div class="price-card" data-testid="price-card-3m">
        <h3>Quarterly</h3>
        <div class="price">€180</div>
        <div class="term">all inclusive</div>
        <ul class="list-check">
          <li>Legal professional address</li>
          <li>Mail management</li>
          <li>Utility bills covered</li>
          <li>Trial period</li>
        </ul>
        <a href="../virtual-office-apply.php?plan=3m" class="btn btn-outline btn-block" data-testid="select-3m-btn">Apply Now</a>
      </div>
      <div class="price-card" data-testid="price-card-6m">
        <h3>6 Months</h3>
        <div class="price">€340</div>
        <div class="term">all inclusive</div>
        <ul class="list-check">
          <li>All quarterly benefits</li>
          <li>Greater stability</li>
          <li>Same inclusions</li>
        </ul>
        <a href="../virtual-office-apply.php?plan=6m" class="btn btn-outline btn-block" data-testid="select-6m-btn">Apply Now</a>
      </div>
      <div class="price-card featured" data-testid="price-card-1y">
        <h3>Annual</h3>
        <div class="price">€500</div>
        <div class="term">all inclusive</div>
        <ul class="list-check">
          <li>All previous benefits</li>
          <li>Best price per month</li>
          <li>Priority meeting room bookings</li>
        </ul>
        <a href="../virtual-office-apply.php?plan=1y" class="btn btn-primary btn-block" data-testid="select-1y-btn">Apply Now</a>
      </div>
      <div class="price-card" data-testid="price-card-2y">
        <h3>2-Year</h3>
        <div class="price">€900</div>
        <div class="term">all inclusive</div>
        <ul class="list-check">
          <li>All previous benefits</li>
          <li>10% discount on annual price</li>
          <li>Locked-in price</li>
        </ul>
        <a href="../virtual-office-apply.php?plan=2y" class="btn btn-outline btn-block" data-testid="select-2y-btn">Apply Now</a>
      </div>
      <div class="price-card" data-testid="price-card-5y">
        <h3>5-Year</h3>
        <div class="price">€2,000</div>
        <div class="term">all inclusive</div>
        <ul class="list-check">
          <li>All previous benefits</li>
          <li>Maximum savings</li>
          <li>Ideal for established businesses</li>
        </ul>
        <a href="../virtual-office-apply.php?plan=5y" class="btn btn-outline btn-block" data-testid="select-5y-btn">Apply Now</a>
      </div>
      <div class="price-card" data-testid="price-card-custom">
        <h3>Custom</h3>
        <div class="price" style="font-size:1.6rem">Request a quote</div>
        <div class="term">for group setups</div>
        <ul class="list-check">
          <li>Multi-entity setups</li>
          <li>Branded reception</li>
          <li>Additional services</li>
        </ul>
        <a href="../virtual-office-apply.php?plan=custom" class="btn btn-outline btn-block" data-testid="select-custom-btn">Contact</a>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="meeting-room-section">
  <div class="container">
    <div class="grid grid-2" style="align-items:center;gap:50px">
      <div class="reveal">
        <span class="eyebrow">Additional services</span>
        <h2>Meeting Room</h2>
        <p class="lead">Fully equipped meeting room for professional meetings, presentations or video conferences. Charged only for the time you use.</p>
        <table class="table" data-testid="meeting-room-table">
          <thead><tr><th>Duration</th><th>Price</th></tr></thead>
          <tbody>
            <tr><td>2 hours</td><td><b>€20</b></td></tr>
            <tr><td>4 hours</td><td><b>€35</b></td></tr>
            <tr><td>6 hours</td><td><b>€50</b></td></tr>
            <tr><td>8 hours (full day)</td><td><b>€70</b></td></tr>
          </tbody>
        </table>
        <ul class="list-check mt-3">
          <li>Capacity up to 8 people</li>
          <li>Presentation screen</li>
          <li>High-speed WiFi</li>
          <li>Catering (snack/lunch break) available on request</li>
        </ul>
      </div>
      <div class="reveal">
        <div class="card-blue card">
          <h3>Additional services</h3>
          <h4 style="margin-top:20px;color:#fff">Corporate Landline Number</h4>
          <p>Provision of a corporate landline with an annual monthly fee, depending on the talk-time package.</p>
          <h4 style="margin-top:20px;color:#fff">Corporate Mobile Number</h4>
          <p>Professional mobile number for smooth communication with clients.</p>
          <h4 style="margin-top:20px;color:#fff">Corporate Website</h4>
          <p>Corporate website creation (not an e-shop) at a one-off cost of <b>€500</b>.<br><span style="font-size:.85rem;opacity:.85">Not included: domain, email, hosting.</span></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" data-testid="vo-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Registered address in <span style="color:var(--c-orange-light)">24 hours</span></h2>
      <p>Fill in the application form. We'll prepare a <b>written quote</b> and complete the contract within one business day. Fully remote — no visit required, no obligation.</p>
      <div class="btn-row center">
        <a href="../virtual-office-apply.php" class="btn btn-primary btn-lg" data-testid="vo-apply-btn">Request a quote →</a>
        <a href="mailto:sales@nexify.gr?subject=Interest%20in%20Registered%20Address" class="btn btn-ghost btn-lg">✉️ sales@nexify.gr</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
