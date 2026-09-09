/**
 * NexiFy Chatbot Knowledge Base API
 * Cloudflare Pages Function — replaces chatbot/api.php
 *
 * Handles the same endpoints as the original PHP:
 *   GET  ?action=search&q=...    — keyword search
 *   GET  ?action=category&cat=   — entries by category
 *   GET  ?action=all             — full knowledge base
 *   GET  ?action=faq             — all FAQ entries
 *   GET  ?action=service&name=   — specific service info
 *   GET  ?action=contact         — contact information
 *   POST ?action=chat            — chatbot query (best answer)
 */

const CORS_HEADERS = {
  'Access-Control-Allow-Origin': '*',
  'Access-Control-Allow-Methods': 'GET, POST, OPTIONS',
  'Access-Control-Allow-Headers': 'Content-Type',
  'Content-Type': 'application/json; charset=utf-8',
};

export async function onRequest(context) {
  const { request, env } = context;

  // ── Preflight ──────────────────────────────────────────────
  if (request.method === 'OPTIONS') {
    return new Response(null, { status: 200, headers: CORS_HEADERS });
  }

  // ── Load knowledge base from static asset ─────────────────
  let kb;
  try {
    const url     = new URL(request.url);
    const kbUrl   = `${url.origin}/chatbot/knowledge-base.json`;
    const kbRes   = await env.ASSETS.fetch(new Request(kbUrl));
    kb            = await kbRes.json();
  } catch (err) {
    return json({ success: false, error: 'Knowledge base not found' }, 500);
  }

  // ── Route actions ──────────────────────────────────────────
  const url    = new URL(request.url);
  const action = url.searchParams.get('action') || 'search';

  switch (action) {

    case 'all':
      return json({ success: true, data: kb });

    case 'faq': {
      const category = url.searchParams.get('category');
      let faqs = kb.faq || [];
      if (category) faqs = faqs.filter(f => f.category === category);
      return json({ success: true, count: faqs.length, data: faqs });
    }

    case 'category': {
      const cat = (url.searchParams.get('cat') || '').toLowerCase().trim();
      if (!cat) return json({ success: false, error: 'Missing category parameter' });
      const results = (kb.faq || []).filter(f => f.category === cat);
      return json({ success: true, category: cat, count: results.length, data: results });
    }

    case 'service': {
      const name     = (url.searchParams.get('name') || '').toLowerCase().trim();
      const services = kb.services || {};
      if (!name) return json({ success: false, error: 'Missing service name' });

      if (services[name]) return json({ success: true, data: services[name] });

      // Partial match
      const entry = Object.entries(services).find(
        ([k]) => k.includes(name) || name.includes(k)
      );
      if (entry) return json({ success: true, service_key: entry[0], data: entry[1] });

      return json({ success: false, error: 'Service not found', available: Object.keys(services) });
    }

    case 'contact':
      return json({ success: true, data: kb.company?.contact || {} });

    case 'company':
      return json({ success: true, data: kb.company || {} });

    case 'search':
    case 'chat': {
      let query = '';

      if (request.method === 'POST') {
        const body = await request.json().catch(() => ({}));
        query = (body.q || body.query || body.message || '').toLowerCase().trim();
      } else {
        query = (url.searchParams.get('q') || url.searchParams.get('query') || '').toLowerCase().trim();
      }

      if (!query) return json({ success: false, error: 'Missing query parameter (q or query)' });

      const results = searchKnowledgeBase(kb, query);

      if (action === 'chat') {
        const response = buildChatResponse(kb, query, results);
        return json({ success: true, query, response, sources: results });
      }
      return json({ success: true, query, count: results.length, results });
    }

    default:
      return json({
        success: false,
        error: 'Unknown action',
        available_actions: ['all', 'faq', 'category', 'service', 'contact', 'company', 'search', 'chat'],
      });
  }
}

// ── Helpers ────────────────────────────────────────────────────

function json(data, status = 200) {
  return new Response(JSON.stringify(data), { status, headers: CORS_HEADERS });
}

/**
 * Search the knowledge base for relevant entries
 */
