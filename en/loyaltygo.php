<?php
/**
 * NexiFy — LoyaltyGO showcase / βιτρίνα (EN)
 * English mirror of loyaltygo.php. Interest form posts to showcase.nexify.gr/showcase/lead.
 */
$pageTitle       = 'LoyaltyGO — Loyalty program for every business';
$pageDescription = 'LoyaltyGO: the rewards program that opens with a QR scan — no app store, with your own brand. Ready for cafés, gyms, retail, fuel, real estate and any industry.';
$pageCanonical   = 'https://nexify.gr/en/loyaltygo.php';
$pageImage       = 'https://nexify.gr/images/loyaltygo-og.jpg';
$pageImageAlt    = 'LoyaltyGO — QR loyalty program, with your own brand';
$pageImageW      = '1200';
$pageImageH      = '630';
require __DIR__ . '/includes/header.php';
?>
<style>
#lgo{
  --blue:#3268ac; --blue-dark:#234e85; --blue-light:#5a8dcf; --blue-50:#eaf1fa;
  --orange:#f26339; --orange-dark:#d44a22; --orange-light:#f89241; --orange-50:#fff2ec;
  --ink:#0f1623; --ink-2:#1f2a3d; --text:#2b3850; --muted:#6b7280;
  --line:#e5e7eb; --line-2:#d1d5db; --bg:#ffffff; --bg-soft:#f8fafc; --card:#ffffff;
  --v-cafe:#0a7d55; --v-gym:#dd5a1f; --v-shop:#7635e6; --v-fuel:#cf2f2f; --v-estate:#284c9c;
  --r:14px; --r-lg:22px;
  --shadow-sm:0 1px 3px rgba(15,22,35,.06),0 1px 2px rgba(15,22,35,.04);
  --shadow:0 10px 30px -12px rgba(50,104,172,.18),0 4px 12px -4px rgba(15,22,35,.06);
  --shadow-lg:0 30px 60px -20px rgba(50,104,172,.28),0 18px 40px -12px rgba(242,99,57,.15);
  --grad-brand:linear-gradient(135deg,var(--orange) 0%,var(--orange-light) 100%);
  --lgo-sans:'Inter',system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
  --lgo-display:'Poppins','Inter',sans-serif;
  --maxw:1140px;
  color:var(--text);font-family:var(--lgo-sans);line-height:1.62;background:var(--bg);
  display:block;-webkit-font-smoothing:antialiased;
}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]) #lgo{
  --ink:#f8fafc; --ink-2:#e5e7eb; --text:#e5e7eb; --muted:#9ca3af;
  --line:#2d3a50; --line-2:#3a475e; --bg:#0f1623; --bg-soft:#1a2235; --card:#1f2a3d;
  --blue:#5a8dcf; --blue-50:#17233a; --orange-50:#2a1b12;
  --v-cafe:#26c489; --v-gym:#ff7d47; --v-shop:#ad8bff; --v-fuel:#ff6a6a; --v-estate:#7ba0ff;
  --shadow:0 12px 34px -14px rgba(0,0,0,.55),0 4px 12px -4px rgba(0,0,0,.4);
  --shadow-lg:0 34px 64px -22px rgba(0,0,0,.7),0 18px 40px -12px rgba(0,0,0,.5);
}}
:root[data-theme="dark"] #lgo{
  --ink:#f8fafc; --ink-2:#e5e7eb; --text:#e5e7eb; --muted:#9ca3af;
  --line:#2d3a50; --line-2:#3a475e; --bg:#0f1623; --bg-soft:#1a2235; --card:#1f2a3d;
  --blue:#5a8dcf; --blue-50:#17233a; --orange-50:#2a1b12;
  --v-cafe:#26c489; --v-gym:#ff7d47; --v-shop:#ad8bff; --v-fuel:#ff6a6a; --v-estate:#7ba0ff;
  --shadow:0 12px 34px -14px rgba(0,0,0,.55),0 4px 12px -4px rgba(0,0,0,.4);
  --shadow-lg:0 34px 64px -22px rgba(0,0,0,.7),0 18px 40px -12px rgba(0,0,0,.5);
}
#lgo *{box-sizing:border-box}
#lgo h1,#lgo h2,#lgo h3{font-family:var(--lgo-display);line-height:1.1;margin:0;color:var(--ink);text-wrap:balance;letter-spacing:-.02em}
#lgo a{color:inherit;text-decoration:none}
#lgo .wrap{max-width:var(--maxw);margin:0 auto;padding:0 24px}
#lgo .eyebrow{font-size:12px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:var(--orange)}
#lgo .btn{display:inline-flex;align-items:center;gap:8px;font-weight:700;font-size:14px;padding:11px 19px;border-radius:11px;border:1px solid transparent;cursor:pointer;transition:transform .15s,box-shadow .15s,background .15s,border-color .15s;font-family:var(--lgo-sans)}
#lgo .btn-brand{background:var(--grad-brand);color:#fff;box-shadow:0 12px 26px -12px rgba(242,99,57,.5)}
#lgo .btn-brand:hover{transform:translateY(-1px);box-shadow:0 18px 34px -12px rgba(242,99,57,.6)}
#lgo .btn-ghost{border-color:var(--line-2);color:var(--ink);background:var(--card)}
#lgo .btn-ghost:hover{border-color:var(--orange)}
#lgo .hero{padding:64px 0 58px;background:radial-gradient(120% 90% at 85% -10%,var(--blue-50),transparent 55%)}
#lgo .hero .wrap{display:grid;grid-template-columns:1.06fr .94fr;gap:52px;align-items:center}
#lgo .hero h1{font-size:clamp(34px,5.2vw,56px);font-weight:800;margin-top:16px}
#lgo .hero h1 em{font-style:normal;color:var(--orange)}
#lgo .hero .lead{font-size:clamp(17px,2vw,20px);color:var(--muted);margin:20px 0 0;max-width:42ch}
#lgo .hero .cta{display:flex;gap:12px;flex-wrap:wrap;margin-top:30px}
#lgo .speed{margin-top:26px;display:flex;gap:22px;flex-wrap:wrap}
#lgo .speed div{display:flex;align-items:center;gap:9px;font-size:14px;font-weight:600;color:var(--ink)}
#lgo .speed svg{width:18px;height:18px;stroke:var(--orange);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex:none}
#lgo .stage{position:relative;display:flex;justify-content:center;align-items:center;min-height:380px}
#lgo .phone{width:232px;height:472px;border-radius:34px;background:var(--card);border:1px solid var(--line);box-shadow:var(--shadow-lg);padding:14px;position:relative;transform:rotate(-2.5deg);z-index:1}
#lgo .phone::before{content:"";position:absolute;top:14px;left:50%;transform:translateX(-50%);width:74px;height:6px;border-radius:4px;background:var(--line-2)}
#lgo .screen{height:100%;border-radius:22px;background:linear-gradient(170deg,var(--blue) 0%,var(--blue-dark) 100%);padding:30px 20px 20px;display:flex;flex-direction:column;color:#fff;overflow:hidden}
#lgo .screen .app-top{display:flex;justify-content:space-between;align-items:center;font-weight:700;font-family:var(--lgo-display);font-size:15px}
#lgo .screen .app-top small{font-weight:500;opacity:.8;font-size:10px;letter-spacing:.05em;text-transform:uppercase}
#lgo .ring{margin:26px auto 8px;width:132px;height:132px;border-radius:50%;display:grid;place-items:center;background:conic-gradient(var(--orange) 0deg 252deg,rgba(255,255,255,.18) 252deg 360deg)}
#lgo .ring div{width:104px;height:104px;border-radius:50%;background:var(--blue-dark);display:grid;place-content:center;text-align:center}
#lgo .ring b{font-family:var(--lgo-display);font-size:32px;font-weight:800;line-height:1}
#lgo .ring span{font-size:10px;opacity:.8;letter-spacing:.05em}
#lgo .screen .prog{text-align:center;font-size:12px;opacity:.85;margin-top:4px}
#lgo .screen .reward{margin-top:auto;background:rgba(255,255,255,.14);border-radius:12px;padding:11px 13px;display:flex;align-items:center;gap:10px;font-size:12.5px;font-weight:600}
#lgo .screen .reward .g{width:30px;height:30px;border-radius:8px;background:var(--grad-brand);display:grid;place-items:center;flex:none}
#lgo .qr-badge{position:absolute;right:-26px;bottom:44px;width:118px;background:var(--card);border:1px solid var(--line);border-radius:16px;box-shadow:var(--shadow-lg);padding:12px;transform:rotate(4deg);text-align:center}
#lgo .qr-badge .qr{width:78px;height:78px;margin:0 auto;border-radius:8px;background:conic-gradient(#0000 0 25%,var(--ink) 0 50%) 0 0/13px 13px;background-color:#fff;border:4px solid #fff}
#lgo .qr-badge p{margin:8px 0 0;font-size:11px;font-weight:700;color:var(--ink);line-height:1.3}
#lgo .qr-badge p span{color:var(--orange)}
#lgo section{padding:60px 0}
#lgo .sec-head{max-width:60ch}
#lgo .sec-head h2{font-size:clamp(26px,3.6vw,40px);font-weight:700;margin-top:12px}
#lgo .sec-head p{color:var(--muted);font-size:17px;margin:14px 0 0}
#lgo .bgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:8px}
#lgo .bcard{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:26px;box-shadow:var(--shadow-sm)}
#lgo .bcard .bi{width:48px;height:48px;border-radius:13px;display:grid;place-items:center;background:var(--orange-50);margin-bottom:16px}
#lgo .bcard .bi svg{width:25px;height:25px;stroke:var(--orange);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
#lgo .bcard h3{font-size:18px;font-weight:700}
#lgo .bcard p{margin:9px 0 0;color:var(--muted);font-size:14.5px}
#lgo .vgrid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:40px}
#lgo .vcard{background:var(--card);border:1px solid var(--line);border-radius:var(--r);padding:24px;display:flex;flex-direction:column;gap:13px;box-shadow:var(--shadow);position:relative;overflow:hidden;transition:transform .18s,box-shadow .18s,border-color .18s}
#lgo .vcard::before{content:"";position:absolute;left:0;top:0;bottom:0;width:4px;background:var(--v)}
#lgo .vcard:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg);border-color:color-mix(in srgb,var(--v) 45%,var(--line))}
#lgo .vhead{display:flex;align-items:center;gap:13px}
#lgo .vicon{width:46px;height:46px;border-radius:12px;display:grid;place-items:center;flex:none;background:color-mix(in srgb,var(--v) 13%,var(--card));color:var(--v)}
#lgo .vicon svg{width:24px;height:24px;stroke:var(--v);fill:none;stroke-width:1.7;stroke-linecap:round;stroke-linejoin:round}
#lgo .vname{font-family:var(--lgo-display);font-weight:700;font-size:20px;color:var(--ink)}
#lgo .vname b{color:var(--v)}
#lgo .vmech{font-size:13px;font-weight:700;color:var(--v);letter-spacing:.005em}
#lgo .vreward{font-size:14.5px;color:var(--muted);flex-grow:1}
#lgo .vreward b{color:var(--ink);font-weight:600}
#lgo .vlink{display:inline-flex;align-items:center;gap:7px;font-weight:700;font-size:14px;color:var(--v);margin-top:2px}
#lgo .vlink svg{width:15px;height:15px;transition:transform .15s}
#lgo .vlink:hover svg{transform:translateX(4px)}
#lgo .vcard.other{border:1.5px dashed var(--line-2);box-shadow:none;background:var(--bg-soft);--v:var(--blue)}
#lgo .vcard.other:hover{border-color:var(--blue);transform:translateY(-4px)}
#lgo .vcard.other::before{display:none}
#lgo .vcard.other .vicon{background:var(--blue-50);color:var(--blue)}
#lgo .vcard.other .vicon svg{stroke:var(--blue)}
#lgo .final{background:linear-gradient(135deg,#0f1623 0%,#1f2a3d 100%);border-radius:var(--r-lg);padding:56px 40px;text-align:center;position:relative;overflow:hidden}
#lgo .final::after{content:"";position:absolute;inset:0;background:radial-gradient(80% 120% at 90% 0,rgba(242,99,57,.22),transparent 55%);pointer-events:none}
#lgo .final .eyebrow{color:var(--orange-light)}
#lgo .final h2{color:#fff;font-size:clamp(27px,4vw,42px);font-weight:800;position:relative}
#lgo .final h2 em{font-style:normal;color:var(--orange-light)}
#lgo .final p{color:#c3ccd8;font-size:18px;margin:16px auto 0;max-width:46ch;position:relative}
#lgo .final .cta{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:30px;position:relative}
#lgo .btn-white{background:#fff;color:var(--ink)}
#lgo .btn-white:hover{transform:translateY(-1px)}
#lgo .btn-outline{border-color:rgba(255,255,255,.3);color:#fff;background:transparent}
#lgo .btn-outline:hover{border-color:#fff}
#lgo :focus-visible{outline:2.5px solid var(--orange);outline-offset:3px;border-radius:6px}
@media (max-width:900px){
  #lgo .hero .wrap{grid-template-columns:1fr;gap:36px}
  #lgo .stage{order:-1;min-height:auto;padding:12px 0}
  #lgo .bgrid{grid-template-columns:1fr}
  #lgo .vgrid{grid-template-columns:repeat(2,1fr)}
}
@media (max-width:560px){ #lgo .vgrid{grid-template-columns:1fr} #lgo .final{padding:40px 22px} }
@media (prefers-reduced-motion:reduce){#lgo *{transition:none!important}}
#lgo dialog.lgo-lead{border:none;border-radius:var(--r-lg);padding:0;max-width:470px;width:calc(100% - 32px);background:var(--card);color:var(--text);box-shadow:var(--shadow-lg)}
#lgo dialog.lgo-lead::backdrop{background:rgba(15,22,35,.55)}
#lgo .lgo-lead-in{padding:30px}
#lgo .lgo-lead-in h3{font-family:var(--lgo-display);font-size:22px;font-weight:700;color:var(--ink)}
#lgo .lgo-lead-in .sub{color:var(--muted);font-size:14px;margin:8px 0 22px}
#lgo .fld{display:block;margin-bottom:14px}
#lgo .fld span{display:block;font-size:13px;font-weight:600;color:var(--ink);margin-bottom:6px}
#lgo .fld input,#lgo .fld textarea{width:100%;padding:11px 13px;border:1px solid var(--line-2);border-radius:10px;background:var(--bg);color:var(--ink);font-family:var(--lgo-sans);font-size:14px}
#lgo .fld textarea{min-height:80px;resize:vertical}
#lgo .fld input:focus,#lgo .fld textarea:focus{outline:none;border-color:var(--orange);box-shadow:0 0 0 3px var(--orange-50)}
#lgo .lgo-consent{display:flex;gap:9px;align-items:flex-start;font-size:12.5px;line-height:1.5;color:var(--muted);margin:2px 0 16px;cursor:pointer}
#lgo .lgo-consent input[type=checkbox]{-webkit-appearance:checkbox;appearance:auto;width:17px;height:17px;margin:2px 0 0;flex:none;accent-color:var(--orange);cursor:pointer}
#lgo .lgo-consent a{color:var(--blue);text-decoration:underline}
#lgo .lead-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:8px}
</style>

<main id="lgo">

<section class="hero">
  <div class="wrap">
    <div>
      <div class="eyebrow">Rewards program · Web app</div>
      <h1>Reward customers with a single <em>scan</em>.</h1>
      <p class="lead">Your customer scans the QR and their card <b style="color:var(--ink)">opens instantly on their phone — no app store, no accounts</b>. And if they want, they add it to their home screen like a real app. With your own brand.</p>
      <div class="cta">
        <a class="btn btn-brand" href="https://showcase.nexify.gr/signup" target="_blank" rel="noopener">Start free</a>
        <a class="btn btn-ghost" href="#demo">Try it live</a>
        <a class="btn btn-ghost" href="#verticals">See the industries</a>
      </div>
      <div class="speed">
        <div><svg viewBox="0 0 24 24"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z"/></svg> Instant open</div>
        <div><svg viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg> No app store</div>
        <div><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M8 12h8M12 8v8"/></svg> Your brand</div>
      </div>
    </div>
    <div class="stage">
      <div class="phone">
        <div class="screen">
          <div class="app-top"><span>CaféGo</span><small>My card</small></div>
          <div class="ring"><div><b>7/10</b><span>stamps</span></div></div>
          <div class="prog">3 more for a free drink ☕</div>
          <div class="reward"><span class="g"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 12v10H4V12M2 7h20v5H2zM12 22V7M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7Z"/></svg></span> Your next reward awaits</div>
        </div>
        <div class="qr-badge">
          <div class="qr" aria-hidden="true"></div>
          <p><span>Scan</span> &amp; go</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="why">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Why it works</div>
      <h2>Fast for customers. Simple for you.</h2>
    </div>
    <div class="bgrid">
      <div class="bcard">
        <div class="bi"><svg viewBox="0 0 24 24"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z"/></svg></div>
        <h3>Opens with one scan</h3>
        <p>The card opens instantly in the browser — no app store, no waiting. And if they want, the customer installs it like a real app on Android, iPhone or tablet.</p>
      </div>
      <div class="bcard">
        <div class="bi"><svg viewBox="0 0 24 24"><path d="M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"/><path d="M2 21a7 7 0 0 1 14 0"/><path d="m17 8 2 2 4-4"/></svg></div>
        <h3>Simple for everyone</h3>
        <p>So simple it needs no training — neither for your staff nor your customers.</p>
      </div>
      <div class="bcard">
        <div class="bi"><svg viewBox="0 0 24 24"><path d="M12 3 3 7v6c0 5 4 8 9 9 5-1 9-4 9-9V7l-9-4Z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3>With your brand</h3>
        <p>Your own colors, logo and name. Customers see you — the technology stays in the background.</p>
      </div>
    </div>
  </div>
</section>

<section id="verticals" style="background:var(--bg-soft);border-top:1px solid var(--line);border-bottom:1px solid var(--line)">
  <div class="wrap">
    <div class="sec-head">
      <div class="eyebrow">Ready for your industry</div>
      <h2>Pick an industry — try it live now.</h2>
      <p>Each edition comes with the right rewards logic for your business. Click “Try it live” to enter a real demo card, in one click.</p>
    </div>
    <div class="vgrid">

      <article class="vcard" style="--v:var(--v-cafe)">
        <div class="vhead"><div class="vicon"><svg viewBox="0 0 24 24"><path d="M4 8h13v4a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V8Z"/><path d="M17 9h2.5a2.5 2.5 0 0 1 0 5H17"/><path d="M7 3v2M11 3v2"/></svg></div><div class="vname">Café<b>Go</b></div></div>
        <div class="vmech">Cafés &amp; food</div>
        <div class="vreward">A stamp card that fills on every visit — and a <b>free drink</b> at the end.</div>
        <a class="vlink" href="https://cafego.nexify.gr/" target="_blank" rel="noopener">Try it live <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
      </article>

      <article class="vcard" style="--v:var(--v-gym)">
        <div class="vhead"><div class="vicon"><svg viewBox="0 0 24 24"><path d="M6.5 6.5 17.5 17.5"/><path d="M3 8v8M6 5v14M18 5v14M21 8v8"/></svg></div><div class="vname">Gym<b>Go</b></div></div>
        <div class="vmech">Gyms &amp; studios</div>
        <div class="vreward">Points on every workout, turning into <b>gifts &amp; services</b> — a reason to come back.</div>
        <a class="vlink" href="https://gymgo.nexify.gr/" target="_blank" rel="noopener">Try it live <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
      </article>

      <article class="vcard" style="--v:var(--v-shop)">
        <div class="vhead"><div class="vicon"><svg viewBox="0 0 24 24"><path d="M6 2 3 6v13a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg></div><div class="vname">Shop<b>Go</b></div></div>
        <div class="vmech">Retail &amp; stores</div>
        <div class="vreward">Points on every purchase that turn into <b>value coupons</b> — automatically on the card.</div>
        <a class="vlink" href="https://shopgo.nexify.gr/" target="_blank" rel="noopener">Try it live <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
      </article>

      <article class="vcard" style="--v:var(--v-fuel)">
        <div class="vhead"><div class="vicon"><svg viewBox="0 0 24 24"><path d="M4 22V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v17"/><path d="M3 22h12"/><path d="M14 8h2.5a2 2 0 0 1 2 2v6a1.5 1.5 0 0 0 3 0V9l-2.5-2.5"/><path d="M7 8h4"/></svg></div><div class="vname">Fuel<b>Go</b></div></div>
        <div class="vmech">Fuel stations</div>
        <div class="vreward">Points on every refuel, with <b>gifts &amp; discounts</b> that bring the driver back.</div>
        <a class="vlink" href="https://fuelgo.nexify.gr/" target="_blank" rel="noopener">Try it live <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
      </article>

      <article class="vcard" style="--v:var(--v-estate)">
        <div class="vhead"><div class="vicon"><svg viewBox="0 0 24 24"><path d="m3 11 9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg></div><div class="vname">Estate<b>Go</b></div></div>
        <div class="vmech">Real estate agencies</div>
        <div class="vreward">Rewards for <b>every referral</b> and a journey that keeps the client engaged until closing.</div>
        <a class="vlink" href="https://estatego.nexify.gr/" target="_blank" rel="noopener">Try it live <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></a>
      </article>

      <article class="vcard other">
        <div class="vhead"><div class="vicon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M9.5 9a2.5 2.5 0 1 1 3.5 2.3c-.8.4-1 .8-1 1.7"/><path d="M12 17h.01"/></svg></div><div class="vname" style="color:var(--blue)">Another industry?</div></div>
        <div class="vmech" style="color:var(--blue)">Built to fit you</div>
        <div class="vreward">Our engine isn't locked to an industry. <b>Tell us what your business does</b> and we'll set it up for you.</div>
        <button class="vlink" type="button" data-open-lead style="color:var(--blue);background:none;border:0;padding:0;cursor:pointer;font:inherit;font-weight:700">Tell us your idea <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg></button>
      </article>

    </div>
  </div>
</section>

<section id="demo">
  <div class="wrap">
    <div class="final">
      <div class="eyebrow">Live, per industry</div>
      <h2>See the <em>live</em> app now.</h2>
      <p>Open each industry's live app from its first screen — sign-up, card, points and rewards, exactly as your customer sees them.</p>
      <div class="cta">
        <a class="btn btn-white" href="https://showcase.nexify.gr/signup" target="_blank" rel="noopener">Start free</a>
        <a class="btn btn-outline" href="https://showcase.nexify.gr/" target="_blank" rel="noopener">See all demos</a>
        <button class="btn btn-outline" type="button" data-open-lead>Book a presentation</button>
      </div>
    </div>
  </div>
</section>

<dialog id="leadDlg" class="lgo-lead">
  <form id="leadForm" class="lgo-lead-in">
    <h3>Tell us about your business</h3>
    <p class="sub">Send us a couple of lines and we'll reply with a LoyaltyGO proposal tailored to you.</p>
    <label class="fld"><span>Name</span><input name="cname" required></label>
    <label class="fld"><span>Business / industry</span><input name="biz" required placeholder="e.g. a bakery chain"></label>
    <label class="fld"><span>Email</span><input name="email" type="email" required></label>
    <label class="fld"><span>Phone (optional)</span><input name="phone" inputmode="tel"></label>
    <label class="fld"><span>What does your business do?</span><textarea name="msg" placeholder="Tell us a bit about your business and what you'd like to achieve."></textarea></label>
    <input type="hidden" name="source" value="nexify.gr/en">
    <input name="company_url" tabindex="-1" autocomplete="off" aria-hidden="true" style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0">
    <label class="lgo-consent">
      <input type="checkbox" name="gdpr_consent" value="1" required>
      <span>I consent to Nexify processing my details to contact me about LoyaltyGO, in accordance with the <a href="privacy.php" target="_blank" rel="noopener">Privacy Policy</a>. *</span>
    </label>
    <p id="leadErr" class="sub" style="display:none;color:#dc2626;margin:-6px 0 12px"></p>
    <div class="lead-actions">
      <button type="button" class="btn btn-ghost" id="leadCancel">Cancel</button>
      <button type="submit" class="btn btn-brand">Send interest</button>
    </div>
  </form>
</dialog>

</main>

<script>
(function(){
  var dlg=document.getElementById('leadDlg');
  if(!dlg||!dlg.showModal)return;
  document.querySelectorAll('[data-open-lead]').forEach(function(b){b.addEventListener('click',function(){dlg.showModal();});});
  document.getElementById('leadCancel').addEventListener('click',function(){dlg.close();});
  document.getElementById('leadForm').addEventListener('submit',function(e){
    e.preventDefault();
    var f=e.target, btn=f.querySelector('button[type=submit]'), err=document.getElementById('leadErr');
    err.style.display='none'; btn.disabled=true; var label=btn.textContent; btn.textContent='Sending…';
    fetch('https://showcase.nexify.gr/showcase/lead',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:new URLSearchParams(new FormData(f))})
      .then(function(r){return r.json();})
      .then(function(j){
        if(j&&j.ok){
          f.innerHTML='<h3>✓ Thank you!</h3><p class="sub" style="margin-top:10px">We received your interest — we\'ll be in touch soon at the email you provided.</p><div class="lead-actions"><button type="button" class="btn btn-brand" onclick="document.getElementById(\'leadDlg\').close()">Close</button></div>';
        } else { throw new Error((j&&j.error)||'err'); }
      })
      .catch(function(){
        err.textContent='Something went wrong — please try again or email us directly at loyalty@nexify.gr.';
        err.style.display='block'; btn.disabled=false; btn.textContent=label;
      });
  });
})();
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
