<?php
/**
 * NexiFy EN — Energy
 * English version of /energy.php
 */
$pageTitle       = 'Compare electricity & gas providers — NexiFy';
$pageDescription = 'Compare all electricity and natural gas providers in Greece — powered by MR. Revmas.';
$pageCanonical   = 'https://nexify.gr/en/energy.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Energy</div>
    <div class="powered-badge">
      <span class="lightning">⚡</span>
      Powered by <b style="color:#fff">MR. Revmas</b>
    </div>
    <h1>Your energy <span style="color:var(--c-orange-light)">superhero</span></h1>
    <p>We don't compare prices with a spreadsheet. We compare with <b>MR. Revmas</b> — an AI-powered engine that reads the market live and finds the programme that truly suits you. In seconds.</p>
  </div>
</section>

<!-- HERO REVEAL -->
<section class="revmas-feature" data-testid="revmas-hero-section">
  <div class="container">
    <div class="revmas-feature-grid">
      <div class="revmas-media reveal">
        <video autoplay muted loop playsinline poster="../mr-revmas-image.png">
          <source src="../mr-revmas-landing-2.mp4" type="video/mp4">
          <img src="../mr-revmas-image.png" alt="MR. Revmas">
        </video>
      </div>
      <div class="reveal">
        <span class="eyebrow">The reveal</span>
        <h2>A superhero<br>for <span class="accent">every household</span>.</h2>
        <p style="font-size:1.05rem">MR. Revmas is an <b style="color:#fff">AI-powered system</b> that continuously weighs the tariffs of all providers in Greece. It never sleeps, never forgets, never takes a higher commission from one company than another.</p>
        <p style="font-size:1.05rem">With a yellow cape, a lightning bolt on its chest and infinite computing power, MR. Revmas scans <b style="color:#fff">179+ programmes</b> in fractions of a second and gives you <b style="color:#FFA24C">the programme that truly suits you</b>.</p>
        <div class="revmas-cta-row">
          <a href="https://loyalty.revmas.gr/?mission=customer" target="_blank" rel="noopener" class="revmas-btn" data-testid="revmas-compare-btn">See how you'll lower your bill</a>
          <a href="#callback" class="btn btn-ghost" style="border-color:rgba(255,255,255,.3);color:#fff" data-testid="revmas-callback-btn">Call me back</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MISSION -->
<section class="revmas-feature" style="background:linear-gradient(180deg,#0E0E15 0%,#14141C 100%);padding-top:80px" data-testid="revmas-mission-section">
  <div class="container">
    <div class="revmas-feature-grid">
      <div class="reveal" style="order:2">
        <span class="eyebrow">Our mission</span>
        <h2>To make your energy bill <span class="accent">fair</span> again.</h2>
        <p style="font-size:1.05rem">Providers change their tariffs almost every month. Loyalty discounts, surcharges and add-ons make comparison a nightmare.</p>
        <p style="font-size:1.05rem"><b style="color:#fff">MR. Revmas</b> was created to give you back control.</p>
        <ul class="revmas-list">
          <li><span class="check">✓</span><div><b>100% transparent:</b> You see the base price, the discounted price and the annual cost. No surprises.</div></li>
          <li><span class="check">✓</span><div><b>No advertising cookies:</b> We don't "sell" you to third-party call centres. Your data stays yours.</div></li>
          <li><span class="check">✓</span><div><b>Green-first:</b> Renewable energy programmes are highlighted for a reduced carbon footprint. Choose consciously.</div></li>
        </ul>
        <div class="revmas-cta-row">
          <a href="https://revmas.gr/intro.html#origin" target="_blank" rel="noopener" class="revmas-btn">Learn the story →</a>
        </div>
      </div>
      <div class="revmas-media reveal" style="order:1">
        <video autoplay muted loop playsinline poster="../mr-revmas-image.png">
          <source src="../mr-revmas-flying.mp4" type="video/mp4">
          <img src="../mr-revmas-image.png" alt="MR. Revmas">
        </video>
      </div>
    </div>
  </div>
</section>

