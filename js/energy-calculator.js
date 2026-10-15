// NEXIFY - Energy Calculator (native rebuild)
// Demo dataset of Greek energy providers with simplified plan structure.
// Real-time pricing should sync from Firecrawl/RAE/provider websites.
(function(){
  'use strict';

  // Partner providers — εμφανίζονται με σήμα "Συνεργάτης NexiFy" στα αποτελέσματα
  var PARTNER_PROVIDERS = ['ZENITH', 'NRG', 'ΗΡΩΝ', 'ΔΕΗ'];
  function isPartner(name){ return PARTNER_PROVIDERS.indexOf(name) >= 0; }

  // ---------- DATA: Greek energy providers (sample / demo prices Q2 2026) ----------
  // Each plan: provider, plan name, type (BLUE=Σταθερό, YELLOW=Κυμαινόμενο, GREEN=Ειδικό),
  //   priceDay (€/kWh), priceNight (€/kWh, optional), monthly fee (€), loyaltyDiscount (%)
  //   notes, customer (DOMESTIC | PROFESSIONAL | BOTH)
  var PROVIDERS_ELECTRICITY = [
    // ΔΕΗ
    { provider:'ΔΕΗ', plan:'myHomeEnter', type:'BLUE', priceDay:0.149, priceNight:null, fee:5.5, loyalty:0, customer:'DOMESTIC', notes:'Σταθερή τιμή 12 μήνες' },
    { provider:'ΔΕΗ', plan:'myHome Online', type:'BLUE', priceDay:0.139, priceNight:null, fee:4.5, loyalty:5, customer:'DOMESTIC', notes:'Έκπτωση συνέπειας 5%' },
    { provider:'ΔΕΗ', plan:'myHome Night', type:'BLUE', priceDay:0.155, priceNight:0.119, fee:6.0, loyalty:0, customer:'DOMESTIC', notes:'Νυχτερινό τιμολόγιο' },
    { provider:'ΔΕΗ', plan:'myBusiness', type:'BLUE', priceDay:0.169, priceNight:null, fee:7.5, loyalty:5, customer:'PROFESSIONAL', notes:'Επαγγελματικό σταθερό' },
    // ΗΡΩΝ
    { provider:'ΗΡΩΝ', plan:'Generous Home Special', type:'BLUE', priceDay:0.124, priceNight:null, fee:4.9, loyalty:18, customer:'DOMESTIC', notes:'Έκπτωση συνέπειας 18%' },
    { provider:'ΗΡΩΝ', plan:'Generous Home Variable', type:'YELLOW', priceDay:0.118, priceNight:null, fee:4.9, loyalty:15, customer:'DOMESTIC', notes:'Κυμαινόμενο, εκκαθάριση μηνιαία' },
    { provider:'ΗΡΩΝ', plan:'Generous Business', type:'BLUE', priceDay:0.144, priceNight:null, fee:6.5, loyalty:15, customer:'PROFESSIONAL', notes:'Επαγγελματικό σταθερό' },
    // NRG
    { provider:'NRG', plan:'NRG on time 4U', type:'BLUE', priceDay:0.135, priceNight:null, fee:5.0, loyalty:20, customer:'DOMESTIC', notes:'Έκπτωση συνέπειας 20%' },
    { provider:'NRG', plan:'NRG simple value', type:'YELLOW', priceDay:0.115, priceNight:null, fee:5.0, loyalty:10, customer:'DOMESTIC', notes:'Κυμαινόμενο' },
    { provider:'NRG', plan:'NRG business 4U', type:'BLUE', priceDay:0.155, priceNight:null, fee:6.5, loyalty:15, customer:'PROFESSIONAL', notes:'Επαγγελματικό' },
    // PROTERGIA
    { provider:'PROTERGIA', plan:'Protergia Value Special', type:'BLUE', priceDay:0.129, priceNight:null, fee:4.9, loyalty:15, customer:'DOMESTIC', notes:'Έκπτωση συνέπειας 15%' },
    { provider:'PROTERGIA', plan:'Protergia Variable', type:'YELLOW', priceDay:0.110, priceNight:null, fee:4.9, loyalty:10, customer:'DOMESTIC', notes:'Κυμαινόμενο' },
    { provider:'PROTERGIA', plan:'Green EV Home', type:'GREEN', priceDay:0.142, priceNight:0.099, fee:5.5, loyalty:10, customer:'DOMESTIC', notes:'Νυχτερινή φόρτιση EV' },
    { provider:'PROTERGIA', plan:'Protergia Business', type:'BLUE', priceDay:0.149, priceNight:null, fee:6.5, loyalty:15, customer:'PROFESSIONAL', notes:'Επαγγελματικό' },
    // ZENITH
    { provider:'ZENITH', plan:'Power Home Special', type:'BLUE', priceDay:0.122, priceNight:null, fee:4.9, loyalty:22, customer:'DOMESTIC', notes:'Έκπτωση συνέπειας 22%' },
    { provider:'ZENITH', plan:'Power Home Floating', type:'YELLOW', priceDay:0.108, priceNight:null, fee:4.9, loyalty:12, customer:'DOMESTIC', notes:'Κυμαινόμενο' },
    { provider:'ZENITH', plan:'Power Business', type:'BLUE', priceDay:0.148, priceNight:null, fee:6.5, loyalty:15, customer:'PROFESSIONAL', notes:'Επαγγελματικό' },
    // VOLTON
    { provider:'VOLTON', plan:'Volton Home Stable', type:'BLUE', priceDay:0.133, priceNight:null, fee:5.0, loyalty:15, customer:'DOMESTIC', notes:'Σταθερό 12μηνο' },
    { provider:'VOLTON', plan:'Volton Smart Home', type:'YELLOW', priceDay:0.114, priceNight:null, fee:5.0, loyalty:10, customer:'DOMESTIC', notes:'Κυμαινόμενο smart' },
    { provider:'VOLTON', plan:'Volton Business', type:'BLUE', priceDay:0.149, priceNight:null, fee:6.5, loyalty:12, customer:'PROFESSIONAL', notes:'Επαγγελματικό' },
    // ENERWAVE
    { provider:'ENERWAVE', plan:'Wave Home', type:'BLUE', priceDay:0.139, priceNight:null, fee:4.9, loyalty:14, customer:'DOMESTIC', notes:'Σταθερό' },
    { provider:'ENERWAVE', plan:'Wave Variable', type:'YELLOW', priceDay:0.116, priceNight:null, fee:4.9, loyalty:10, customer:'DOMESTIC', notes:'Κυμαινόμενο' },
    { provider:'ENERWAVE', plan:'Wave Business', type:'BLUE', priceDay:0.152, priceNight:null, fee:6.5, loyalty:12, customer:'PROFESSIONAL', notes:'Επαγγελματικό' }
  ];

  var PROVIDERS_GAS = [
    { provider:'ΔΕΗ', plan:'myGas Home', type:'BLUE', priceDay:0.084, fee:4.5, loyalty:8, customer:'DOMESTIC' },
    { provider:'ΗΡΩΝ', plan:'Heron Gas Home', type:'BLUE', priceDay:0.078, fee:4.5, loyalty:15, customer:'DOMESTIC' },
    { provider:'PROTERGIA', plan:'Protergia Gas Special', type:'BLUE', priceDay:0.075, fee:4.5, loyalty:18, customer:'DOMESTIC' },
    { provider:'ZENITH', plan:'Zenith Gas Power', type:'BLUE', priceDay:0.072, fee:4.5, loyalty:20, customer:'DOMESTIC' },
    { provider:'NRG', plan:'NRG Gas 4U', type:'BLUE', priceDay:0.082, fee:4.9, loyalty:12, customer:'DOMESTIC' },
    { provider:'ΗΡΩΝ', plan:'Heron Gas Business', type:'BLUE', priceDay:0.092, fee:6.5, loyalty:12, customer:'PROFESSIONAL' },
    { provider:'PROTERGIA', plan:'Protergia Gas Business', type:'BLUE', priceDay:0.088, fee:6.5, loyalty:14, customer:'PROFESSIONAL' }
  ];

  // Distribution & taxes constant per kWh (regulated charges, indicative)
  var REG_CHARGES_KWH = 0.027; // ΕΤΜΕΑΡ + Δίκτυο + Λοιπές χρεώσεις (avg)
  var REG_CHARGES_GAS = 0.018;
  var VAT = 0.06; // Reduced VAT for energy in many cases — adjust per actuals

  // ---------- STATE ----------
  var state = {
    fuel: 'electricity',  // electricity | gas
    customer: 'DOMESTIC',
    categories: [],       // student, pet, ev
    type: '',             // BLUE | YELLOW | GREEN | ''
    kwhDay: 0,
    kwhNight: 0,
    monthsNoLoyalty: 0,
    kva: ''
  };

  // ---------- UI ----------
  function $(id){ return document.getElementById(id); }
  function el(tag, attrs, html){
    var e = document.createElement(tag);
    if (attrs) for (var k in attrs) e.setAttribute(k, attrs[k]);
    if (html != null) e.innerHTML = html;
    return e;
  }

  function getActiveDataset(){
    return state.fuel === 'gas' ? PROVIDERS_GAS : PROVIDERS_ELECTRICITY;
  }

  function calculatePlan(plan){
    var monthlyKwh = state.kwhDay + state.kwhNight;
    var annualKwh = monthlyKwh * 12;
    var kwhDayAnnual = state.kwhDay * 12;
    var kwhNightAnnual = state.kwhNight * 12;

    var energyCostNoDiscount;
    if (plan.priceNight && state.kwhNight > 0) {
      energyCostNoDiscount = (kwhDayAnnual * plan.priceDay) + (kwhNightAnnual * plan.priceNight);
    } else {
      energyCostNoDiscount = annualKwh * plan.priceDay;
    }

    // Apply loyalty discount on energy only, on months WITH loyalty
    var monthsWith = Math.max(0, 12 - state.monthsNoLoyalty);
    var monthsWithout = Math.max(0, state.monthsNoLoyalty);
    var loyaltyFactor = (plan.loyalty || 0) / 100;
    var energyMonthlyAvg = energyCostNoDiscount / 12;
    var energyAfterLoyalty =
        (monthsWith * energyMonthlyAvg * (1 - loyaltyFactor)) +
        (monthsWithout * energyMonthlyAvg);

    var feeAnnual = (plan.fee || 0) * 12;
    var regAnnual = annualKwh * (state.fuel === 'gas' ? REG_CHARGES_GAS : REG_CHARGES_KWH);

    var subtotal = energyAfterLoyalty + feeAnnual + regAnnual;
    var vatAmount = subtotal * VAT;
    var total = subtotal + vatAmount;

    var avgPerKwh = annualKwh > 0 ? (total / annualKwh) : 0;

    return {
      plan: plan,
      annualKwh: annualKwh,
      energyCost: energyAfterLoyalty,
      fixedFee: feeAnnual,
      regCharges: regAnnual,
      vat: vatAmount,
      total: total,
      perKwh: avgPerKwh
    };
  }

  function readForm(){
    state.fuel = document.querySelector('input[name="fuel"]:checked').value;
    state.customer = $('customer').value;
    state.type = $('type').value;
    state.kwhDay = parseFloat($('kwhDay').value) || 0;
    state.kwhNight = parseFloat($('kwhNight').value) || 0;
    state.monthsNoLoyalty = parseInt($('monthsNoLoyalty').value, 10) || 0;
    state.kva = $('kva').value;
    state.categories = [];
    document.querySelectorAll('input[name="cat"]:checked').forEach(function(i){
      state.categories.push(i.value);
    });
  }

  function filterPlans(){
    var data = getActiveDataset();
    return data.filter(function(p){
      if (state.customer && p.customer !== state.customer && p.customer !== 'BOTH') return false;
      if (state.type && p.type !== state.type) return false;
      // EV → prefer plans with night tariff
      if (state.categories.indexOf('ev') >= 0 && state.fuel === 'electricity' && !p.priceNight) return false;
      return true;
    });
  }

  function fmt(n){
    return new Intl.NumberFormat('el-GR', { style:'currency', currency:'EUR', maximumFractionDigits: 2 }).format(n);
  }
  function fmtKwh(n){
    return new Intl.NumberFormat('el-GR', { maximumFractionDigits: 4 }).format(n) + ' €/kWh';
  }

  function renderResults(results){
    var box = $('results');
    if (!results.length){
      box.innerHTML = '<div class="card"><h3>Δεν βρέθηκαν προγράμματα</h3><p>Δοκίμασε να αλλάξεις τα φίλτρα.</p></div>';
      return;
    }
    results.sort(function(a,b){ return a.total - b.total; });
    var top3 = results.slice(0, 3);
    var cheapest = top3[0];

    var html = '';
    html += '<div class="results-summary">';
    html += '<h3>Top '+top3.length+' φθηνότερα προγράμματα'+(results.length>3 ? ' (από '+results.length+' συνολικά)' : '')+'</h3>';
    html += '<p class="lead">Ετήσιο κόστος βάσει '+Math.round(cheapest.annualKwh)+' kWh κατανάλωσης. Όλες οι τιμές με ΦΠΑ.</p>';
    html += '</div>';

    html += '<div class="grid grid-3">';
    top3.forEach(function(r, idx){
      var save = idx > 0 ? (r.total - cheapest.total) : 0;
      var typeLabel = r.plan.type === 'BLUE' ? '🔵 Σταθερό' : r.plan.type === 'YELLOW' ? '🟡 Κυμαινόμενο' : '🟢 Ειδικό';
      var partnerBadge = isPartner(r.plan.provider) ? '<span class="badge badge-green" style="margin-left:6px">★ Συνεργάτης NexiFy</span>' : '';
      html += '<div class="price-card '+(idx===0?'featured':'')+'">';
      html += '<span class="badge badge-blue">'+r.plan.provider+'</span>' + partnerBadge;
      html += '<h3 style="margin-top:14px">'+r.plan.plan+'</h3>';
      html += '<div class="price">'+fmt(r.total)+'<span> /έτος</span></div>';
      html += '<div class="term">'+typeLabel+' · '+(r.plan.loyalty? r.plan.loyalty+'% έκπτωση συνέπειας' : 'Χωρίς δέσμευση')+'</div>';
      html += '<ul class="list-check" style="font-size:.92rem;margin:18px 0">';
      html += '<li>Ενέργεια: '+fmt(r.energyCost)+'</li>';
      html += '<li>Πάγια: '+fmt(r.fixedFee)+'</li>';
      html += '<li>Χρεώσεις δικτύου: '+fmt(r.regCharges)+'</li>';
      html += '<li>Μέση τιμή: '+fmtKwh(r.perKwh)+'</li>';
      if (idx > 0) html += '<li style="color:var(--c-orange-dark)"><b>+'+fmt(save)+' / έτος vs φθηνότερο</b></li>';
      html += '</ul>';
      if (r.plan.notes) html += '<p style="font-size:.86rem;color:var(--c-muted)">'+r.plan.notes+'</p>';
      html += '<a href="contact.html?provider='+encodeURIComponent(r.plan.provider)+'&plan='+encodeURIComponent(r.plan.plan)+'" class="btn btn-primary btn-block">Συνέχεια →</a>';
      html += '</div>';
    });
    html += '</div>';

    if (results.length > 3) {
      html += '<div class="card mt-4" style="background:var(--c-blue-50);border-color:var(--c-blue-light)">';
      html += '<h3>📞 Θέλεις και τα υπόλοιπα '+(results.length-3)+';</h3>';
      html += '<p>Άσε μας τα στοιχεία σου και η ομάδα μας θα σε καλέσει με <b>πλήρη σύγκριση</b> και προσωπική πρόταση.</p>';
      html += '<a href="contact.html?topic=energy" class="btn btn-primary">Θέλω να με καλέσετε</a>';
      html += '</div>';
    }

    box.innerHTML = html;
    box.scrollIntoView({ behavior:'smooth', block:'start' });
  }

  function init(){
    var form = $('energyForm');
    if (!form) return;

    // Fuel toggle
    document.querySelectorAll('input[name="fuel"]').forEach(function(r){
      r.addEventListener('change', function(){
        var isGas = this.value === 'gas';
        $('kvaWrap').style.display = isGas ? 'none' : '';
        $('kwhNightWrap').style.display = isGas ? 'none' : '';
        $('typeWrap').style.display = isGas ? 'none' : '';
        $('catsWrap').style.display = isGas ? 'none' : '';
      });
    });

    // Customer toggle: hide power for domestic
    $('customer').addEventListener('change', function(){
      var pro = this.value === 'PROFESSIONAL';
      $('kvaWrap').style.display = pro ? '' : 'none';
    });

    form.addEventListener('submit', function(e){
      e.preventDefault();
      readForm();
      var plans = filterPlans();
      var results = plans.map(calculatePlan);
      renderResults(results);
    });

    $('resetBtn').addEventListener('click', function(){
      form.reset();
      $('results').innerHTML = '';
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
