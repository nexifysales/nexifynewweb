<?php
$pageTitle       = 'FAQ — NexiFy';
$pageDescription = 'Frequently asked questions about NexiFy. Information about energy, registered office, technology and partnerships.';
$pageCanonical   = 'https://nexify.gr/en/faq.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-header" data-testid="page-header">
  <div class="container">
    <div class="breadcrumbs"><a href="index.php">Home</a> · FAQ</div>
    <h1>Frequently Asked <span style="color:var(--c-orange-light)">Questions</span></h1>
    <p>If you can't find the answer you're looking for, email us at <a href="mailto:info@nexify.gr" style="color:#fff;text-decoration:underline">info@nexify.gr</a> or call +30 210 999 6300.</p>
  </div>
</section>

<section class="section" data-testid="faq-section">
  <div class="container container-narrow">

    <h2 style="margin-bottom:30px">About NexiFy</h2>

    <details class="faq-item" open data-testid="faq-general-1">
      <summary>What exactly are you? A call center, an energy company, or an IT firm?</summary>
      <div class="faq-body">We are a combination of all of the above — in a non-traditional way. We operate as a unified partner covering sales, technology and support, so our clients don't need to coordinate multiple different providers. Not everyone needs every service — we adapt to your needs.</div>
    </details>

    <details class="faq-item" data-testid="faq-general-2">
      <summary>Why not work with 2–3 separate specialists instead?</summary>
      <div class="faq-body">You can, and many do. The difference is that typically: (1) they don't communicate with each other, (2) there's no single point of responsibility, (3) time and money is lost in coordination. We take on the coordination and delivery responsibility.</div>
    </details>

    <details class="faq-item" data-testid="faq-general-3">
      <summary>Will I pay more because you bundle everything together?</summary>
      <div class="faq-body">Usually the opposite. Because most services are already organized, clients pay only for what they need — with no setup costs or trial and error. Most importantly, they save the hidden cost of their own time.</div>
    </details>

    <details class="faq-item" data-testid="faq-general-4">
      <summary>What if I only need one service?</summary>
      <div class="faq-body">No problem. Many clients start with just one area (e.g. energy or a website) and we explore further needs as we go. There's no commitment to "packages".</div>
    </details>

    <details class="faq-item" data-testid="faq-general-5">
      <summary>Who are your providers &amp; partners?</summary>
      <div class="faq-body">In energy, we work with all major Greek electricity and gas providers through our own <b>MR. Revmas</b> platform for live pricing and intelligent matching. In technology, with established providers such as MyNext, C2 and Pelatologio. We handle the implementation and support — you have a single point of contact.</div>
    </details>

    <details class="faq-item" data-testid="faq-general-6">
      <summary>What happens if something doesn't work as expected?</summary>
      <div class="faq-body">We don't do "one-shot" services. We always start with a small, controlled scope and adjust accordingly. The goal is a long-term partnership — not just a sale.</div>
    </details>

    <details class="faq-item" data-testid="faq-general-7">
      <summary>Who is NexiFy NOT a good fit for?</summary>
      <div class="faq-body">We're not a good fit for businesses that want to do everything in-house, or those exclusively seeking the lowest price. We're the right fit for those who want organisation, flexibility and a clear working relationship.</div>
    </details>

    <details class="faq-item" data-testid="faq-general-8">
      <summary>How quickly can we get started?</summary>
      <div class="faq-body">It depends on the service. In many cases we can start immediately. For more complex needs, we're talking a few days to a few weeks. The first step is understanding what you really need.</div>
    </details>

    <h2 style="margin:60px 0 30px">Energy</h2>

    <details class="faq-item" data-testid="faq-energy-1">
      <summary>What do I gain by switching provider through NexiFy?</summary>
      <div class="faq-body">We compare all providers and negotiate the best plan for your consumption profile. We typically achieve 15–40% savings on an annual basis. No need to call anyone — we handle the switching process for you.</div>
    </details>

    <details class="faq-item" data-testid="faq-energy-2">
      <summary>Do I pay anything for the comparison service?</summary>
      <div class="faq-body">No. The comparison is free. We are compensated by the provider you ultimately choose — like an agency commission. This means we have every incentive to recommend what truly fits you.</div>
    </details>

    <details class="faq-item" data-testid="faq-energy-3">
      <summary>I have a business with high consumption or multiple meters. Can you help?</summary>
      <div class="faq-body">Yes. We have a specialised team for business clients, office complexes and multi-site retail chains. We negotiate corporate contracts and custom terms based on your consumption profile.</div>
    </details>

    <h2 style="margin:60px 0 30px">Registered Office</h2>

    <details class="faq-item" data-testid="faq-vo-1">
      <summary>Is the registered office address fully legal?</summary>
      <div class="faq-body">Yes, absolutely. It applies to service businesses, with a legitimate professional address and full compliance coverage. It does not apply to commercial activity or product storage.</div>
    </details>

    <details class="faq-item" data-testid="faq-vo-2">
      <summary>Do I actually receive my mail?</summary>
      <div class="faq-body">Yes. We receive all correspondence in your name (registered post, tax authority, banks) and digitise/archive it. We notify you immediately for urgent documents.</div>
    </details>

    <details class="faq-item" data-testid="faq-vo-3">
      <summary>How much does the most affordable package cost?</summary>
      <div class="faq-body">€180 for three months, including all charges. No hidden fees — utility bills are covered by us. See all <a href="virtual-office.php">packages here</a>.</div>
    </details>

    <h2 style="margin:60px 0 30px">Technology</h2>

    <details class="faq-item" data-testid="faq-tech-1">
      <summary>Are you developers or resellers?</summary>
      <div class="faq-body">Both. We have an in-house technical team for custom AI development, automations and integrations. We are also official partners for established solutions (Oxygen ERP, MyNext, Pelatologio, Cloud Hosting providers) so we can offer what suits your needs — without pushing our own products.</div>
    </details>

    <details class="faq-item" data-testid="faq-tech-2">
      <summary>I already have a CRM/ERP. Can you integrate it?</summary>
      <div class="faq-body">Yes. We work with all major CRMs (HubSpot, Salesforce, Pipedrive, Odoo) and most Greek ERPs. If a ready-made integration doesn't exist, we build a custom API.</div>
    </details>

    <h2 style="margin:60px 0 30px">Working Together</h2>

    <details class="faq-item" data-testid="faq-coop-1">
      <summary>What's the next step if we decide to proceed?</summary>
      <div class="faq-body">A short, focused needs discussion. No commitments, no generic packages — just to see if and how we can help.</div>
    </details>

    <details class="faq-item" data-testid="faq-coop-2">
      <summary>How do most of your clients typically start?</summary>
      <div class="faq-body">Usually with something simple — energy, a website or infrastructure — and we build the relationship gradually. Over time we add whatever is needed.</div>
    </details>

  </div>
</section>

<section class="section section-soft" data-testid="faq-cta-section">
  <div class="container">
    <div class="cta-box reveal">
      <h2>Didn't find the answer you were looking for?</h2>
      <p>Send us an email — we respond within 1 business day.</p>
      <div class="btn-row center">
        <a href="contact.php" class="btn btn-primary btn-lg" data-testid="faq-contact-btn">Send a Message →</a>
        <a href="mailto:info@nexify.gr" class="btn btn-ghost btn-lg">✉️ info@nexify.gr</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