<!-- BIG CTA TO REVMAS -->
<section class="section" data-testid="revmas-cta-section">
  <div class="container">
    <div class="revmas-banner reveal" style="text-align:center;padding:60px 40px">
      <div class="revmas-logo-mark" style="margin:0 auto 20px"><svg viewBox="0 0 24 24" fill="none"><path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z" fill="#fff"/></svg></div>
      <h2 style="font-size:clamp(2rem,4vw,2.8rem);max-width:720px;margin:0 auto 16px">The comparison happens on <span class="accent">MR. Revmas</span></h2>
      <p style="max-width:580px;margin:0 auto 30px;font-size:1.05rem">Click the button. Enter your consumption in 30 seconds. Get the 3 cheapest programmes ranked by annual cost and potential savings. Free, no registration required.</p>
      <div class="btn-row center" style="position:relative">
        <a href="https://revmas.gr/intro.html" target="_blank" rel="noopener" class="revmas-btn" style="font-size:1.1rem;padding:18px 36px" data-testid="revmas-open-btn">⚡ Open MR. Revmas</a>
      </div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="section section-soft" data-testid="how-it-works-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">How it works</span>
      <h2>From comparison to contract — in 3 steps</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card" data-testid="step-card-1">
        <div class="pillar-num">1</div>
        <h3>Compare on MR. Revmas</h3>
        <p>Enter your consumption from any bill. MR. Revmas finds the 3 cheapest programmes in seconds.</p>
      </div>
      <div class="card" data-testid="step-card-2">
        <div class="pillar-num">2</div>
        <h3>Choose with NexiFy</h3>
        <p>Tell us which one you liked or leave it to us. We call you and confirm it fits your real needs.</p>
      </div>
      <div class="card" data-testid="step-card-3">
        <div class="pillar-num">3</div>
        <h3>Activation</h3>
        <p>We handle the entire provider switch process. You make no calls, fill in no documents on your own.</p>
      </div>
    </div>
  </div>
</section>

<!-- CALLBACK FORM -->
<section class="section section-soft" id="callback" data-testid="callback-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:660px;margin:0 auto 40px">
      <span class="eyebrow">Contact</span>
      <h2>I'd like you to <span style="background:var(--gradient-brand);-webkit-background-clip:text;background-clip:text;color:transparent">call me back</span></h2>
      <p class="lead">Leave us your details. We'll call you within 1 business day with a <b>full comparison</b> and a personalised proposal — no commitments.</p>
    </div>
    <form id="callbackForm" class="callback-card reveal" data-testid="callback-form">
      <div id="callbackBody">
        <h3>Tell us how to reach you</h3>
        <p style="color:var(--c-muted);font-size:.92rem;margin-bottom:24px">We call on business days, 09:00–17:00. We never share your details with third parties.</p>
        <div class="form-row">
          <div class="form-group">
            <label for="cb_name">Name *</label>
            <input type="text" class="form-control" id="cb_name" name="cb_name" required data-testid="cb-name-input">
          </div>
          <div class="form-group">
            <label for="cb_phone">Phone *</label>
            <input type="tel" class="form-control" id="cb_phone" name="cb_phone" required data-testid="cb-phone-input">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="cb_email">Email <span style="color:var(--c-muted);font-weight:400">(optional)</span></label>
            <input type="email" class="form-control" id="cb_email" name="cb_email" data-testid="cb-email-input">
          </div>
          <div class="form-group">
            <label for="cb_when">Best time to call</label>
            <select class="form-control" id="cb_when" name="cb_when" data-testid="cb-when-select">
              <option value="any">Any time</option>
              <option value="morning">09:00 – 12:00</option>
              <option value="midday">12:00 – 15:00</option>
              <option value="afternoon">15:00 – 17:00</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="cb_topic">What are you interested in?</label>
          <select class="form-control" id="cb_topic" name="cb_topic" data-testid="cb-topic-select">
            <option value="energy-home">Electricity or gas for home</option>
            <option value="energy-pro">Professional / business tariff</option>
            <option value="energy-multi">Multiple meters / business</option>
            <option value="energy-ev">EV / night tariff</option>
            <option value="other">Something else</option>
          </select>
        </div>
        <div class="form-group">
          <label for="cb_notes">Comments <span style="color:var(--c-muted);font-weight:400">(optional)</span></label>
          <textarea class="form-control" id="cb_notes" name="cb_notes" rows="3" placeholder="e.g. I've already compared on MR. Revmas, I'm interested in programme X" data-testid="cb-notes-textarea"></textarea>
        </div>
        <div class="form-group">
          <label class="gdpr-label" style="font-weight:400;font-size:.88rem;display:flex;gap:10px;align-items:flex-start;cursor:pointer">
            <input type="checkbox" name="gdpr_consent" value="1" required
                   style="margin-top:3px;width:18px;height:18px;min-width:18px;cursor:pointer;accent-color:var(--c-blue,#3268ac)"
                   data-testid="cb-privacy-checkbox">
            <span>I have read and agree to the <a href="privacy.php" target="_blank">Privacy Policy</a> and <a href="terms.php" target="_blank">Terms of Use</a>. I allow NexiFy to contact me. *</span>
          </label>
        </div>
        <input type="text" name="_gotcha" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
        <button type="submit" class="btn btn-primary btn-block btn-lg" data-testid="cb-submit-btn">📞 Call me back →</button>
      </div>
      <div id="callbackSuccess" class="callback-success">
        <div class="check-big">✓</div>
        <h3 style="margin-bottom:8px">Thank you!</h3>
        <p style="margin-bottom:0">We have received your request. We'll call you within 1 business day.</p>
      </div>
    </form>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
