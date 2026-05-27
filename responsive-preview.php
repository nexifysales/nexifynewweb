<?php
/**
 * NexiFy — Responsive Design Preview & Architecture Guide
 * Ticket: NEXIFYWEB-0009
 */

$pageTitle       = 'Responsive Design Architecture — NexiFy';
$pageDescription = 'Comprehensive responsive design strategy, breakpoint system, and cross-platform compatibility analysis for nexify.gr.';
$pageCanonical   = 'https://nexify.gr/responsive-preview.php';

require_once __DIR__ . '/includes/header.php';
?>

<!-- Include responsive enhancements -->
<link rel="stylesheet" href="css/responsive.css">

<style>
/* ═══ Preview-specific styles ═══ */
.preview-hero {
  background: linear-gradient(135deg, #0f1623 0%, #1f2a3d 50%, #3268ac 100%);
  color: #fff;
  padding: clamp(60px, 10vw, 120px) 0;
  position: relative;
  overflow: hidden;
}

.preview-hero::before {
  content: '';
  position: absolute;
  top: -30%;
  right: -10%;
  width: 60%;
  height: 160%;
  background: radial-gradient(circle, rgba(248,146,65,.25), transparent 60%);
  pointer-events: none;
}

.preview-hero h1 { color: #fff; }
.preview-hero p  { color: rgba(255,255,255,.85); max-width: 680px; }

/* Breakpoint Visualizer */
.bp-bar {
  display: flex;
  border-radius: 12px;
  overflow: hidden;
  height: 48px;
  font-size: 0.75rem;
  font-weight: 700;
  margin: 32px 0;
}

.bp-bar .bp-seg {
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  transition: flex 0.3s;
  white-space: nowrap;
  overflow: hidden;
  padding: 0 8px;
  text-align: center;
}

.bp-xs   { background: #ef4444; flex: 1.6; }
.bp-sm   { background: #f97316; flex: 2.9; }
.bp-md   { background: #eab308; flex: 0.7; }
.bp-lg   { background: #22c55e; flex: 1.9; }
.bp-xl   { background: #3268ac; flex: 4.2; }
.bp-2xl  { background: #7c3aed; flex: 5; }

/* Current BP indicator */
.bp-indicator {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: rgba(255,255,255,.12);
  border: 1px solid rgba(255,255,255,.2);
  padding: 10px 20px;
  border-radius: 999px;
  font-weight: 700;
  margin-bottom: 24px;
}

.bp-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #4ade80;
  animation: pulse 1.5s infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; transform: scale(1); }
  50%       { opacity: .7; transform: scale(1.3); }
}

/* Section nav */
.doc-nav {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 40px;
}

.doc-nav a {
  padding: 8px 18px;
  border: 1.5px solid var(--c-line);
  border-radius: 999px;
  font-size: .88rem;
  font-weight: 600;
  color: var(--c-ink-2);
  transition: all .2s;
  white-space: nowrap;
}

.doc-nav a:hover {
  background: var(--c-blue);
  color: #fff;
  border-color: var(--c-blue);
}

/* Section headers */
.doc-section {
  padding: clamp(40px, 6vw, 80px) 0;
  border-bottom: 1px solid var(--c-line);
}

.doc-section:last-child { border-bottom: none; }

.section-badge {
  display: inline-block;
  background: var(--c-orange-50);
  color: var(--c-orange-dark);
  padding: 4px 12px;
  border-radius: 6px;
  font-size: .75rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .1em;
  margin-bottom: 12px;
}

/* Breakpoint table */
.bp-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid var(--c-line);
  margin: 24px 0;
}

.bp-table th {
  background: var(--c-ink);
  color: #fff;
  padding: 14px 18px;
  text-align: left;
  font-size: .85rem;
  font-weight: 700;
  letter-spacing: .04em;
}

.bp-table td {
  padding: 14px 18px;
  border-bottom: 1px solid var(--c-line);
  font-size: .92rem;
}

.bp-table tr:last-child td { border-bottom: none; }
.bp-table tr:nth-child(even) td { background: var(--c-bg-soft); }

.bp-swatch {
  display: inline-block;
  width: 14px;
  height: 14px;
  border-radius: 3px;
  vertical-align: middle;
  margin-right: 6px;
}

/* Device cards grid */
.device-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  margin: 28px 0;
}

.device-card {
  background: var(--c-bg-card);
  border: 1px solid var(--c-line);
  border-radius: var(--radius-lg);
  padding: 24px;
  position: relative;
  transition: all .25s;
}

.device-card:hover {
  border-color: var(--c-blue-light);
  box-shadow: var(--shadow);
}

.device-card h4 {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 12px;
}

.device-icon {
  width: 36px;
  height: 36px;
  border-radius: 8px;
  display: grid;
  place-items: center;
  font-size: 1.1rem;
  flex-shrink: 0;
}

.device-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.device-card li {
  padding: 6px 0;
  border-bottom: 1px solid var(--c-line);
  font-size: .9rem;
  color: var(--c-text);
  display: flex;
  align-items: flex-start;
  gap: 8px;
}

.device-card li:last-child { border-bottom: none; }

.device-card li::before {
  content: '→';
  color: var(--c-orange);
  font-weight: 700;
  flex-shrink: 0;
}

/* Compatibility matrix */
.compat-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid var(--c-line);
  font-size: .85rem;
}

.compat-table th, .compat-table td {
  padding: 11px 14px;
  text-align: center;
  border-bottom: 1px solid var(--c-line);
  border-right: 1px solid var(--c-line);
}

.compat-table th:first-child,
.compat-table td:first-child {
  text-align: left;
  font-weight: 600;
}

.compat-table th {
  background: var(--c-ink);
  color: #fff;
  font-size: .78rem;
  text-transform: uppercase;
  letter-spacing: .04em;
}

.compat-table tr:last-child td { border-bottom: none; }
.compat-table tr:nth-child(even) td { background: var(--c-bg-soft); }

.compat-yes { color: #16a34a; font-weight: 700; font-size: 1rem; }
.compat-no  { color: #dc2626; font-weight: 700; font-size: 1rem; }
.compat-partial { color: #d97706; font-weight: 700; font-size: .85rem; }

/* Performance checklist */
.checklist-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 24px;
  margin: 24px 0;
}

.checklist-card {
  background: var(--c-bg-card);
  border: 1px solid var(--c-line);
  border-radius: var(--radius-lg);
  padding: 24px;
}

.checklist-card h4 {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
  font-size: 1rem;
}

.checklist-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.checklist-card li {
  padding: 7px 0 7px 28px;
  position: relative;
  font-size: .9rem;
  border-bottom: 1px solid var(--c-line);
  color: var(--c-text);
}

.checklist-card li:last-child { border-bottom: none; }

.checklist-card li::before {
  content: '☐';
  position: absolute;
  left: 0;
  color: var(--c-blue);
  font-size: 1rem;
}

/* Layout diagrams */
.layout-demo {
  display: grid;
  gap: 20px;
  margin: 24px 0;
}

.layout-frame {
  border: 2px solid var(--c-line);
  border-radius: var(--radius);
  overflow: hidden;
  background: var(--c-bg-soft);
}

.layout-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 14px;
  background: var(--c-ink);
  color: #fff;
  font-size: .8rem;
  font-weight: 700;
}

.layout-body {
  padding: 16px;
}

.layout-mockup-mobile {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.layout-mockup-tablet {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
}

.layout-mockup-desktop {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  gap: 8px;
}

.lm-block {
  background: #fff;
  border: 1px solid var(--c-line);
  border-radius: 6px;
  padding: 10px;
  font-size: .7rem;
  font-weight: 600;
  color: var(--c-muted);
  text-align: center;
}

.lm-nav {
  background: var(--c-ink);
  color: rgba(255,255,255,.7);
  padding: 8px 10px;
  border-radius: 4px;
  margin-bottom: 6px;
}

.lm-hero { background: linear-gradient(135deg, var(--c-blue-50), var(--c-orange-50)); height: 60px; display: flex; align-items: center; justify-content: center; color: var(--c-blue); }
.lm-card { height: 50px; display: flex; align-items: center; justify-content: center; }
.lm-footer { background: #e5e7eb; color: #6b7280; height: 40px; display: flex; align-items: center; justify-content: center; grid-column: 1 / -1; }
.lm-cta    { background: var(--c-orange-50); color: var(--c-orange); font-weight: 800; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 4px; }

/* Typography scale showcase */
.type-scale {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin: 24px 0;
}

.type-row {
  display: flex;
  align-items: baseline;
  gap: 20px;
  border-bottom: 1px solid var(--c-line);
  padding-bottom: 16px;
}

.type-label {
  font-size: .75rem;
  font-weight: 700;
  color: var(--c-muted);
  width: 120px;
  flex-shrink: 0;
  font-family: monospace;
}

/* Live device info box */
.device-info-box {
  background: var(--c-ink);
  color: #fff;
  border-radius: var(--radius-lg);
  padding: 28px;
  margin: 24px 0;
  font-family: 'Courier New', monospace;
  font-size: .85rem;
}

.device-info-box .di-row {
  display: flex;
  gap: 16px;
  margin-bottom: 8px;
  flex-wrap: wrap;
}

.di-key { color: var(--c-orange-light); min-width: 180px; }
.di-val { color: #4ade80; }

/* Code blocks */
pre {
  background: var(--c-ink);
  color: #e2e8f0;
  border-radius: var(--radius);
  padding: 20px 24px;
  overflow-x: auto;
  font-size: .82rem;
  line-height: 1.7;
  margin: 16px 0;
}

code {
  font-family: 'Courier New', monospace;
}

.code-blue    { color: #93c5fd; }
.code-green   { color: #86efac; }
.code-orange  { color: #fb923c; }
.code-yellow  { color: #fde047; }
.code-purple  { color: #c4b5fd; }

/* Stats strip */
.stats-strip {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 20px;
  margin: 24px 0;
}

.stat-box {
  background: var(--c-bg-card);
  border: 1px solid var(--c-line);
  border-radius: var(--radius);
  padding: 20px;
  text-align: center;
}

.stat-box .stat-num {
  font-family: var(--font-display);
  font-size: 2rem;
  font-weight: 800;
  color: var(--c-blue);
  line-height: 1;
}

.stat-box .stat-label {
  font-size: .8rem;
  color: var(--c-muted);
  margin-top: 6px;
  text-transform: uppercase;
  letter-spacing: .07em;
}

/* Tools grid */
.tools-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
  margin: 24px 0;
}

.tool-card {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 18px 20px;
  background: var(--c-bg-card);
  border: 1px solid var(--c-line);
  border-radius: var(--radius);
  transition: all .2s;
}

.tool-card:hover {
  border-color: var(--c-blue-light);
  box-shadow: var(--shadow-sm);
}

.tool-icon {
  width: 44px;
  height: 44px;
  border-radius: 10px;
  display: grid;
  place-items: center;
  font-size: 1.3rem;
  flex-shrink: 0;
}

.tool-card h4 { margin: 0 0 3px; font-size: .95rem; }
.tool-card p  { margin: 0; font-size: .8rem; color: var(--c-muted); }

/* Mobile notice */
.mobile-notice {
  display: none;
  background: var(--c-orange-50);
  border: 1px solid var(--c-orange);
  border-radius: var(--radius);
  padding: 14px 18px;
  margin: 20px 0;
  font-size: .9rem;
  color: var(--c-orange-dark);
}

@media (max-width: 767px) {
  .mobile-notice { display: block; }
  .compat-table { font-size: .75rem; }
  .compat-table th, .compat-table td { padding: 8px; }
}
</style>

<!-- ════════════════════════════════════════════
     HERO
════════════════════════════════════════════ -->
<section class="preview-hero">
  <div class="container">
    <div class="bp-indicator" id="bpIndicator">
      <span class="bp-dot"></span>
      <span id="bpLabel">Detecting device...</span>
    </div>

    <span class="eyebrow" style="color:var(--c-orange-light)">NEXIFYWEB-0009 — Deliverable</span>
    <h1 style="font-size: clamp(2rem,6vw,3.8rem);max-width:760px">
      Responsive Web Design<br>Architecture & Strategy
    </h1>
    <p style="font-size:1.1rem;margin-top:16px">
      A complete responsive design system, cross-platform compatibility analysis, performance optimization strategy,
      and UX architecture for <strong>nexify.gr</strong> — built for 2026 web standards.
    </p>

    <!-- Breakpoint Bar -->
    <div class="bp-bar">
      <div class="bp-seg bp-xs">XS<br>320–480</div>
      <div class="bp-seg bp-sm">SM<br>481–767</div>
      <div class="bp-seg bp-md">MD<br>768–834</div>
      <div class="bp-seg bp-lg">LG<br>835–1024</div>
      <div class="bp-seg bp-xl">XL<br>1025–1440</div>
      <div class="bp-seg bp-2xl">2XL<br>1441–2560+</div>
    </div>

    <div class="stats-strip" style="--c-bg-card: rgba(255,255,255,.1); --c-line: rgba(255,255,255,.15);">
      <div class="stat-box" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.15)">
        <div class="stat-num" style="color:#60a5fa">6</div>
        <div class="stat-label" style="color:rgba(255,255,255,.6)">Breakpoints</div>
      </div>
      <div class="stat-box" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.15)">
        <div class="stat-num" style="color:#4ade80">11</div>
        <div class="stat-label" style="color:rgba(255,255,255,.6)">Platforms</div>
      </div>
      <div class="stat-box" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.15)">
        <div class="stat-num" style="color:#fb923c">27</div>
        <div class="stat-label" style="color:rgba(255,255,255,.6)">CSS Modules</div>
      </div>
      <div class="stat-box" style="background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.15)">
        <div class="stat-num" style="color:#c4b5fd">AA</div>
        <div class="stat-label" style="color:rgba(255,255,255,.6)">WCAG 2.1</div>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     LIVE DEVICE INFO
════════════════════════════════════════════ -->
<section class="section section-soft" style="padding-block: 40px">
  <div class="container">
    <span class="section-badge">Live Detection</span>
    <h3>Your Current Device Profile</h3>
    <div class="device-info-box" id="deviceInfoBox">
      <div class="di-row">
        <span class="di-key">BREAKPOINT</span>
        <span class="di-val" id="di-bp">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">VIEWPORT</span>
        <span class="di-val" id="di-vp">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">DEVICE PIXEL RATIO</span>
        <span class="di-val" id="di-dpr">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">TOUCH DEVICE</span>
        <span class="di-val" id="di-touch">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">ORIENTATION</span>
        <span class="di-val" id="di-orient">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">COLOR SCHEME</span>
        <span class="di-val" id="di-scheme">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">REDUCED MOTION</span>
        <span class="di-val" id="di-motion">—</span>
      </div>
      <div class="di-row">
        <span class="di-key">USER AGENT</span>
        <span class="di-val" id="di-ua" style="word-break:break-all;font-size:.75rem">—</span>
      </div>
    </div>
  </div>
</section>

<!-- Quick navigation -->
<div class="container" style="padding-top:40px">
  <nav class="doc-nav" aria-label="Section navigation">
    <a href="#breakpoints">1. Breakpoints</a>
    <a href="#layouts">2. Layouts</a>
    <a href="#typography">3. Typography</a>
    <a href="#devices">4. Device UX</a>
    <a href="#compatibility">5. Compatibility</a>
    <a href="#performance">6. Performance</a>
    <a href="#seo">7. SEO</a>
    <a href="#tools">8. Tools</a>
    <a href="#files">9. Files</a>
  </nav>
</div>

<!-- ════════════════════════════════════════════
     1. BREAKPOINTS
════════════════════════════════════════════ -->
<section id="breakpoints" class="doc-section">
  <div class="container">
    <span class="section-badge">Section 1</span>
    <h2>Breakpoint System</h2>
    <p class="lead">Six-tier responsive breakpoint system covering all modern devices from 320px to 2560px+.</p>

    <div style="overflow-x:auto">
      <table class="bp-table">
        <thead>
          <tr>
            <th>Device Type</th>
            <th>Width Range</th>
            <th>Media Query</th>
            <th>Layout</th>
            <th>Columns</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="bp-swatch" style="background:#ef4444"></span>Small Mobile</td>
            <td><code>320px – 480px</code></td>
            <td><code>max-width: 480px</code></td>
            <td>Single column, full-width</td>
            <td>1</td>
          </tr>
          <tr>
            <td><span class="bp-swatch" style="background:#f97316"></span>Large Mobile</td>
            <td><code>481px – 767px</code></td>
            <td><code>min-width: 481px</code></td>
            <td>Single column, padded</td>
            <td>1–2</td>
          </tr>
          <tr>
            <td><span class="bp-swatch" style="background:#eab308"></span>Tablet Portrait</td>
            <td><code>768px – 834px</code></td>
            <td><code>min-width: 768px</code></td>
            <td>2-column adaptive</td>
            <td>2</td>
          </tr>
          <tr>
            <td><span class="bp-swatch" style="background:#22c55e"></span>Tablet Landscape</td>
            <td><code>835px – 1024px</code></td>
            <td><code>min-width: 835px</code></td>
            <td>2–3 column grid</td>
            <td>2–3</td>
          </tr>
          <tr>
            <td><span class="bp-swatch" style="background:#3268ac"></span>Laptop</td>
            <td><code>1025px – 1440px</code></td>
            <td><code>min-width: 1025px</code></td>
            <td>Full multi-column</td>
            <td>3–4</td>
          </tr>
          <tr>
            <td><span class="bp-swatch" style="background:#7c3aed"></span>Desktop / 4K</td>
            <td><code>1441px – 2560px+</code></td>
            <td><code>min-width: 1441px</code></td>
            <td>Max-width capped at 1600px</td>
            <td>4–6</td>
          </tr>
        </tbody>
      </table>
    </div>

    <h3 style="margin-top:40px">CSS Custom Properties</h3>
    <pre><code><span class="code-purple">:root</span> <span class="code-yellow">{</span>
  <span class="code-blue">/* Breakpoint reference values */</span>
  <span class="code-green">--bp-xs:</span>  <span class="code-orange">320px</span>;   <span class="code-blue">/* Small Mobile — base */</span>
  <span class="code-green">--bp-sm:</span>  <span class="code-orange">481px</span>;   <span class="code-blue">/* Large Mobile */</span>
  <span class="code-green">--bp-md:</span>  <span class="code-orange">768px</span>;   <span class="code-blue">/* Tablet Portrait */</span>
  <span class="code-green">--bp-lg:</span>  <span class="code-orange">835px</span>;   <span class="code-blue">/* Tablet Landscape */</span>
  <span class="code-green">--bp-xl:</span>  <span class="code-orange">1025px</span>;  <span class="code-blue">/* Laptop */</span>
  <span class="code-green">--bp-2xl:</span> <span class="code-orange">1441px</span>;  <span class="code-blue">/* Desktop */</span>
  <span class="code-green">--bp-3xl:</span> <span class="code-orange">2560px</span>;  <span class="code-blue">/* 4K / Ultra-wide */</span>
<span class="code-yellow">}</span>

<span class="code-blue">/* Usage example: Mobile-first approach */</span>
<span class="code-purple">.grid-cards</span> <span class="code-yellow">{</span>
  <span class="code-green">display:</span> <span class="code-orange">grid</span>;
  <span class="code-green">grid-template-columns:</span> <span class="code-orange">1fr</span>; <span class="code-blue">/* Mobile base */</span>
<span class="code-yellow">}</span>

<span class="code-purple">@media (min-width: 768px)</span> <span class="code-yellow">{</span>
  <span class="code-purple">.grid-cards</span> <span class="code-yellow">{</span> <span class="code-green">grid-template-columns:</span> <span class="code-orange">repeat(2, 1fr)</span>; <span class="code-yellow">}</span>
<span class="code-yellow">}</span>

<span class="code-purple">@media (min-width: 1025px)</span> <span class="code-yellow">{</span>
  <span class="code-purple">.grid-cards</span> <span class="code-yellow">{</span> <span class="code-green">grid-template-columns:</span> <span class="code-orange">repeat(3, 1fr)</span>; <span class="code-yellow">}</span>
<span class="code-yellow">}</span></code></pre>
  </div>
</section>

<!-- ════════════════════════════════════════════
     2. LAYOUTS
════════════════════════════════════════════ -->
<section id="layouts" class="doc-section section-soft">
  <div class="container">
    <span class="section-badge">Section 2</span>
    <h2>Layout Recommendations</h2>
    <p class="lead">Adaptive layouts for each device tier, designed for maximum usability and conversion.</p>

    <div class="layout-demo" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr))">

      <!-- Mobile Layout -->
      <div class="layout-frame">
        <div class="layout-header">
          <span>📱 Mobile — 320px–767px</span>
          <span style="opacity:.6">Single Column</span>
        </div>
        <div class="layout-body">
          <div class="layout-mockup-mobile">
            <div class="lm-block lm-nav">☰ Header / Hamburger</div>
            <div class="lm-block lm-hero">Hero — Full Width</div>
            <div class="lm-block lm-card">Card 1</div>
            <div class="lm-block lm-card">Card 2</div>
            <div class="lm-block lm-card">Card 3</div>
            <div class="lm-block" style="background:#f3f4f6">Footer (stacked)</div>
            <div class="lm-cta">Sticky CTA Bar</div>
          </div>
        </div>
      </div>

      <!-- Tablet Layout -->
      <div class="layout-frame">
        <div class="layout-header">
          <span>📟 Tablet — 768px–1024px</span>
          <span style="opacity:.6">2 Columns</span>
        </div>
        <div class="layout-body">
          <div class="layout-mockup-mobile">
            <div class="lm-block lm-nav" style="display:flex;justify-content:space-between">
              <span>Logo</span><span>Nav Links | CTA</span>
            </div>
            <div class="layout-mockup-tablet" style="margin-bottom:8px">
              <div class="lm-block lm-hero" style="grid-column:1/3">Hero (text + visual side by side)</div>
            </div>
            <div class="layout-mockup-tablet">
              <div class="lm-block lm-card">Card 1</div>
              <div class="lm-block lm-card">Card 2</div>
              <div class="lm-block lm-card">Card 3</div>
              <div class="lm-block lm-card">Card 4</div>
              <div class="lm-block lm-footer">Footer 2-col</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Desktop Layout -->
      <div class="layout-frame">
        <div class="layout-header">
          <span>🖥 Desktop — 1025px+</span>
          <span style="opacity:.6">4 Columns</span>
        </div>
        <div class="layout-body">
          <div class="layout-mockup-mobile">
            <div class="lm-block lm-nav" style="display:flex;justify-content:space-between;font-size:.65rem">
              <span>Logo</span><span>Home · Energy · Ecosystem · Office · Partners · FAQ · [CTA]</span>
            </div>
            <div class="lm-block lm-hero" style="height:70px;margin-bottom:8px">Hero: 2-column split layout</div>
            <div class="layout-mockup-desktop">
              <div class="lm-block lm-card" style="font-size:.65rem">Card 1</div>
              <div class="lm-block lm-card" style="font-size:.65rem">Card 2</div>
              <div class="lm-block lm-card" style="font-size:.65rem">Card 3</div>
              <div class="lm-block lm-card" style="font-size:.65rem">Card 4</div>
              <div class="lm-footer" style="background:#e5e7eb;color:#6b7280;height:30px;display:flex;align-items:center;justify-content:center;border-radius:4px;grid-column:1/-1;font-size:.65rem">Footer 4-column</div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <h3 style="margin-top:40px">Touch Target Requirements</h3>
    <div class="device-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))">
      <?php
      $touchTargets = [
        ['📱', 'iOS (Apple HIG)', 'bg-blue-50', ['Min: 44×44px', 'Recommended: 48×48px', 'Margin between: 8px']],
        ['🤖', 'Android (Material)', '#f0fdf4', ['Min: 48×48px', 'Recommended: 56×56px', 'Margin between: 8px']],
        ['🌐', 'Web WCAG 2.1', '#eff6ff', ['Min: 44×44px', 'All interactive elements', 'Visible focus ring']],
        ['🖱️', 'Desktop (pointer)', '#fafafa', ['Min: 24×24px', 'Hover states required', 'Cursor: pointer']],
      ];

      foreach ($touchTargets as [$icon, $title, $bg, $items]): ?>
        <div class="device-card" style="background:<?= $bg ?>">
          <h4>
            <span class="device-icon" style="background:rgba(50,104,172,.1)"><?= $icon ?></span>
            <?= htmlspecialchars($title) ?>
          </h4>
          <ul>
            <?php foreach ($items as $item): ?>
              <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     3. TYPOGRAPHY
════════════════════════════════════════════ -->
<section id="typography" class="doc-section">
  <div class="container">
    <span class="section-badge">Section 3</span>
    <h2>Fluid Typography Scale</h2>
    <p class="lead">All typography uses <code>clamp()</code> for seamless scaling between breakpoints — no jarring jumps.</p>

    <div class="type-scale">
      <div class="type-row">
        <div class="type-label">--text-hero<br>clamp(2.2, 7vw, 5rem)</div>
        <div style="font-size:clamp(2.2rem,7vw,5rem);font-family:var(--font-display);font-weight:800;color:var(--c-ink);line-height:1">NexiFy</div>
      </div>
      <div class="type-row">
        <div class="type-label">h1 / --text-4xl<br>clamp(2rem, 5vw, 3.4rem)</div>
        <div style="font-size:clamp(2rem,5vw,3.4rem);font-family:var(--font-display);font-weight:800;color:var(--c-ink)">Heading One</div>
      </div>
      <div class="type-row">
        <div class="type-label">h2 / --text-3xl<br>clamp(1.6rem, 3.5vw, 2.4rem)</div>
        <div style="font-size:clamp(1.6rem,3.5vw,2.4rem);font-family:var(--font-display);font-weight:700;color:var(--c-ink)">Heading Two</div>
      </div>
      <div class="type-row">
        <div class="type-label">h3 / --text-2xl<br>clamp(1.2rem, 2.2vw, 1.4rem)</div>
        <div style="font-size:clamp(1.2rem,2.2vw,1.4rem);font-family:var(--font-display);font-weight:700;color:var(--c-ink)">Heading Three</div>
      </div>
      <div class="type-row">
        <div class="type-label">.lead / --text-lg<br>1.15rem (fixed)</div>
        <div class="lead">Lead paragraph — introductory text for sections.</div>
      </div>
      <div class="type-row">
        <div class="type-label">body / --text-base<br>clamp(0.94, 1.8vw, 1rem)</div>
        <div>Body text — readable at all viewport widths with optimal line height of 1.6.</div>
      </div>
      <div class="type-row">
        <div class="type-label">small / --text-sm<br>0.875rem – 1rem</div>
        <div style="font-size:.9rem;color:var(--c-muted)">Small text for captions, labels, and metadata.</div>
      </div>
    </div>

    <h3 style="margin-top:40px">iOS Input Zoom Prevention</h3>
    <p>All <code>&lt;input&gt;</code>, <code>&lt;select&gt;</code>, and <code>&lt;textarea&gt;</code> elements use <code>font-size: max(16px, 1rem)</code> to prevent iOS Safari auto-zoom on focus.</p>
    <pre><code><span class="code-blue">/* Prevents iOS Safari from zooming in when tapping inputs */</span>
<span class="code-purple">input, select, textarea</span> <span class="code-yellow">{</span>
  <span class="code-green">font-size:</span> <span class="code-orange">max(16px, 1rem)</span> !important;
<span class="code-yellow">}</span></code></pre>
  </div>
</section>

<!-- ════════════════════════════════════════════
     4. DEVICE UX
════════════════════════════════════════════ -->
<section id="devices" class="doc-section section-soft">
  <div class="container">
    <span class="section-badge">Section 4</span>
    <h2>Device-Specific UX Analysis</h2>
    <p class="lead">Platform-specific optimizations for every major OS, browser, and device ecosystem.</p>

    <div class="device-grid">
      <?php
      $devices = [
        ['🪟', '#dbeafe', 'Windows (Chrome, Edge, Firefox)', [
          'Use scrollbar-gutter: stable to prevent layout shifts',
          'Custom scrollbars via ::-webkit-scrollbar (Chrome/Edge)',
          'Firefox: scrollbar-color + scrollbar-width properties',
          'ClearType font rendering — use antialiased smoothing',
          'Edge is Chromium-based — treat as Chrome',
        ]],
        ['🍎', '#f0fdf4', 'macOS (Safari, Chrome)', [
          'backdrop-filter needs -webkit- prefix for Safari',
          'Retina: all displays are @2x — use srcset + SVG icons',
          '100dvh for full-height (avoids browser chrome issue)',
          'position: sticky fails inside overflow: hidden — avoid',
          'Form elements need appearance: none reset',
        ]],
        ['🐧', '#fefce8', 'Linux (Chrome, Firefox)', [
          'Less antialiasing than macOS — use 16px+ body text',
          'GTK theme may affect form elements on Firefox',
          'Reset inputs with appearance: none always',
          'Wayland/X11 no browser rendering differences',
          'Font stack: use system-ui fallback chain',
        ]],
        ['🤖', '#f0fdf4', 'Android (Chrome, Samsung Internet)', [
          'Touch targets: min 48×48px for Material compliance',
          'Use env(safe-area-inset-*) for notched devices',
          '-webkit-tap-highlight-color: transparent for custom taps',
          'Use 100dvh — address bar changes viewport height',
          'Samsung Internet: Chromium-based, supports modern CSS',
        ]],
        ['📱', '#fdf4ff', 'iOS Safari (iPhone)', [
          'Dynamic Island: env(safe-area-inset-top) = 47px',
          'Home indicator: env(safe-area-inset-bottom) = 34px',
          'Input font-size ≥ 16px prevents auto-zoom',
          '100dvh supported on iOS 16+ (use dvh units)',
          'Chrome iOS uses WebKit — identical to Safari',
        ]],
        ['📲', '#fff7ed', 'Safari iPad (iPadOS)', [
          '@media (pointer: coarse) for touch-first layouts',
          'Stage Manager (iPadOS 16+): test multi-window',
          'Landscape keyboard: max-height: 500px adjustments',
          '2-column layout activates at 835px breakpoint',
          'Hover states use @media (hover: hover) guard',
        ]],
      ];

      foreach ($devices as [$icon, $bg, $title, $points]): ?>
        <div class="device-card" style="background:<?= $bg ?>">
          <h4>
            <span class="device-icon" style="background:rgba(255,255,255,.8);font-size:1.3rem"><?= $icon ?></span>
            <?= htmlspecialchars($title) ?>
          </h4>
          <ul>
            <?php foreach ($points as $pt): ?>
              <li><?= htmlspecialchars($pt) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endforeach ?>
    </div>

    <!-- Safe Area visualization -->
    <h3 style="margin-top:40px">Safe Area Insets (Notch / Dynamic Island)</h3>
    <pre><code><span class="code-blue">/* Apply to fixed/sticky elements near edges */</span>
<span class="code-purple">.site-header</span> <span class="code-yellow">{</span>
  <span class="code-green">padding-top:</span> <span class="code-orange">env(safe-area-inset-top, 0px)</span>;
<span class="code-yellow">}</span>

<span class="code-purple">.sticky-cta-bar, .cookie-banner</span> <span class="code-yellow">{</span>
  <span class="code-green">padding-bottom:</span> <span class="code-orange">max(16px, env(safe-area-inset-bottom))</span>;
<span class="code-yellow">}</span>

<span class="code-purple">body</span> <span class="code-yellow">{</span>
  <span class="code-green">padding-left:</span>  <span class="code-orange">env(safe-area-inset-left, 0px)</span>;
  <span class="code-green">padding-right:</span> <span class="code-orange">env(safe-area-inset-right, 0px)</span>;
<span class="code-yellow">}</span>

<span class="code-blue">/* Viewport meta tag — MUST include viewport-fit=cover */</span>
<span class="code-purple">&lt;meta name="viewport"</span>
  <span class="code-green">content=</span><span class="code-orange">"width=device-width, initial-scale=1, viewport-fit=cover"</span><span class="code-purple">&gt;</span></code></pre>
  </div>
</section>

<!-- ════════════════════════════════════════════
     5. COMPATIBILITY MATRIX
════════════════════════════════════════════ -->
<section id="compatibility" class="doc-section">
  <div class="container">
    <span class="section-badge">Section 5</span>
    <h2>Cross-Platform Compatibility Matrix</h2>
    <p class="lead">Feature support across all major browsers and platforms tested for nexify.gr.</p>

    <div class="mobile-notice">
      <strong>📱 Mobile view:</strong> Scroll horizontally to see the full compatibility table.
    </div>

    <div class="table-responsive" style="margin:24px 0">
      <table class="compat-table">
        <thead>
          <tr>
            <th>Feature</th>
            <th>iOS Safari</th>
            <th>And. Chrome</th>
            <th>macOS Safari</th>
            <th>Win Chrome</th>
            <th>Win Edge</th>
            <th>Win Firefox</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $matrix = [
            ['CSS Grid', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['Flexbox', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['clamp()', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['backdrop-filter', '⚠️ -webkit-', '✅', '⚠️ -webkit-', '✅', '✅', '✅'],
            ['CSS Variables', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['100dvh', '⚠️ iOS16+', '✅', '✅', '✅', '✅', '✅'],
            ['Container Queries', '⚠️ iOS16+', '✅', '✅', '✅', '✅', '✅'],
            ['Safe Area env()', '✅', '✅', '✅', '—', '—', '—'],
            ['aspect-ratio', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['scroll-behavior', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['@supports', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['Sticky Header', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['Hover States', '❌ touch', '❌ touch', '✅', '✅', '✅', '✅'],
            ['Custom Scrollbar', '❌', '✅', '✅', '✅', '✅', '⚠️ limited'],
            ['Lazy Loading img', '✅', '✅', '✅', '✅', '✅', '✅'],
            ['WebP Images', '✅', '✅', '✅', '✅', '✅', '✅'],
          ];

          foreach ($matrix as $row):
            $feature = $row[0];
            $support = array_slice($row, 1);
          ?>
          <tr>
            <td><strong><?= htmlspecialchars($feature) ?></strong></td>
            <?php foreach ($support as $s): ?>
              <td>
                <?php if ($s === '✅'): ?>
                  <span class="compat-yes">✅</span>
                <?php elseif (strpos($s, '❌') !== false): ?>
                  <span class="compat-no"><?= htmlspecialchars($s) ?></span>
                <?php elseif ($s === '—'): ?>
                  <span style="color:#9ca3af">—</span>
                <?php else: ?>
                  <span class="compat-partial"><?= htmlspecialchars($s) ?></span>
                <?php endif ?>
              </td>
            <?php endforeach ?>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>

    <div style="display:flex;gap:24px;flex-wrap:wrap;font-size:.88rem;margin-top:16px">
      <span><span class="compat-yes">✅</span> Full support</span>
      <span><span class="compat-partial">⚠️</span> Partial / requires prefix</span>
      <span><span class="compat-no">❌</span> Not supported</span>
      <span style="color:#9ca3af">—</span><span> Not applicable</span>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     6. PERFORMANCE
════════════════════════════════════════════ -->
<section id="performance" class="doc-section section-soft">
  <div class="container">
    <span class="section-badge">Section 6</span>
    <h2>Performance Optimization Checklist</h2>
    <p class="lead">Core Web Vitals targets and optimization strategies for maximum PageSpeed score.</p>

    <div class="stats-strip" style="margin:28px 0">
      <div class="stat-box"><div class="stat-num" style="color:#16a34a">&lt;2.5s</div><div class="stat-label">LCP Target</div></div>
      <div class="stat-box"><div class="stat-num" style="color:#16a34a">&lt;200ms</div><div class="stat-label">INP Target</div></div>
      <div class="stat-box"><div class="stat-num" style="color:#16a34a">&lt;0.1</div><div class="stat-label">CLS Target</div></div>
      <div class="stat-box"><div class="stat-num" style="color:#16a34a">&lt;600ms</div><div class="stat-label">TTFB Target</div></div>
      <div class="stat-box"><div class="stat-num" style="color:var(--c-blue)">90+</div><div class="stat-label">Lighthouse Score</div></div>
    </div>

    <div class="checklist-grid">
      <?php
      $checklists = [
        ['⚡', 'Loading Performance', [
          'loading="lazy" on all non-LCP images',
          'fetchpriority="high" on hero/LCP image',
          'Fonts with display=swap',
          'Preconnect to fonts.googleapis.com',
          'Minify CSS/JS in production',
          'Use WebP or AVIF image format',
          'Enable gzip/brotli on Nginx',
          'Set Cache-Control headers',
          'Remove unused CSS',
          'Defer non-critical JS',
        ]],
        ['📐', 'Layout Stability (CLS)', [
          'Define width + height on all images',
          'Use aspect-ratio CSS property',
          'Avoid inserting content above existing',
          'font-display: swap for web fonts',
          'Avoid CSS animations that affect layout',
          'Reserve space for ads/embeds',
          'Test with Layout Shift Regions tool',
        ]],
        ['🎯', 'Interactivity (INP)', [
          'Minimize main thread blocking',
          'Use requestAnimationFrame for animations',
          'Debounce scroll/resize handlers',
          'Event delegation vs individual listeners',
          'Avoid forced synchronous layouts',
          'Web Workers for heavy computation',
          'Code split large JS bundles',
        ]],
        ['🔒', 'Security & Compliance', [
          'HTTPS enforced (already on nexify.gr)',
          'HSTS header set',
          'Content Security Policy headers',
          'X-Frame-Options: SAMEORIGIN',
          'No mixed content warnings',
          'Cookie consent (GDPR)',
          'Structured data for SEO',
        ]],
      ];

      foreach ($checklists as [$icon, $title, $items]): ?>
        <div class="checklist-card">
          <h4><?= $icon ?> <?= htmlspecialchars($title) ?></h4>
          <ul>
            <?php foreach ($items as $item): ?>
              <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endforeach ?>
    </div>

    <h3 style="margin-top:40px">Responsive Image Strategy</h3>
    <pre><code><span class="code-blue">&lt;!-- Modern responsive image with srcset + WebP fallback --&gt;</span>
<span class="code-purple">&lt;picture&gt;</span>
  <span class="code-purple">&lt;source</span>
    <span class="code-green">media=</span><span class="code-orange">"(max-width: 480px)"</span>
    <span class="code-green">srcset=</span><span class="code-orange">"hero-mobile.webp 480w"</span>
    <span class="code-green">type=</span><span class="code-orange">"image/webp"</span><span class="code-purple">&gt;</span>
  <span class="code-purple">&lt;source</span>
    <span class="code-green">media=</span><span class="code-orange">"(max-width: 1024px)"</span>
    <span class="code-green">srcset=</span><span class="code-orange">"hero-tablet.webp 1024w"</span>
    <span class="code-green">type=</span><span class="code-orange">"image/webp"</span><span class="code-purple">&gt;</span>
  <span class="code-purple">&lt;source</span>
    <span class="code-green">srcset=</span><span class="code-orange">"hero-desktop.webp 1440w, hero-desktop@2x.webp 2880w"</span>
    <span class="code-green">type=</span><span class="code-orange">"image/webp"</span><span class="code-purple">&gt;</span>
  <span class="code-purple">&lt;img</span>
    <span class="code-green">src=</span><span class="code-orange">"hero-desktop.jpg"</span>
    <span class="code-green">alt=</span><span class="code-orange">"NexiFy Hero"</span>
    <span class="code-green">loading=</span><span class="code-orange">"eager"</span>
    <span class="code-green">fetchpriority=</span><span class="code-orange">"high"</span>
    <span class="code-green">width=</span><span class="code-orange">"1440"</span>
    <span class="code-green">height=</span><span class="code-orange">"800"</span>
    <span class="code-purple">&gt;</span>
<span class="code-purple">&lt;/picture&gt;</span></code></pre>
  </div>
</section>

<!-- ════════════════════════════════════════════
     7. SEO
════════════════════════════════════════════ -->
<section id="seo" class="doc-section">
  <div class="container">
    <span class="section-badge">Section 7</span>
    <h2>SEO Mobile Optimization Checklist</h2>
    <p class="lead">Mobile-first indexing by Google means mobile UX directly impacts SEO ranking.</p>

    <div class="device-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr))">
      <?php
      $seoItems = [
        ['📱', 'Mobile-First Fundamentals', '#f0f9ff', [
          'viewport meta with width=device-width',
          'Tap targets ≥ 44px × 44px',
          'Font size ≥ 12px (Google: ≥ 16px)',
          'No intrusive interstitials',
          'Horizontal scroll not required',
          'Content fits viewport width',
        ]],
        ['⚡', 'Page Speed (Mobile)', '#f0fdf4', [
          'Lighthouse Mobile score ≥ 90',
          'LCP < 2.5s on mobile network',
          'Minimize render-blocking resources',
          'Text visible during font load',
          'Properly sized images (srcset)',
          'Efficient cache policy',
        ]],
        ['🔍', 'Technical SEO', '#eff6ff', [
          'Canonical URL per page (already done)',
          'Open Graph + Twitter Cards (done)',
          'Structured data: LocalBusiness JSON-LD',
          'XML Sitemap submitted to GSC',
          'robots.txt allows Googlebot',
          'HTTPS on all pages (done)',
        ]],
        ['🌍', 'Greek Market SEO', '#fdf4ff', [
          'lang="el" on <html> tag (done)',
          'Greek keywords in meta descriptions',
          'hreflang for el/en if multilingual',
          'Google Business Profile optimized',
          'Local schema markup for Greece',
          'Greek Unicode in URLs encoded properly',
        ]],
      ];

      foreach ($seoItems as [$icon, $title, $bg, $items]): ?>
        <div class="device-card" style="background:<?= $bg ?>">
          <h4>
            <span class="device-icon" style="background:rgba(255,255,255,.8)"><?= $icon ?></span>
            <?= htmlspecialchars($title) ?>
          </h4>
          <ul>
            <?php foreach ($items as $item): ?>
              <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endforeach ?>
    </div>

    <h3 style="margin-top:40px">Structured Data (JSON-LD)</h3>
    <pre><code><span class="code-purple">&lt;script type="application/ld+json"&gt;</span>
<span class="code-yellow">{</span>
  <span class="code-green">"@context"</span>: <span class="code-orange">"https://schema.org"</span>,
  <span class="code-green">"@type"</span>: <span class="code-orange">"Organization"</span>,
  <span class="code-green">"name"</span>: <span class="code-orange">"NexiFy"</span>,
  <span class="code-green">"url"</span>: <span class="code-orange">"https://nexify.gr"</span>,
  <span class="code-green">"logo"</span>: <span class="code-orange">"https://nexify.gr/logo-nexify.png"</span>,
  <span class="code-green">"description"</span>: <span class="code-orange">"Smart Solutions, Fast Results"</span>,
  <span class="code-green">"areaServed"</span>: <span class="code-orange">"GR"</span>,
  <span class="code-green">"contactPoint"</span>: <span class="code-yellow">{</span>
    <span class="code-green">"@type"</span>: <span class="code-orange">"ContactPoint"</span>,
    <span class="code-green">"contactType"</span>: <span class="code-orange">"customer service"</span>,
    <span class="code-green">"url"</span>: <span class="code-orange">"https://nexify.gr/contact.php"</span>
  <span class="code-yellow">}</span>
<span class="code-yellow">}</span>
<span class="code-purple">&lt;/script&gt;</span></code></pre>
  </div>
</section>

<!-- ════════════════════════════════════════════
     8. TOOLS
════════════════════════════════════════════ -->
<section id="tools" class="doc-section section-soft">
  <div class="container">
    <span class="section-badge">Section 8</span>
    <h2>Testing Tools Recommendations</h2>
    <p class="lead">Professional toolchain for cross-browser testing, performance auditing, and accessibility validation.</p>

    <div class="tools-grid">
      <?php
      $tools = [
        ['🔧', '#dbeafe', 'Chrome DevTools', 'Breakpoint testing, performance profiling, accessibility audit', 'Free'],
        ['🦊', '#fff3e0', 'Firefox DevTools', 'CSS Grid inspector, font rendering, responsive view', 'Free'],
        ['🧪', '#f3e8ff', 'BrowserStack', 'Real device testing (3000+ devices/browsers)', 'Paid'],
        ['📐', '#ecfdf5', 'Responsively App', 'Multi-device preview side-by-side (open source)', 'Free'],
        ['🚦', '#fff7ed', 'Lighthouse', 'CWV, accessibility, SEO, best practices audit', 'Free'],
        ['⚡', '#f0fdf4', 'PageSpeed Insights', 'Real-world CrUX field data + lab data', 'Free'],
        ['📊', '#f8fafc', 'WebPageTest', 'Waterfall, filmstrip, multi-location testing', 'Free'],
        ['🎭', '#f5f3ff', 'Playwright', 'Cross-browser E2E: Chrome, Firefox, Safari, Mobile', 'Free'],
        ['♿', '#fff1f2', 'axe DevTools', 'WCAG 2.1 AA automated accessibility checks', 'Free (core)'],
        ['🗺️', '#fdf4ff', 'Hotjar / Clarity', 'Heatmaps, session recordings, scroll depth', 'Free tier'],
        ['📈', '#f0f9ff', 'Google Analytics 4', 'Device/browser/OS segmentation, CWV monitoring', 'Free'],
        ['🎨', '#fffbeb', 'Colour Contrast', 'WCAG contrast ratio checker (WebAIM)', 'Free'],
      ];

      foreach ($tools as [$icon, $bg, $name, $desc, $cost]): ?>
        <div class="tool-card" style="background:<?= $bg ?>">
          <div class="tool-icon" style="background:rgba(255,255,255,.8)"><?= $icon ?></div>
          <div>
            <h4><?= htmlspecialchars($name) ?></h4>
            <p><?= htmlspecialchars($desc) ?></p>
            <span style="font-size:.75rem;font-weight:700;color:<?= $cost === 'Free' || $cost === 'Free (core)' || $cost === 'Free tier' ? '#16a34a' : '#dc2626' ?>"><?= htmlspecialchars($cost) ?></span>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     9. DELIVERABLE FILES
════════════════════════════════════════════ -->
<section id="files" class="doc-section">
  <div class="container">
    <span class="section-badge">Section 9 — Deliverables</span>
    <h2>Implementation Files Created</h2>
    <p class="lead">All responsive architecture files created for the NexiFy project — ready for integration.</p>

    <div class="device-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr))">
      <?php
      $files = [
        ['📄', '#f0fdf4', 'css/responsive.css', '27 modules of responsive CSS', [
          'CSS custom properties for breakpoints',
          'Fluid container & section system',
          'Responsive grid (auto-fit + named)',
          'Mobile nav + overlay system',
          'Sticky CTA bar (mobile only)',
          'Hero, cards, forms, footer — all responsive',
          'Safe area insets (notch/Dynamic Island)',
          'Accessibility: focus, reduced motion, high contrast',
          'Cross-browser scrollbar styling',
          'Print styles',
          'Container Queries (modern browsers)',
          'iOS/Android device quirk fixes',
        ]],
        ['⚙️', '#eff6ff', 'js/responsive-utils.js', 'Device detection & analytics', [
          'Breakpoint detection system',
          'Device class injection on <html>',
          'Analytics: device tracking for GA4',
          'Sticky header scroll state manager',
          'Sticky CTA bar visibility logic',
          'Lazy image loading enhancement',
          'Nav overlay + keyboard navigation',
          'Orientation change handler',
          'iOS vh fix (--actual-vh)',
          'Scroll depth tracking (GA4)',
        ]],
        ['📋', '#fdf4ff', '.specs/responsive-design-strategy.md', 'Full strategy document', [
          'Breakpoint system specification',
          'Device-specific UX analysis',
          'Browser compatibility matrix',
          'Typography scaling system',
          'Touch target requirements',
          'Safe area documentation',
          'Performance checklist',
          'SEO mobile checklist',
          'Analytics strategy',
          'Testing tools guide',
        ]],
        ['🌐', '#fff7ed', 'responsive-preview.php', 'This live preview page', [
          'Live device profile detection',
          'Breakpoint visualizer bar',
          'Layout diagrams (mobile/tablet/desktop)',
          'Typography scale showcase',
          'Device-specific UX cards',
          'Cross-platform compatibility matrix',
          'Performance checklists',
          'SEO checklist',
          'Tools recommendations',
          'Code examples with syntax highlighting',
        ]],
      ];

      foreach ($files as [$icon, $bg, $filename, $desc, $items]): ?>
        <div class="device-card" style="background:<?= $bg ?>">
          <h4>
            <span class="device-icon" style="background:rgba(255,255,255,.8);font-size:1.2rem"><?= $icon ?></span>
            <span>
              <code style="font-size:.8rem;color:var(--c-blue)"><?= htmlspecialchars($filename) ?></code><br>
              <span style="font-weight:500;font-size:.85rem;color:var(--c-muted)"><?= htmlspecialchars($desc) ?></span>
            </span>
          </h4>
          <ul>
            <?php foreach ($items as $item): ?>
              <li><?= htmlspecialchars($item) ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endforeach ?>
    </div>

    <!-- Integration instructions -->
    <h3 style="margin-top:40px">Integration Instructions</h3>
    <p>To activate the full responsive system across all pages, add these two lines to <code>includes/header.php</code>:</p>
    <pre><code><span class="code-blue">&lt;!-- In &lt;head&gt;, after style.css --&gt;</span>
<span class="code-purple">&lt;link</span> <span class="code-green">rel=</span><span class="code-orange">"stylesheet"</span> <span class="code-green">href=</span><span class="code-orange">"css/responsive.css"</span><span class="code-purple">&gt;</span>

<span class="code-blue">&lt;!-- Before &lt;/body&gt; --&gt;</span>
<span class="code-purple">&lt;script</span> <span class="code-green">src=</span><span class="code-orange">"js/responsive-utils.js"</span> <span class="code-green">defer</span><span class="code-purple">&gt;&lt;/script&gt;</span></code></pre>

    <div class="cta-box" style="margin-top:40px">
      <h2>Architecture Complete ✓</h2>
      <p>All responsive design deliverables for nexify.gr have been created. The system is mobile-first, cross-platform compatible, and built to 2026 web standards.</p>
      <div class="btn-row center">
        <a href="index.php" class="btn btn-ghost btn-lg">← Back to Homepage</a>
        <a href=".specs/responsive-design-strategy.md" class="btn btn-ghost btn-lg">📄 Full Strategy Doc</a>
      </div>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════
     STICKY CTA BAR (Demo — mobile only)
════════════════════════════════════════════ -->
<div class="sticky-cta-bar" id="stickyCTABar" data-testid="sticky-cta-bar">
  <span style="font-size:.85rem;font-weight:600;color:var(--c-ink-2)">NexiFy</span>
  <a href="energy.php" class="btn btn-primary btn-sm">Σύγκρινε ρεύμα →</a>
  <a href="contact.php" class="btn btn-outline btn-sm">Επικοινωνία</a>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script src="js/responsive-utils.js" defer></script>

<script>
// Live Device Info Panel
(function() {
  function getBP() {
    const w = window.innerWidth;
    if (w <= 480)  return 'mobile-small (320–480px)';
    if (w <= 767)  return 'mobile-large (481–767px)';
    if (w <= 834)  return 'tablet-portrait (768–834px)';
    if (w <= 1024) return 'tablet-landscape (835–1024px)';
    if (w <= 1440) return 'laptop (1025–1440px)';
    return 'desktop (1441px+)';
  }

  function isTouch() {
    return ('ontouchstart' in window) || navigator.maxTouchPoints > 0;
  }

  function updateInfo() {
    const bp = getBP();
    const label = document.getElementById('bpLabel');
    const diBP = document.getElementById('di-bp');
    const diVP = document.getElementById('di-vp');
    const diDPR = document.getElementById('di-dpr');
    const diTouch = document.getElementById('di-touch');
    const diOrient = document.getElementById('di-orient');
    const diScheme = document.getElementById('di-scheme');
    const diMotion = document.getElementById('di-motion');
    const diUA = document.getElementById('di-ua');

    if (label) label.textContent = bp;
    if (diBP) diBP.textContent = bp;
    if (diVP) diVP.textContent = window.innerWidth + ' × ' + window.innerHeight + ' px';
    if (diDPR) diDPR.textContent = (window.devicePixelRatio || 1).toFixed(2) + 'x' +
      (window.devicePixelRatio >= 2 ? ' (Retina/HiDPI)' : ' (Standard)');
    if (diTouch) diTouch.textContent = isTouch() ? 'YES — touch-first interactions active' : 'NO — hover interactions active';
    if (diOrient) diOrient.textContent = window.innerWidth > window.innerHeight ? 'LANDSCAPE' : 'PORTRAIT';
    if (diScheme) diScheme.textContent = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    if (diMotion) diMotion.textContent = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'YES — animations disabled' : 'NO — animations enabled';
    if (diUA) diUA.textContent = navigator.userAgent;
  }

  updateInfo();
  window.addEventListener('resize', function() {
    clearTimeout(window._infoTimeout);
    window._infoTimeout = setTimeout(updateInfo, 150);
  });
})();
</script>