function searchKnowledgeBase(kb, query) {
  const results    = [];
  const queryWords = query.split(' ').filter(w => w.length > 2);

  // Search FAQ
  for (const faq of (kb.faq || [])) {
    const text  = `${faq.question} ${faq.answer} ${(faq.keywords || []).join(' ')}`;
    const score = scoreEntry(text, queryWords, query);
    if (score > 0) {
      results.push({
        type    : 'faq',
        id      : faq.id,
        category: faq.category,
        question: faq.question,
        answer  : faq.answer,
        score,
      });
    }
  }

  // Search services
  for (const [serviceKey, service] of Object.entries(kb.services || {})) {
    let searchText = `${service.name} ${service.description}`;
    if (service.features) searchText += ` ${service.features.join(' ')}`;
    if (service.benefits) searchText += ` ${service.benefits.join(' ')}`;
    if (service.solutions) {
      for (const sol of service.solutions) {
        searchText += ` ${sol.name} ${sol.description}`;
      }
    }

    const score = scoreEntry(searchText, queryWords, query);
    if (score > 0) {
      results.push({
        type       : 'service',
        service_key: serviceKey,
        name       : service.name,
        description: service.description,
        page_url   : service.page_url ?? null,
        score,
      });
    }
  }

  // Search company info
  const company      = kb.company || {};
  const companyText  = `${company.name} ${company.description} ${(company.key_messages || []).join(' ')}`;
  const companyScore = scoreEntry(companyText, queryWords, query);
  if (companyScore > 0) {
    results.push({
      type : 'company',
      data : {
        name       : company.name,
        description: company.description,
        contact    : company.contact,
        address    : company.address,
      },
      score: companyScore,
    });
  }

  // Sort by score and return top 5
  results.sort((a, b) => b.score - a.score);
  return results.slice(0, 5);
}

/**
 * Score relevance of text to query
 */
function scoreEntry(text, queryWords, fullQuery) {
  text = text.toLowerCase();
  let score = 0;

  // Exact phrase match (highest score)
  if (text.includes(fullQuery)) score += 20;

  // Individual word matches
  for (const word of queryWords) {
    if (text.includes(word)) score += 3;
  }

  // Greek/English transliteration helpers
  const transliterations = {
    energy    : 'ενέργεια ρεύμα αέριο',
    office    : 'γραφείο έδρα virtual',
    'call center': 'τηλεφωνικό κέντρο',
    price     : 'τιμή κόστος τιμολόγιο',
    cheap     : 'φθηνό εξοικονόμηση',
    crm       : 'crm erp τεχνολογία',
    partner   : 'συνεργάτης συνεργασία',
    career    : 'καριέρα θέση εργασία',
    contact   : 'επικοινωνία τηλέφωνο email',
  };

  for (const [en, gr] of Object.entries(transliterations)) {
    if (fullQuery.includes(en) && (text.includes(gr) || text.includes(en))) {
      score += 5;
    }
  }

  return score;
}

/**
 * Build a chatbot-friendly response
 */
function buildChatResponse(kb, query, results) {
  if (results.length === 0) {
    const fallback = kb.chatbot_responses?.fallback;
    return {
      message    : fallback?.el ?? 'Δεν βρήκα σχετικές πληροφορίες. Στείλε μας email στο info@nexify.gr.',
      type       : 'fallback',
      suggestions: [
        'Πληροφορίες για ενέργεια',
        'Φορολογική έδρα τιμές',
        'Επικοινωνία NexiFy',
        'Υπηρεσίες τεχνολογίας',
      ],
    };
  }

  const top   = results[0];
  let message = '';
  const links = [];

  const categoryUrls = {
    energy        : 'energy.html',
    virtual_office: 'virtual-office.html',
    technology    : 'ecosystem.html#tech',
    partners      : 'partners.html',
    general       : 'contact.html',
  };

  if (top.type === 'faq') {
    message = top.answer;
    if (categoryUrls[top.category]) {
      links.push({ label: 'Μάθε περισσότερα', url: categoryUrls[top.category] });
    }
  } else if (top.type === 'service') {
    message = `${top.name}: ${top.description}`;
    if (top.page_url) {
      links.push({ label: 'Δες περισσότερα', url: top.page_url.replace('.php', '.html') });
    }
  } else if (top.type === 'company') {
    message = kb.company?.description ?? '';
    links.push({ label: 'Δες το Ecosystem', url: 'ecosystem.html' });
    links.push({ label: 'Επικοινωνία', url: 'contact.html' });
  }

  if (results.length >= 2) {
    links.push({ label: 'Μίλα με σύμβουλο', url: 'contact.html' });
  }

  return {
    message,
    type      : top.type,
    confidence: Math.min(100, top.score * 5),
    links,
    related   : results.slice(1, 4).map(r => ({
      question: r.question ?? r.name ?? '',
      type    : r.type,
    })),
  };
}
