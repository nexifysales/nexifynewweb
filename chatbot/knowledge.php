<?php
/**
 * NexiFy — Knowledge Base Browser
 * Allows viewing and searching the chatbot knowledge base
 */
$pageTitle = 'Knowledge Base — NexiFy Chatbot';

// Load knowledge base
$kbFile = __DIR__ . '/knowledge-base.json';
$kb = json_decode(file_get_contents($kbFile), true);
$categories = [
    'general'       => ['label' => '🏢 Γενικά', 'count' => 0],
    'energy'        => ['label' => '⚡ Ενέργεια', 'count' => 0],
    'virtual_office'=> ['label' => '🏛️ Φορολογική Έδρα', 'count' => 0],
    'technology'    => ['label' => '💻 Τεχνολογία', 'count' => 0],
    'call_center'   => ['label' => '📞 Τηλεφωνικό Κέντρο', 'count' => 0],
    'partners'      => ['label' => '🤝 Συνεργάτες', 'count' => 0],
    'careers'       => ['label' => '👔 Καριέρα', 'count' => 0],
];

// Count per category
foreach ($kb['faq'] as $faq) {
    if (isset($categories[$faq['category']])) {
        $categories[$faq['category']]['count']++;
    }
}

$filterCat = $_GET['cat'] ?? '';
$searchQ   = trim($_GET['q'] ?? '');

