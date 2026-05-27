/**
 * NexiFy Chatbot Widget
 * Embeddable floating chatbot powered by the Knowledge Base API
 *
 * Usage:
 *   <script src="chatbot/widget.js" data-api="chatbot/api.php" data-site-root="../"></script>
 *
 * Or initialize manually:
 *   NexifyBot.init({ apiUrl: 'chatbot/api.php', siteRoot: '../' });
 */

(function() {
  'use strict';

  var SCRIPT_TAG = document.currentScript;
  var API_URL = (SCRIPT_TAG && SCRIPT_TAG.getAttribute('data-api')) || 'chatbot/api.php';
  var SITE_ROOT = (SCRIPT_TAG && SCRIPT_TAG.getAttribute('data-site-root')) || '';

  var COLORS = {
    primary: '#ea580c',
    primaryDark: '#c2410c',
    bg: '#111827',
    bgCard: '#1a1a2e',
    border: 'rgba(255,255,255,0.1)',
    text: '#e0e0e8',
    muted: '#9ca3af',
    userBubble: '#ea580c',
    botBubble: '#1a1a2e'
  };

  var SUGGESTIONS = [
    'Τι υπηρεσίες προσφέρετε;',
    'Πόσο κοστίζει η φορολογική έδρα;',
    'Τι είναι ο MR. Revmas;',
    'Πώς επικοινωνώ μαζί σας;'
  ];

  var GREETING = 'Γεια σου! Είμαι ο βοηθός της NexiFy 🤖\nΜπορώ να απαντήσω σε ερωτήσεις για ενέργεια, φορολογική έδρα, τεχνολογία και υπηρεσίες μας.';

  function createWidget() {
    // Inject CSS
    var style = document.createElement('style');
    style.textContent = [
      '#nexify-bot-btn{position:fixed;bottom:24px;right:24px;z-index:9999;width:56px;height:56px;border-radius:50%;background:' + COLORS.primary + ';border:none;cursor:pointer;box-shadow:0 4px 20px rgba(234,88,12,.5);display:flex;align-items:center;justify-content:center;transition:all .2s;color:#fff;font-size:24px}',
      '#nexify-bot-btn:hover{transform:scale(1.08);background:' + COLORS.primaryDark + '}',
      '#nexify-bot-panel{position:fixed;bottom:90px;right:24px;z-index:9998;width:340px;height:480px;background:' + COLORS.bg + ';border:1px solid ' + COLORS.border + ';border-radius:16px;box-shadow:0 8px 40px rgba(0,0,0,.6);display:flex;flex-direction:column;overflow:hidden;opacity:0;transform:translateY(20px) scale(.95);transition:all .25s cubic-bezier(.4,0,.2,1);pointer-events:none}',
      '#nexify-bot-panel.open{opacity:1;transform:translateY(0) scale(1);pointer-events:all}',
      '#nexify-bot-header{background:' + COLORS.primary + ';padding:14px 16px;display:flex;align-items:center;gap:10px;flex-shrink:0}',
      '#nexify-bot-header .nb-title{color:#fff;font-weight:700;font-size:14px;flex:1}',
      '#nexify-bot-header .nb-close{background:none;border:none;color:rgba(255,255,255,.8);cursor:pointer;font-size:18px;line-height:1;padding:4px;border-radius:4px}',
      '#nexify-bot-header .nb-close:hover{color:#fff;background:rgba(0,0,0,.2)}',
      '#nexify-bot-messages{flex:1;overflow-y:auto;padding:16px;display:flex;flex-direction:column;gap:10px;scroll-behavior:smooth}',
      '#nexify-bot-messages::-webkit-scrollbar{width:4px}',
      '#nexify-bot-messages::-webkit-scrollbar-track{background:transparent}',
      '#nexify-bot-messages::-webkit-scrollbar-thumb{background:rgba(255,255,255,.15);border-radius:99px}',
      '.nb-msg{display:flex;gap:8px;align-items:flex-start}',
      '.nb-msg.user{flex-direction:row-reverse}',
      '.nb-avatar{width:28px;height:28px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:13px;margin-top:2px}',
      '.nb-avatar.bot{background:' + COLORS.primary + '}',
      '.nb-avatar.user{background:#374151}',
      '.nb-bubble{max-width:78%;padding:10px 14px;border-radius:14px;font-size:13px;line-height:1.5;word-break:break-word}',
      '.nb-bubble.bot{background:' + COLORS.bgCard + ';border:1px solid ' + COLORS.border + ';color:' + COLORS.text + ';border-bottom-left-radius:4px}',
      '.nb-bubble.user{background:' + COLORS.userBubble + ';color:#fff;border-bottom-right-radius:4px}',
      '.nb-links{margin-top:6px;display:flex;flex-wrap:wrap;gap:4px}',
      '.nb-link-btn{display:inline-flex;align-items:center;background:rgba(234,88,12,.15);border:1px solid rgba(234,88,12,.3);color:#fb923c;border-radius:5px;font-size:11px;padding:3px 8px;text-decoration:none;cursor:pointer}',
      '.nb-link-btn:hover{background:rgba(234,88,12,.25)}',
      '.nb-suggestions{display:flex;flex-wrap:wrap;gap:4px;margin-top:4px}',
      '.nb-suggest-btn{background:#1f2937;border:1px solid rgba(255,255,255,.1);color:' + COLORS.muted + ';border-radius:8px;font-size:11px;padding:5px 10px;cursor:pointer;transition:all .15s;text-align:left}',
      '.nb-suggest-btn:hover{border-color:' + COLORS.primary + ';color:' + COLORS.primary + '}',
      '#nexify-bot-input-area{padding:10px 12px;border-top:1px solid ' + COLORS.border + ';display:flex;gap:6px;flex-shrink:0}',
      '#nexify-bot-input{flex:1;background:#1f2937;border:1px solid rgba(255,255,255,.12);color:' + COLORS.text + ';border-radius:10px;padding:9px 14px;font-size:13px;outline:none;resize:none}',
      '#nexify-bot-input:focus{border-color:' + COLORS.primary + '}',
      '#nexify-bot-send{background:' + COLORS.primary + ';border:none;color:#fff;border-radius:10px;width:38px;min-width:38px;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;transition:background .15s}',
      '#nexify-bot-send:hover{background:' + COLORS.primaryDark + '}',
      '.nb-typing{display:flex;gap:4px;align-items:center;padding:6px 0}',
      '.nb-dot{width:7px;height:7px;border-radius:50%;background:' + COLORS.muted + ';animation:nb-bounce 1s infinite}',
      '.nb-dot:nth-child(2){animation-delay:.2s}.nb-dot:nth-child(3){animation-delay:.4s}',
      '@keyframes nb-bounce{0%,60%,100%{transform:translateY(0)}30%{transform:translateY(-5px)}}',
      '@media(max-width:400px){#nexify-bot-panel{width:calc(100vw - 32px);right:16px}#nexify-bot-btn{right:16px}}'
    ].join('');
    document.head.appendChild(style);

    // Build HTML
    var panel = document.createElement('div');
    panel.id = 'nexify-bot-panel';
    panel.setAttribute('role', 'dialog');
    panel.setAttribute('aria-label', 'NexiFy Chatbot');
    panel.innerHTML = [
      '<div id="nexify-bot-header">',
        '<div class="nb-avatar bot" style="width:32px;height:32px;flex-shrink:0">🤖</div>',
        '<div class="nb-title">NexiFy Βοηθός</div>',
        '<button class="nb-close" id="nexify-bot-close" aria-label="Κλείσιμο">✕</button>',
      '</div>',
      '<div id="nexify-bot-messages"></div>',
      '<div id="nexify-bot-input-area">',
        '<input type="text" id="nexify-bot-input" placeholder="Γράψε ερώτηση..." autocomplete="off" maxlength="500">',
        '<button id="nexify-bot-send" aria-label="Αποστολή">➤</button>',
      '</div>'
    ].join('');

    var btn = document.createElement('button');
    btn.id = 'nexify-bot-btn';
    btn.setAttribute('aria-label', 'Άνοιξε chatbot NexiFy');
    btn.textContent = '💬';

    document.body.appendChild(panel);
    document.body.appendChild(btn);

    // Elements
    var messagesEl = document.getElementById('nexify-bot-messages');
    var inputEl    = document.getElementById('nexify-bot-input');
    var sendEl     = document.getElementById('nexify-bot-send');
    var closeEl    = document.getElementById('nexify-bot-close');

    var isOpen = false;

    function open() {
      isOpen = true;
      panel.classList.add('open');
      btn.textContent = '✕';
      btn.setAttribute('aria-label', 'Κλείσιμο chatbot');
      setTimeout(function() { inputEl.focus(); }, 300);
    }

    function close() {
      isOpen = false;
      panel.classList.remove('open');
      btn.textContent = '💬';
      btn.setAttribute('aria-label', 'Άνοιξε chatbot NexiFy');
    }

    btn.addEventListener('click', function() { isOpen ? close() : open(); });
    closeEl.addEventListener('click', close);

    function scrollToBottom() {
      messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function escape(s) {
      var d = document.createElement('div');
      d.textContent = s || '';
      return d.innerHTML;
    }

    function nl2br(s) {
      return escape(s).replace(/\n/g, '<br>');
    }

    function addMessage(role, content, links, suggestions) {
      var wrap = document.createElement('div');
      wrap.className = 'nb-msg ' + role;

      var avatarChar = role === 'bot' ? '🤖' : '👤';
      var bubble = document.createElement('div');

      var linksHtml = '';
      if (links && links.length) {
        linksHtml = '<div class="nb-links">' +
          links.map(function(l) {
            return '<a class="nb-link-btn" href="' + escape(SITE_ROOT + l.url) + '" target="_blank">→ ' + escape(l.label) + '</a>';
          }).join('') + '</div>';
      }

      bubble.className = 'nb-bubble ' + role;
      bubble.innerHTML = nl2br(content) + linksHtml;
      wrap.innerHTML = '<div class="nb-avatar ' + role + '">' + avatarChar + '</div>';
      wrap.appendChild(bubble);

      messagesEl.appendChild(wrap);

      // Suggestions
      if (suggestions && suggestions.length) {
        var suggestWrap = document.createElement('div');
        suggestWrap.className = 'nb-msg ' + role;
        var suggestInner = document.createElement('div');
        suggestInner.style.marginLeft = role === 'bot' ? '36px' : '0';
        suggestInner.style.marginRight = role === 'user' ? '36px' : '0';
        suggestInner.className = 'nb-suggestions';
        suggestions.forEach(function(s) {
          var b = document.createElement('button');
          b.className = 'nb-suggest-btn';
          b.textContent = s;
          b.addEventListener('click', function() { handleSend(s); });
          suggestInner.appendChild(b);
        });
        suggestWrap.appendChild(suggestInner);
        messagesEl.appendChild(suggestWrap);
      }

      scrollToBottom();
    }

    function addTyping() {
      var el = document.createElement('div');
      el.id = 'nb-typing';
      el.className = 'nb-msg bot';
      el.innerHTML = '<div class="nb-avatar bot">🤖</div><div class="nb-bubble bot"><div class="nb-typing"><div class="nb-dot"></div><div class="nb-dot"></div><div class="nb-dot"></div></div></div>';
      messagesEl.appendChild(el);
      scrollToBottom();
    }

    function removeTyping() {
      var el = document.getElementById('nb-typing');
      if (el) el.remove();
    }

    async function handleSend(text) {
      text = (text || inputEl.value).trim();
      if (!text) return;
      inputEl.value = '';

      addMessage('user', text);
      addTyping();

      try {
        var res = await fetch(API_URL + '?action=chat', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ q: text })
        });
        var data = await res.json();
        removeTyping();

        if (data.success && data.response) {
          var r = data.response;
          var related = (r.related || []).filter(function(x) { return x.question; }).slice(0, 3).map(function(x) { return x.question; });
          addMessage('bot', r.message || 'Δεν κατάλαβα. Δοκίμασε ξανά.', r.links || [], related);
        } else {
          addMessage('bot', 'Κάτι πήγε στραβά. Επικοινώνησε στο info@nexify.gr ή 210 999 6300.', []);
        }
      } catch (e) {
        removeTyping();
        addMessage('bot', 'Σφάλμα σύνδεσης. Παρακαλώ επικοινώνησε στο info@nexify.gr.', []);
      }
    }

    sendEl.addEventListener('click', function() { handleSend(inputEl.value); });
    inputEl.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        handleSend(inputEl.value);
      }
    });

    // Show initial greeting
    addMessage('bot', GREETING, [], SUGGESTIONS);
  }

  // Initialize when DOM is ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', createWidget);
  } else {
    createWidget();
  }

  // Public API
  window.NexifyBot = {
    open: function() { var btn = document.getElementById('nexify-bot-btn'); if (btn) btn.click(); },
    close: function() { var close = document.getElementById('nexify-bot-close'); if (close) close.click(); }
  };

})();
