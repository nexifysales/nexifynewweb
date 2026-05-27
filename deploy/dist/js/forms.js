// ====== NexiFy — Form submission (FormSubmit backend) ======
//
// FormSubmit (free, unlimited, no signup): https://formsubmit.co
// First submission triggers a confirmation email to TARGET_EMAIL.
// After clicking confirm, all future submissions auto-forward.
//
// To switch backend later (Web3Forms / Basin / EmailJS / custom):
// just change BACKEND below.

(function(){
  'use strict';

  // ⚙️ CONFIG
  var TARGET_EMAIL = 'sales@nexify.gr';      // Όλες οι φόρμες πάνε εδώ
  var BACKEND      = 'formsubmit';            // 'formsubmit' | 'web3forms' | 'mailto'
  var WEB3FORMS_KEY = '';                     // αν διαλέξεις web3forms

  function endpoint(){
    if (BACKEND === 'formsubmit') return 'https://formsubmit.co/ajax/' + encodeURIComponent(TARGET_EMAIL);
    if (BACKEND === 'web3forms')  return 'https://api.web3forms.com/submit';
    return null;
  }

  function buildPayload(form, opts){
    var data = {};
    new FormData(form).forEach(function(v, k){
      if (k === '_gotcha') return; // skip honeypot field
      data[k] = v;
    });
    // Common metadata
    data._subject = opts.subject || 'Νέο μήνυμα από nexify.gr';
    data._template = 'table';                      // FormSubmit pretty table
    data._captcha = 'false';                       // disable Formsubmit's recaptcha (we have honeypot)
    data._formType = opts.formType || 'unknown';
    data._source = location.pathname.split('/').pop() || 'index.html';
    data._timestamp = new Date().toISOString();
    if (opts.replyTo) {
      var replyEmail = (form.querySelector('[name="'+opts.replyTo+'"]') || {}).value;
      if (replyEmail) data._replyto = replyEmail;
    }
    if (BACKEND === 'web3forms') data.access_key = WEB3FORMS_KEY;
    return data;
  }

  function mailtoFallback(form, opts){
    var body = '';
    new FormData(form).forEach(function(v, k){
      if (k === '_gotcha') return;
      body += k + ': ' + v + '\n';
    });
    var subject = encodeURIComponent(opts.subject || 'Νέο μήνυμα');
    window.location.href = 'mailto:' + TARGET_EMAIL + '?subject=' + subject + '&body=' + encodeURIComponent(body);
  }

  async function submitForm(form, opts){
    // Honeypot check
    var hp = form.querySelector('[name=_gotcha]');
    if (hp && hp.value) {
      console.warn('[NexiFy] honeypot triggered — silently dropping');
      opts.onSuccess && opts.onSuccess();
      return;
    }

    if (BACKEND === 'mailto' || !endpoint()) {
      mailtoFallback(form, opts);
      opts.onSuccess && opts.onSuccess();
      return;
    }

    var payload = buildPayload(form, opts);

    try {
      var res = await fetch(endpoint(), {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(payload)
      });
      var data = await res.json().catch(function(){return{};});
      if (res.ok && (data.success !== false)) {
        opts.onSuccess && opts.onSuccess();
      } else {
        var msg = data.message || data.error || ('HTTP ' + res.status);
        opts.onError && opts.onError(msg);
      }
    } catch (err) {
      console.error('[NexiFy] Submit error:', err);
      // Fallback to mailto on network failure
      if (confirm('Πρόβλημα δικτύου. Θες να ανοίξει το email client σου ως εναλλακτική;')) {
        mailtoFallback(form, opts);
      }
      opts.onError && opts.onError('Πρόβλημα δικτύου. Δοκίμασε ξανά.');
    }
  }

  // Helper για success block
  function showSuccess(elBody, elSuccess){
    if (elBody) elBody.style.display = 'none';
    if (elSuccess) {
      elSuccess.classList.add('show');
      window.scrollTo({ top: elSuccess.offsetTop - 100, behavior: 'smooth' });
    }
  }

  // ====== 1. CONTACT FORM (contact.html) ======
  var cf = document.getElementById('contactForm');
  if (cf) {
    cf.addEventListener('submit', function(e){
      e.preventDefault();
      var btn = cf.querySelector('button[type=submit]');
      var orig = btn ? btn.textContent : '';
      if (btn) { btn.disabled = true; btn.textContent = 'Αποστολή...'; }

      submitForm(cf, {
        formType: 'contact',
        subject: 'Νέο μήνυμα από nexify.gr — ' + (cf.topic.value || 'Επικοινωνία'),
        replyTo: 'email',
        onSuccess: function(){
          cf.innerHTML =
            '<div style="text-align:center;padding:40px 20px">' +
            '<div style="width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#1d7a44,#2cb86b);color:#fff;display:grid;place-items:center;font-size:2rem;margin:0 auto 20px">✓</div>' +
            '<h3 style="margin-bottom:8px">Ευχαριστούμε!</h3>' +
            '<p>Λάβαμε το μήνυμά σου. Σε ενημερώνουμε σε 1 εργάσιμη ημέρα.</p>' +
            '</div>';
        },
        onError: function(msg){
          if (btn) { btn.disabled = false; btn.textContent = orig; }
          alert('⚠ ' + msg);
        }
      });
    });
  }

  // ====== 2. CALLBACK FORM (energy.html) ======
  var cbf = document.getElementById('callbackForm');
  if (cbf) {
    cbf.addEventListener('submit', function(e){
      e.preventDefault();
      var btn = cbf.querySelector('button[type=submit]');
      var orig = btn ? btn.textContent : '';
      if (btn) { btn.disabled = true; btn.textContent = 'Αποστολή...'; }

      submitForm(cbf, {
        formType: 'callback',
        subject: 'Θέλω να με καλέσετε — ' + (cbf.cb_topic.value || 'energy'),
        replyTo: 'cb_email',
        onSuccess: function(){
          showSuccess(document.getElementById('callbackBody'), document.getElementById('callbackSuccess'));
        },
        onError: function(msg){
          if (btn) { btn.disabled = false; btn.textContent = orig; }
          alert('⚠ ' + msg);
        }
      });
    });
  }

  // ====== 3. APPLICATION FORM (virtual-office-apply.html) ======
  var af = document.getElementById('appForm');
  if (af) {
    af.addEventListener('submit', function(e){
      e.preventDefault();
      var btn = af.querySelector('button[type=submit]');
      var orig = btn ? btn.textContent : '';
      if (btn) { btn.disabled = true; btn.textContent = 'Αποστολή...'; }

      var nm = (af.querySelector('[name=name]') || {}).value || 'Νέα αίτηση';

      submitForm(af, {
        formType: 'application-virtual-office',
        subject: '[Αίτηση Φορολογικής Έδρας] ' + nm,
        replyTo: 'contact_email',
        onSuccess: function(){
          showSuccess(document.getElementById('appFormBody'), document.getElementById('appSuccess'));
        },
        onError: function(msg){
          if (btn) { btn.disabled = false; btn.textContent = orig; }
          alert('⚠ ' + msg);
        }
      });
    });

    var pb = document.getElementById('appPrint');
    if (pb) pb.addEventListener('click', function(){ window.print(); });

    var planSelect = af.querySelector('[name="plan"]');
    var costInput = af.querySelector('[name="cost"]');
    var COSTS = { 'trimino':'180€','eksamino':'340€','etisio':'500€','dietes':'900€','pentaetes':'2.000€' };
    if (planSelect && costInput) {
      planSelect.addEventListener('change', function(){
        if (COSTS[this.value]) costInput.value = COSTS[this.value];
      });
    }
  }
})();