// Filter FAQ
$faqs = $kb['faq'];
if ($filterCat) {
    $faqs = array_values(array_filter($faqs, fn($f) => $f['category'] === $filterCat));
}
if ($searchQ) {
    $sq = strtolower($searchQ);
    $faqs = array_values(array_filter($faqs, function($f) use ($sq) {
        return str_contains(strtolower($f['question']), $sq) ||
               str_contains(strtolower($f['answer']), $sq) ||
               str_contains(strtolower(implode(' ', $f['keywords'])), $sq);
    }));
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle) ?></title>
<script src="../libs/tailwind.js"></script>
<link rel="stylesheet" href="../libs/fontawesome.min.css">
<style>
  body { font-family: system-ui, -apple-system, sans-serif; background: #0f0f18; color: #e0e0e8; }
  .card { background: #1a1a2e; border: 1px solid rgba(255,255,255,.1); border-radius: 12px; }
  .badge { display: inline-block; padding: 2px 10px; border-radius: 999px; font-size: .75rem; font-weight: 600; }
  .badge-general       { background: #374151; color: #d1d5db; }
  .badge-energy        { background: #78350f; color: #fcd34d; }
  .badge-virtual_office{ background: #1e3a5f; color: #93c5fd; }
  .badge-technology    { background: #1f2d3d; color: #67e8f9; }
  .badge-call_center   { background: #3b0764; color: #e879f9; }
  .badge-partners      { background: #052e16; color: #4ade80; }
  .badge-careers       { background: #431407; color: #fb923c; }
  .highlight { background: rgba(251, 146, 60, .25); border-radius: 3px; padding: 0 2px; }
  .faq-card { transition: border-color .2s; }
  .faq-card:hover { border-color: rgba(251, 146, 60, .4); }
  input, select { background: #111827; color: #e0e0e8; border: 1px solid rgba(255,255,255,.15); border-radius: 8px; padding: 10px 16px; outline: none; }
  input:focus, select:focus { border-color: #f97316; }
  .service-card { background: #111827; border: 1px solid rgba(255,255,255,.08); border-radius: 10px; padding: 16px; }
</style>
</head>
<body class="min-h-screen">

<!-- Header -->
<div style="background: #111827; border-bottom: 1px solid rgba(255,255,255,.08);" class="px-6 py-4">
  <div class="max-w-7xl mx-auto flex items-center justify-between flex-wrap gap-3">
    <div class="flex items-center gap-3">
      <a href="../index.php" class="text-orange-400 hover:text-orange-300 text-sm">← Nexify.gr</a>
      <span class="text-gray-600">|</span>
      <h1 class="text-lg font-bold text-white">🤖 Knowledge Base</h1>
      <span class="text-gray-500 text-sm">Chatbot Data</span>
    </div>
    <div class="flex gap-2">
      <a href="api.php?action=all" target="_blank" class="text-xs bg-gray-700 hover:bg-gray-600 text-gray-300 px-3 py-1.5 rounded-lg transition">JSON Export</a>
      <a href="api.php?action=faq" target="_blank" class="text-xs bg-gray-700 hover:bg-gray-600 text-gray-300 px-3 py-1.5 rounded-lg transition">FAQ API</a>
      <a href="test.php" class="text-xs bg-orange-700 hover:bg-orange-600 text-white px-3 py-1.5 rounded-lg transition">Test Chatbot →</a>
    </div>
  </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

    <!-- Sidebar: Categories -->
    <aside>
      <div class="card p-4 mb-4">
        <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">Κατηγορίες</h2>
        <ul class="space-y-1">
          <li>
            <a href="knowledge.php" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm transition <?= !$filterCat ? 'bg-orange-900 bg-opacity-30 text-orange-400' : 'text-gray-400 hover:bg-gray-800' ?>">
              <span>Όλες</span>
              <span class="text-xs text-gray-500"><?= count($kb['faq']) ?></span>
            </a>
          </li>
          <?php foreach ($categories as $slug => $cat): ?>
          <li>
            <a href="knowledge.php?cat=<?= urlencode($slug) ?>" class="flex items-center justify-between px-3 py-2 rounded-lg text-sm transition <?= $filterCat === $slug ? 'bg-orange-900 bg-opacity-30 text-orange-400' : 'text-gray-400 hover:bg-gray-800' ?>">
              <span><?= htmlspecialchars($cat['label']) ?></span>
              <span class="text-xs text-gray-500"><?= $cat['count'] ?></span>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- API Links -->
      <div class="card p-4">
        <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">API Endpoints</h2>
        <ul class="space-y-2 text-xs text-gray-400">
          <li><code class="text-blue-400">GET api.php?action=search&q=ρεύμα</code></li>
          <li><code class="text-blue-400">POST api.php?action=chat</code> <small>{q: "message"}</small></li>
          <li><code class="text-blue-400">GET api.php?action=faq&category=energy</code></li>
          <li><code class="text-blue-400">GET api.php?action=service&name=energy</code></li>
          <li><code class="text-blue-400">GET api.php?action=contact</code></li>
          <li><code class="text-blue-400">GET api.php?action=company</code></li>
          <li><code class="text-blue-400">GET api.php?action=all</code></li>
        </ul>
      </div>
    </aside>

    <!-- Main content -->
    <main class="lg:col-span-3">

      <!-- Stats bar -->
      <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="card p-4 text-center">
          <div class="text-2xl font-bold text-orange-400"><?= count($kb['faq']) ?></div>
          <div class="text-xs text-gray-500 mt-1">FAQ Entries</div>
        </div>
        <div class="card p-4 text-center">
          <div class="text-2xl font-bold text-blue-400"><?= count($kb['services']) ?></div>
          <div class="text-xs text-gray-500 mt-1">Services</div>
        </div>
        <div class="card p-4 text-center">
          <div class="text-2xl font-bold text-green-400"><?= count($categories) ?></div>
          <div class="text-xs text-gray-500 mt-1">Categories</div>
        </div>
      </div>

      <!-- Search bar -->
      <form method="GET" class="mb-6 flex gap-3">
        <?php if ($filterCat): ?>
          <input type="hidden" name="cat" value="<?= htmlspecialchars($filterCat) ?>">
        <?php endif; ?>
        <input type="text" name="q" placeholder="Αναζήτηση στη γνωσιακή βάση..." value="<?= htmlspecialchars($searchQ) ?>" class="flex-1">
        <button type="submit" class="bg-orange-600 hover:bg-orange-500 text-white px-5 py-2 rounded-lg text-sm font-medium transition">Αναζήτηση</button>
        <?php if ($searchQ): ?>
          <a href="knowledge.php<?= $filterCat ? '?cat='.$filterCat : '' ?>" class="bg-gray-700 hover:bg-gray-600 text-gray-300 px-4 py-2 rounded-lg text-sm transition flex items-center">✕</a>
        <?php endif; ?>
      </form>

      <!-- FAQ Results -->
      <div class="mb-2 text-sm text-gray-500">
        <?= $searchQ ? 'Αποτελέσματα για "' . htmlspecialchars($searchQ) . '": ' . count($faqs) . ' εγγραφές' : count($faqs) . ' εγγραφές' ?>
      </div>

      <div class="space-y-3">
        <?php if (empty($faqs)): ?>
          <div class="card p-8 text-center text-gray-500">
            <div class="text-4xl mb-3">🔍</div>
            <p>Δεν βρέθηκαν αποτελέσματα για "<?= htmlspecialchars($searchQ) ?>"</p>
          </div>
        <?php else: ?>
          <?php foreach ($faqs as $faq): ?>
          <div class="card faq-card p-4">
            <div class="flex items-start gap-3">
              <span class="badge badge-<?= htmlspecialchars($faq['category']) ?> mt-0.5 flex-shrink-0">
                <?= htmlspecialchars($categories[$faq['category']]['label'] ?? $faq['category']) ?>
              </span>
              <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-white text-sm mb-1">
                  <?php
                  $q = htmlspecialchars($faq['question']);
                  if ($searchQ) {
                    $q = preg_replace('/(' . preg_quote(htmlspecialchars($searchQ), '/') . ')/iu', '<mark class="highlight">$1</mark>', $q);
                  }
                  echo $q;
                  ?>
                </h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                  <?php
                  $a = htmlspecialchars($faq['answer']);
                  if ($searchQ) {
                    $a = preg_replace('/(' . preg_quote(htmlspecialchars($searchQ), '/') . ')/iu', '<mark class="highlight">$1</mark>', $a);
                  }
                  echo $a;
                  ?>
                </p>
                <div class="mt-2 flex flex-wrap gap-1">
                  <?php foreach ($faq['keywords'] as $kw): ?>
                  <span class="text-xs bg-gray-800 text-gray-500 px-2 py-0.5 rounded"><?= htmlspecialchars($kw) ?></span>
                  <?php endforeach; ?>
                </div>
              </div>
              <span class="text-xs text-gray-600 flex-shrink-0"><?= htmlspecialchars($faq['id']) ?></span>
            </div>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Services Section -->
      <?php if (!$filterCat && !$searchQ): ?>
      <div class="mt-10">
        <h2 class="text-lg font-bold text-white mb-4">📋 Υπηρεσίες (Services Data)</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <?php foreach ($kb['services'] as $key => $service): ?>
          <div class="service-card">
            <div class="flex items-center gap-2 mb-2">
              <span class="text-xs font-bold text-orange-400">Πυλώνας <?= htmlspecialchars($service['pillar']) ?></span>
            </div>
            <h3 class="font-semibold text-white text-sm mb-1"><?= htmlspecialchars($service['name']) ?></h3>
            <p class="text-gray-500 text-xs leading-relaxed"><?= htmlspecialchars($service['description']) ?></p>
            <?php if (!empty($service['page_url'])): ?>
            <a href="../<?= htmlspecialchars($service['page_url']) ?>" class="text-xs text-blue-400 hover:text-blue-300 mt-2 inline-block">→ <?= htmlspecialchars($service['page_url']) ?></a>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Company Info -->
      <div class="mt-10">
        <h2 class="text-lg font-bold text-white mb-4">🏢 Company Info</h2>
        <div class="card p-5">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 class="text-sm font-semibold text-gray-400 mb-2">Βασικά στοιχεία</h3>
              <p class="text-sm text-gray-300"><b>Επωνυμία:</b> <?= htmlspecialchars($kb['company']['name']) ?></p>
              <p class="text-sm text-gray-300"><b>ΑΦΜ:</b> <?= htmlspecialchars($kb['company']['afm']) ?></p>
              <p class="text-sm text-gray-300"><b>ΓΕΜΗ:</b> <?= htmlspecialchars($kb['company']['gemi']) ?></p>
              <p class="text-sm text-gray-300 mt-2"><?= htmlspecialchars($kb['company']['description']) ?></p>
            </div>
            <div>
              <h3 class="text-sm font-semibold text-gray-400 mb-2">Επικοινωνία</h3>
              <p class="text-sm text-gray-300"><b>Τηλ:</b> <?= htmlspecialchars($kb['company']['contact']['phone_display']) ?></p>
              <p class="text-sm text-gray-300"><b>Email:</b> <?= htmlspecialchars($kb['company']['contact']['email_general']) ?></p>
              <p class="text-sm text-gray-300"><b>Sales:</b> <?= htmlspecialchars($kb['company']['contact']['email_sales']) ?></p>
              <p class="text-sm text-gray-300"><b>HR:</b> <?= htmlspecialchars($kb['company']['contact']['email_hr']) ?></p>
              <p class="text-sm text-gray-300 mt-2"><b>Ώρες:</b> <?= htmlspecialchars($kb['company']['contact']['hours']) ?></p>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>

    </main>
  </div>
</div>

</body>
</html>
