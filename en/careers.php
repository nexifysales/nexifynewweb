<?php
/**
 * NexiFy — Careers (English)
 */
$pageTitle       = 'Careers — NexiFy';
$pageDescription = 'Work at NexiFy. Tech, sales, operations, AI engineering. Hybrid setup, flexibility, responsibility from day 1.';
$pageCanonical   = 'https://nexify.gr/en/careers.php';
require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · Careers</div>
    <h1>Careers at <span style="color:var(--c-orange-light)">NexiFy</span></h1>
    <p>We're building an ecosystem that combines sales, technology and entrepreneurial thinking. We're looking for people who want to build something significant — not just fill a 9-to-5 role.</p>
  </div>
</section>

<section class="section" data-testid="careers-why-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Why NexiFy</span>
      <h2>We're not corporate. We're not a startup. We're something in between.</h2>
    </div>
    <div class="grid grid-3 reveal">
      <div class="card" data-testid="careers-card-responsibility">
        <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h3>Responsibility from Day 1</h3>
        <p>No waiting 6 months before you're trusted. You take on real projects from your very first week.</p>
      </div>
      <div class="card" data-testid="careers-card-stack">
        <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M13 2L4 14h7l-1 8 9-12h-7l1-8z" fill="currentColor"/></svg></div>
        <h3>Modern Stack</h3>
        <p>We work with AI, automation and modern frameworks. No one asks you to do manual work that a script could handle.</p>
      </div>
      <div class="card" data-testid="careers-card-flex">
        <div class="card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
        <h3>Flexibility</h3>
        <p>Hybrid setup, flexible hours, results-driven culture. No presenteeism.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-soft" data-testid="careers-positions-section">
  <div class="container">
    <div class="text-center reveal" style="max-width:720px;margin:0 auto 50px">
      <span class="eyebrow">Open positions</span>
      <h2>Current Openings</h2>
      <p class="lead">Don't see your role listed? Send us your CV anyway — if you fit our culture, we'll find a way.</p>
    </div>
    <div class="grid grid-2 reveal">
      <div class="card" data-testid="job-card-sales">
        <span class="badge">Sales</span>
        <h3 style="margin-top:14px">Energy Sales Consultant</h3>
        <p>Outbound sales of electricity &amp; gas plans to residential and business clients. Results-based bonus structure.</p>
        <a href="contact.php?topic=careers&amp;pos=sales" class="btn btn-outline btn-sm" data-testid="apply-sales-btn">Apply Now →</a>
      </div>
      <div class="card" data-testid="job-card-ai">
        <span class="badge badge-blue">Tech</span>
        <h3 style="margin-top:14px">AI / Automation Engineer</h3>
        <p>Build voice AI agents, scrapers and automations with Python/Node. LangChain, n8n, Firecrawl, ElevenLabs, Retell.</p>
        <a href="contact.php?topic=careers&amp;pos=ai" class="btn btn-outline btn-sm" data-testid="apply-ai-btn">Apply Now →</a>
      </div>
      <div class="card" data-testid="job-card-dev">
        <span class="badge badge-blue">Tech</span>
        <h3 style="margin-top:14px">Full-Stack Developer (Next.js / FastAPI)</h3>
        <p>Web platforms, dashboards, integrations with providers. Next.js, Tailwind, FastAPI, Supabase, Stripe.</p>
        <a href="contact.php?topic=careers&amp;pos=dev" class="btn btn-outline btn-sm" data-testid="apply-dev-btn">Apply Now →</a>
      </div>
      <div class="card" data-testid="job-card-cs">
        <span class="badge">Operations</span>
        <h3 style="margin-top:14px">Customer Success / Account Manager</h3>
        <p>Manage B2B client portfolios, retention, upsells, and serve as the day-to-day point of contact for our services.</p>
        <a href="contact.php?topic=careers&amp;pos=cs" class="btn btn-outline btn-sm" data-testid="apply-cs-btn">Apply Now →</a>
      </div>
    </div>
  </div>
</section>

<section class="section" data-testid="careers-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Didn't find the right role?</h2>
      <p>Send us your CV with a short paragraph about what interests you. We read every email.</p>
      <div class="btn-row center">
        <a href="mailto:hr@nexify.gr?subject=CV — Open application" class="btn btn-primary btn-lg" data-testid="careers-email-btn">✉️ hr@nexify.gr</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
