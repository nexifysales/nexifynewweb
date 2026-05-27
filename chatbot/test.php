<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NexiFy Chatbot — Test Interface</title>
<script src="../libs/tailwind.js"></script>
<style>
  body { font-family: system-ui, -apple-system, sans-serif; background: #0f0f18; color: #e0e0e8; }
  .chat-bubble { border-radius: 18px; max-width: 80%; }
  .user-bubble { background: #ea580c; color: white; border-bottom-right-radius: 4px; }
  .bot-bubble { background: #1a1a2e; border: 1px solid rgba(255,255,255,.1); border-bottom-left-radius: 4px; }
  .typing-dot { animation: bounce 1s infinite; }
  .typing-dot:nth-child(2) { animation-delay: 0.2s; }
  .typing-dot:nth-child(3) { animation-delay: 0.4s; }
  @keyframes bounce { 0%, 60%, 100% { transform: translateY(0); } 30% { transform: translateY(-6px); } }
  input[type="text"] { background: #111827; border: 1px solid rgba(255,255,255,.15); border-radius: 12px; color: #e0e0e8; outline: none; }
  input[type="text"]:focus { border-color: #ea580c; }
  .suggestion-btn { background: #1a1a2e; border: 1px solid rgba(255,255,255,.12); color: #94a3b8; border-radius: 8px; font-size: .8rem; padding: 6px 14px; cursor: pointer; transition: all .2s; }
  .suggestion-btn:hover { border-color: #ea580c; color: #ea580c; }
  .link-btn { display: inline-flex; align-items: center; gap: 4px; background: rgba(234,88,12,.15); border: 1px solid rgba(234,88,12,.3); color: #fb923c; border-radius: 6px; font-size: .78rem; padding: 4px 10px; margin: 3px 3px 0 0; text-decoration: none; }
  .link-btn:hover { background: rgba(234,88,12,.25); }
  #chat-messages { scroll-behavior: smooth; }
</style>
</head>
<body class="min-h-screen flex flex-col">

<!-- Header -->
<div style="background: #111827; border-bottom: 1px solid rgba(255,255,255,.08);" class="px-6 py-3 flex items-center justify-between">
  <div class="flex items-center gap-3">
    <a href="../index.php" class="text-orange-400 hover:text-orange-300 text-sm">← Nexify.gr</a>
    <span class="text-gray-600">|</span>
    <span class="text-white font-semibold">🤖 Chatbot Test Interface</span>
  </div>
  <a href="knowledge.php" class="text-xs bg-gray-700 hover:bg-gray-600 text-gray-300 px-3 py-1.5 rounded-lg transition">Knowledge Base</a>
</div>

<div class="flex-1 flex flex-col max-w-2xl mx-auto w-full px-4 py-6">

  <!-- Chat window -->
  <div id="chat-messages" class="flex-1 space-y-4 overflow-y-auto pb-4 max-h-96 min-h-64 flex flex-col justify-start">

    <!-- Bot intro -->
    <div class="flex items-start gap-2">
      <div class="w-8 h-8 rounded-full bg-orange-600 flex items-center justify-center text-sm flex-shrink-0 mt-1">🤖</div>
      <div>
        <div class="chat-bubble bot-bubble px-4 py-3">
          <p class="text-sm">Γεια σου! Είμαι ο βοηθός της <b>NexiFy</b>. Μπορώ να σε βοηθήσω με ερωτήσεις για:</p>
          <ul class="text-sm mt-2 space-y-1 text-gray-300">
            <li>⚡ Ενέργεια &amp; σύγκριση παρόχων</li>
            <li>🏛️ Φορολογική έδρα &amp; virtual office</li>
            <li>💻 Τεχνολογία, CRM &amp; ERP</li>
            <li>📞 Τηλεφωνικό κέντρο</li>
            <li>🤝 Πρόγραμμα συνεργατών</li>
          </ul>
        </div>
        <div class="flex flex-wrap gap-2 mt-2">
          <button class="suggestion-btn" onclick="ask(this.textContent)">Πόσο κοστίζει η φορολογική έδρα;</button>
          <button class="suggestion-btn" onclick="ask(this.textContent)">Τι είναι ο MR. Revmas;</button>
          <button class="suggestion-btn" onclick="ask(this.textContent)">Έχω ανάγκη από CRM</button>
          <button class="suggestion-btn" onclick="ask(this.textContent)">Πώς γίνομαι συνεργάτης;</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Input area -->
  <div class="mt-4 border-t border-gray-800 pt-4">
    <form id="chat-form" class="flex gap-2">
      <input type="text" id="user-input" placeholder="Γράψε την ερώτησή σου..." class="flex-1 px-4 py-3 text-sm" autocomplete="off">
      <button type="submit" class="bg-orange-600 hover:bg-orange-500 text-white px-5 py-3 rounded-xl text-sm font-medium transition">
        Αποστολή
      </button>
    </form>
    <p class="text-xs text-gray-600 mt-2 text-center">Powered by NexiFy Knowledge Base · <a href="knowledge.php" class="text-gray-500 hover:text-gray-400">Browse KB</a></p>
  </div>
</div>

<!-- API Test panel (collapsible) -->
<div class="max-w-2xl mx-auto w-full px-4 pb-8">
  <details class="bg-gray-900 rounded-xl border border-gray-800">
    <summary class="px-4 py-3 text-sm text-gray-400 cursor-pointer hover:text-gray-300">🔧 API Test Panel</summary>
    <div class="px-4 pb-4">
      <div class="grid grid-cols-2 gap-2 mt-2">
        <button onclick="apiTest('api.php?action=all')" class="text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg transition">GET /api?action=all</button>
        <button onclick="apiTest('api.php?action=faq')" class="text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg transition">GET /api?action=faq</button>
        <button onclick="apiTest('api.php?action=service&name=energy')" class="text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg transition">GET service=energy</button>
        <button onclick="apiTest('api.php?action=contact')" class="text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg transition">GET contact</button>
        <button onclick="apiTest('api.php?action=search&q=ρεύμα')" class="text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg transition">GET search q=ρεύμα</button>
        <button onclick="apiTest('api.php?action=category&cat=virtual_office')" class="text-xs bg-gray-800 hover:bg-gray-700 text-gray-300 px-3 py-2 rounded-lg transition">GET cat=virtual_office</button>
      </div>
      <pre id="api-result" class="text-xs text-green-400 bg-black rounded-lg p-3 mt-3 overflow-auto max-h-48 hidden"></pre>
    </div>
  </details>
</div>

<script>
const chatMessages = document.getElementById('chat-messages');
const chatForm = document.getElementById('chat-form');
const userInput = document.getElementById('user-input');

function scrollBottom() {
  chatMessages.scrollTop = chatMessages.scrollHeight;
}

function addUserMessage(text) {
  const div = document.createElement('div');
  div.className = 'flex items-start gap-2 flex-row-reverse';
  div.innerHTML = `
    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-sm flex-shrink-0 mt-1">👤</div>
    <div class="chat-bubble user-bubble px-4 py-3 text-sm">${escapeHtml(text)}</div>
  `;
  chatMessages.appendChild(div);
  scrollBottom();
}

function addTypingIndicator() {
  const div = document.createElement('div');
  div.id = 'typing-indicator';
  div.className = 'flex items-start gap-2';
  div.innerHTML = `
    <div class="w-8 h-8 rounded-full bg-orange-600 flex items-center justify-center text-sm flex-shrink-0 mt-1">🤖</div>
    <div class="chat-bubble bot-bubble px-4 py-3 flex gap-1 items-center">
      <span class="typing-dot w-2 h-2 rounded-full bg-gray-500 block"></span>
      <span class="typing-dot w-2 h-2 rounded-full bg-gray-500 block"></span>
      <span class="typing-dot w-2 h-2 rounded-full bg-gray-500 block"></span>
    </div>
  `;
  chatMessages.appendChild(div);
  scrollBottom();
}

function removeTypingIndicator() {
  const el = document.getElementById('typing-indicator');
  if (el) el.remove();
}

function addBotMessage(response) {
  const div = document.createElement('div');
  div.className = 'flex items-start gap-2';

  let linksHtml = '';
  if (response.links && response.links.length > 0) {
    linksHtml = '<div class="mt-2">' +
      response.links.map(l => `<a href="../${escapeHtml(l.url)}" class="link-btn" target="_blank">→ ${escapeHtml(l.label)}</a>`).join('') +
      '</div>';
  }

  let relatedHtml = '';
  if (response.related && response.related.length > 0) {
    const rItems = response.related.filter(r => r.question).map(r =>
      `<button class="suggestion-btn" onclick="ask(this.textContent)">${escapeHtml(r.question)}</button>`
    ).join('');
    if (rItems) {
      relatedHtml = `<div class="flex flex-wrap gap-2 mt-2">${rItems}</div>`;
    }
  }

  let confidenceHtml = '';
  if (response.confidence !== undefined) {
    const conf = Math.min(100, Math.max(0, response.confidence));
    const color = conf >= 70 ? 'text-green-400' : conf >= 40 ? 'text-yellow-400' : 'text-red-400';
    confidenceHtml = `<div class="text-xs ${color} mt-1">Confidence: ${conf}%</div>`;
  }

  div.innerHTML = `
    <div class="w-8 h-8 rounded-full bg-orange-600 flex items-center justify-center text-sm flex-shrink-0 mt-1">🤖</div>
    <div>
      <div class="chat-bubble bot-bubble px-4 py-3">
        <p class="text-sm leading-relaxed">${escapeHtml(response.message || 'Δεν κατάλαβα την ερώτησή σου.')}</p>
        ${linksHtml}
        ${confidenceHtml}
      </div>
      ${relatedHtml}
    </div>
  `;
  chatMessages.appendChild(div);
  scrollBottom();
}

function escapeHtml(str) {
  const div = document.createElement('div');
  div.textContent = str || '';
  return div.innerHTML;
}

async function ask(text) {
  if (!text.trim()) return;

  addUserMessage(text);
  userInput.value = '';
  addTypingIndicator();

  try {
    const res = await fetch('api.php?action=chat', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ q: text })
    });
    const data = await res.json();
    removeTypingIndicator();
    if (data.success && data.response) {
      addBotMessage(data.response);
    } else {
      addBotMessage({ message: 'Προέκυψε σφάλμα. Παρακαλώ δοκίμασε ξανά.', links: [], confidence: 0 });
    }
  } catch (e) {
    removeTypingIndicator();
    addBotMessage({ message: 'Δεν ήταν δυνατή η επικοινωνία με τη γνωσιακή βάση. Παρακαλώ στείλε email στο info@nexify.gr.', links: [] });
  }
}

chatForm.addEventListener('submit', function(e) {
  e.preventDefault();
  const text = userInput.value.trim();
  if (text) ask(text);
});

// API Test Panel
async function apiTest(url) {
  const pre = document.getElementById('api-result');
  pre.classList.remove('hidden');
  pre.textContent = 'Loading...';
  try {
    const res = await fetch(url);
    const data = await res.json();
    pre.textContent = JSON.stringify(data, null, 2);
  } catch(e) {
    pre.textContent = 'Error: ' + e.message;
  }
}
</script>
</body>
</html>
