<?php
$pageTitle       = 'Company Registry (GEMI) — NexiFy I.K.E.';
$pageDescription = 'Official company details for NexiFy I.K.E. (VAT 802804085, GEMI 183087203000) as required by law.';
$pageCanonical   = 'https://nexify.gr/en/gemi.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Company Registry</div>
    <h1>Company <span style="color:var(--c-orange-light)">Registry Details</span></h1>
    <p>Publication of company details as required by Greek Business Registry legislation (GEMI — Law 3419/2005).</p>
  </div>
</section>

<section class="section" data-testid="gemi-section">
  <div class="container container-narrow">
    <div class="card" data-testid="gemi-table-card">
      <h2 style="margin-bottom:30px">Official Details — NexiFy I.K.E.</h2>
      <table class="table" data-testid="gemi-table">
        <tbody>
          <tr><th style="width:40%">Company Name</th><td>NexiFy I.K.E.</td></tr>
          <tr><th>Company Name (Latin characters)</th><td>NexiFy P.C.</td></tr>
          <tr><th>Legal Form</th><td>Private Capital Company (I.K.E. — Greek equivalent of Ltd)</td></tr>
          <tr><th>GEMI Number</th><td><b>183087203000</b></td></tr>
          <tr><th>VAT Number</th><td><b>802804085</b></td></tr>
          <tr><th>Tax Office</th><td>KE.FO.DE. Attica</td></tr>
          <tr><th>Incorporation Date</th><td>11/03/2025</td></tr>
          <tr><th>Status</th><td><span class="badge badge-green">Active</span> since 11/03/2025</td></tr>
          <tr><th>Address</th><td>6 Moschonesion St</td></tr>
          <tr><th>Postcode</th><td>12242</td></tr>
          <tr><th>Area</th><td>Aigaleo · West Athens</td></tr>
          <tr><th>Phone</th><td><a href="tel:+302109996300">+30 210 999 6300</a></td></tr>
          <tr><th>Website</th><td><a href="https://www.nexify.gr">https://www.nexify.gr</a></td></tr>
          <tr><th>First Fiscal Year End</th><td>31/12/2025</td></tr>
          <tr><th>Company Duration</th><td>20 years (expires 10/03/2045)</td></tr>
          <tr><th>Share Capital</th><td>€30,000</td></tr>
          <tr><th>Managing Director</th><td>Stavros Polykandritis</td></tr>
        </tbody>
      </table>
    </div>

    <div class="card mt-4" data-testid="gemi-verify-card">
      <h3>Verify Company Details</h3>
      <p>All of the above details are publicly available and verifiable through the official Greek General Commercial Registry (GEMI) platform.</p>
      <a href="https://services.businessportal.gr" target="_blank" rel="noopener" class="btn btn-outline" data-testid="gemi-portal-btn">Visit GEMI Portal →</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
