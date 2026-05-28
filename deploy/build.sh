#!/bin/bash
# ============================================================
# NEXIFY.GR — Static Site Builder for Cloudflare Pages
# ============================================================
# Τρέξε από τον root directory του project:
#   cd /var/www/projects/nexifynewweb && bash deploy/build.sh
#
# Output: deploy/dist/  (αυτό ανεβαίνει στο Cloudflare Pages)
# ============================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
RENDERER="$SCRIPT_DIR/render-page.php"

# Colors (defined early so they can be used below)
GREEN='\033[0;32m'; BLUE='\033[0;34m'; YELLOW='\033[1;33m'; RED='\033[0;31m'; NC='\033[0m'
info()    { echo -e "${BLUE}[BUILD]${NC} $1"; }
success() { echo -e "${GREEN}[OK]${NC} $1"; }
warn()    { echo -e "${YELLOW}[WARN]${NC} $1"; }
error()   { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

# Use /tmp for build if deploy/dist is not writable (e.g. owned by root)
DIST_DEFAULT="$SCRIPT_DIR/dist"
if [ -d "$DIST_DEFAULT" ] && [ ! -w "$DIST_DEFAULT" ]; then
    DIST="/tmp/nexify-dist"
    warn "deploy/dist/ not writable — building to /tmp/nexify-dist/"
else
    DIST="$DIST_DEFAULT"
fi

# Export DIST so caller scripts can read it
export NEXIFY_DIST="$DIST"

echo ""
echo "╔══════════════════════════════════════════╗"
echo "║   NexiFy — Cloudflare Pages Builder      ║"
echo "╚══════════════════════════════════════════╝"
echo ""

command -v php  >/dev/null 2>&1 || error "php not found. Install PHP CLI."
command -v rsync >/dev/null 2>&1 || error "rsync not found."

# ─────────────────────────────────────────────────────────────
# 1. Clean and create output directory
# ─────────────────────────────────────────────────────────────
info "Cleaning dist/..."
rm -rf "$DIST"
mkdir -p "$DIST"
success "dist/ created"

# ─────────────────────────────────────────────────────────────
# 2. Render PHP pages → static HTML
# ─────────────────────────────────────────────────────────────
info "Rendering PHP pages to HTML..."

# Format: "source.php:outputname"
PAGES=(
    "index.php:index"
    "energy.php:energy"
    "ecosystem.php:ecosystem"
    "virtual-office.php:virtual-office"
    "virtual-office-apply.php:virtual-office-apply"
    "partners.php:partners"
    "careers.php:careers"
    "faq.php:faq"
    "contact.php:contact"
    "terms.php:terms"
    "privacy.php:privacy"
    "cookies.php:cookies"
    "gemi.php:gemi"
)

cd "$PROJECT_ROOT"
BUILT=0
SKIPPED=0

for entry in "${PAGES[@]}"; do
    page="${entry%%:*}"
    name="${entry##*:}"

    if [ -f "$PROJECT_ROOT/$page" ]; then
        if php "$RENDERER" "$page" "$name" > "$DIST/$name.html" 2>/tmp/nexify_render_err; then
            SIZE=$(wc -c < "$DIST/$name.html")
            success "Rendered: $page → $name.html (${SIZE}B)"
            BUILT=$((BUILT + 1))
        else
            warn "Failed: $page → $(cat /tmp/nexify_render_err 2>/dev/null | head -3)"
            SKIPPED=$((SKIPPED + 1))
        fi
    else
        warn "Skip: $page (not found)"
        SKIPPED=$((SKIPPED + 1))
    fi
done

echo ""
info "Pages built: $BUILT | Skipped: $SKIPPED"
echo ""

# ─────────────────────────────────────────────────────────────
# 2b. Render EN pages → static HTML (if /en/ pages exist)
# ─────────────────────────────────────────────────────────────
# EN pages live in /en/ and use the same slugs as GR pages.
# They are only rendered if the source .php file exists.
# ─────────────────────────────────────────────────────────────

EN_PAGES=(
    "en/index.php:index"
    "en/energy.php:energy"
    "en/ecosystem.php:ecosystem"
    "en/virtual-office.php:virtual-office"
    "en/virtual-office-apply.php:virtual-office-apply"
    "en/partners.php:partners"
    "en/careers.php:careers"
    "en/faq.php:faq"
    "en/contact.php:contact"
    "en/terms.php:terms"
    "en/privacy.php:privacy"
    "en/cookies.php:cookies"
    "en/gemi.php:gemi"
)

EN_BUILT=0
EN_PAGES_EXIST=0
for entry in "${EN_PAGES[@]}"; do
    page="${entry%%:*}"
    if [ -f "$PROJECT_ROOT/$page" ]; then
        EN_PAGES_EXIST=1
        break
    fi
done

if [ "$EN_PAGES_EXIST" -eq 1 ]; then
    info "Rendering EN pages to HTML..."
    mkdir -p "$DIST/en"

    for entry in "${EN_PAGES[@]}"; do
        page="${entry%%:*}"
        name="${entry##*:}"

        if [ -f "$PROJECT_ROOT/$page" ]; then
            if php "$RENDERER" "$page" "$name" > "$DIST/en/$name.html" 2>/tmp/nexify_render_err; then
                SIZE=$(wc -c < "$DIST/en/$name.html")
                success "Rendered EN: $page → en/$name.html (${SIZE}B)"
                EN_BUILT=$((EN_BUILT + 1))
            else
                warn "Failed EN: $page → $(cat /tmp/nexify_render_err 2>/dev/null | head -3)"
            fi
        fi
    done

    echo ""
    info "EN pages built: $EN_BUILT"
    echo ""
else
    info "No EN pages found in /en/ — skipping EN build (infrastructure ready)"
fi

# ─────────────────────────────────────────────────────────────
# 3. Copy static assets
# ─────────────────────────────────────────────────────────────
info "Copying static assets..."

# CSS
if [ -d "$PROJECT_ROOT/css" ]; then
    rsync -a "$PROJECT_ROOT/css/" "$DIST/css/"
    success "css/ copied"
fi

# JS folder
if [ -d "$PROJECT_ROOT/js" ]; then
    rsync -a "$PROJECT_ROOT/js/" "$DIST/js/"
    success "js/ copied"
fi

# Root-level CSS files (style.css lives in root, not css/)
for f in style.css; do
    [ -f "$PROJECT_ROOT/$f" ] && cp "$PROJECT_ROOT/$f" "$DIST/$f" && success "  $f"
done

# Root-level JS files
for f in forms.js main.js energy-calculator.js; do
    [ -f "$PROJECT_ROOT/$f" ] && cp "$PROJECT_ROOT/$f" "$DIST/$f" && success "  $f"
done

# Libraries
if [ -d "$PROJECT_ROOT/libs" ]; then
    rsync -a "$PROJECT_ROOT/libs/" "$DIST/libs/"
    success "libs/ copied"
fi

# Webfonts
if [ -d "$PROJECT_ROOT/webfonts" ]; then
    rsync -a "$PROJECT_ROOT/webfonts/" "$DIST/webfonts/"
    success "webfonts/ copied"
fi

# Fonts (local woff2 files + fonts.css)
if [ -d "$PROJECT_ROOT/fonts" ]; then
    rsync -a "$PROJECT_ROOT/fonts/" "$DIST/fonts/"
    success "fonts/ copied"
fi

# Images
if [ -d "$PROJECT_ROOT/images" ]; then
    rsync -a "$PROJECT_ROOT/images/" "$DIST/images/"
    success "images/ copied"
fi

# Logo files at root
for f in logo-nexify.png logo-nexify-transparent.png logo-nexify-white.png mr-revmas-image.png \
          partner-c2.png partner-codehero.png partner-mynext.png partner-mynext-market.png \
          partner-oxygen.png OXYGEN-Full-Original.png; do
    [ -f "$PROJECT_ROOT/$f" ] && cp "$PROJECT_ROOT/$f" "$DIST/$f"
done
success "Logos & partner images copied"

# PDFs
for f in OXYGEN-Certified-Reseller-CMYK.pdf Oxygen-Poster-A4.pdf; do
    [ -f "$PROJECT_ROOT/$f" ] && cp "$PROJECT_ROOT/$f" "$DIST/$f"
done

# Videos (handles filenames with spaces)
info "Copying videos..."
VCOUNT=0
while IFS= read -r -d '' f; do
    fname="$(basename "$f")"
    cp "$f" "$DIST/$fname"
    VCOUNT=$((VCOUNT + 1))
done < <(find "$PROJECT_ROOT" -maxdepth 1 -name "*.mp4" -print0)
success "Videos copied: $VCOUNT file(s)"

# ─────────────────────────────────────────────────────────────
# 4. Copy chatbot (excluding PHP, update widget endpoint)
# ─────────────────────────────────────────────────────────────
info "Copying chatbot..."
mkdir -p "$DIST/chatbot"

if [ -f "$PROJECT_ROOT/chatbot/knowledge-base.json" ]; then
    cp "$PROJECT_ROOT/chatbot/knowledge-base.json" "$DIST/chatbot/knowledge-base.json"
    success "chatbot/knowledge-base.json copied"
fi

# Copy widget.js but rewrite API endpoint: api.php → api
if [ -f "$PROJECT_ROOT/chatbot/widget.js" ]; then
    sed 's|chatbot/api\.php|chatbot/api|g' "$PROJECT_ROOT/chatbot/widget.js" > "$DIST/chatbot/widget.js"
    success "chatbot/widget.js copied (endpoint updated)"
fi

# ─────────────────────────────────────────────────────────────
# 5. SEO files
# ─────────────────────────────────────────────────────────────
info "Copying SEO files..."
[ -f "$PROJECT_ROOT/robots.txt" ] && cp "$PROJECT_ROOT/robots.txt" "$DIST/robots.txt" && success "robots.txt"
[ -f "$PROJECT_ROOT/sitemap.xml" ] && cp "$PROJECT_ROOT/sitemap.xml" "$DIST/sitemap.xml" && success "sitemap.xml"

# ─────────────────────────────────────────────────────────────
# 6. Cloudflare Pages: _redirects
# ─────────────────────────────────────────────────────────────
info "Creating _redirects..."
cat > "$DIST/_redirects" << 'REDIRECTS'
# NexiFy — Cloudflare Pages Redirects
# ── PHP → HTML (301 permanent, SEO-friendly) — GR ────────────
/index.php                  /                           301
/energy.php                 /energy.html                301
/ecosystem.php              /ecosystem.html             301
/virtual-office.php         /virtual-office.html        301
/virtual-office-apply.php   /virtual-office-apply.html  301
/partners.php               /partners.html              301
/careers.php                /careers.html               301
/faq.php                    /faq.html                   301
/contact.php                /contact.html               301
/terms.php                  /terms.html                 301
/privacy.php                /privacy.html               301
/cookies.php                /cookies.html               301
/gemi.php                   /gemi.html                  301

# ── PHP → HTML (301 permanent, SEO-friendly) — EN ────────────
/en/index.php               /en/                        301
/en/energy.php              /en/energy.html             301
/en/ecosystem.php           /en/ecosystem.html          301
/en/virtual-office.php      /en/virtual-office.html     301
/en/virtual-office-apply.php /en/virtual-office-apply.html 301
/en/partners.php            /en/partners.html           301
/en/careers.php             /en/careers.html            301
/en/faq.php                 /en/faq.html                301
/en/contact.php             /en/contact.html            301
/en/terms.php               /en/terms.html              301
/en/privacy.php             /en/privacy.html            301
/en/cookies.php             /en/cookies.html            301
/en/gemi.php                /en/gemi.html               301

# ── Chatbot API (rewrite to CF Pages Function) ───────────────
/chatbot/api.php            /chatbot/api                200
REDIRECTS
success "_redirects created"

# ─────────────────────────────────────────────────────────────
# 7. Cloudflare Pages: _headers
# ─────────────────────────────────────────────────────────────
info "Creating _headers..."
cat > "$DIST/_headers" << 'HEADERS'
# NexiFy — Cloudflare Pages Security & Cache Headers
/*
  X-Content-Type-Options: nosniff
  X-Frame-Options: SAMEORIGIN
  Referrer-Policy: strict-origin-when-cross-origin
  Permissions-Policy: camera=(), microphone=(), geolocation=()

/libs/*
  Cache-Control: public, max-age=31536000, immutable

/fonts/*
  Cache-Control: public, max-age=31536000, immutable

/css/*
  Cache-Control: public, max-age=86400

/js/*
  Cache-Control: public, max-age=86400

/images/*
  Cache-Control: public, max-age=604800

/*.mp4
  Cache-Control: public, max-age=604800
  Accept-Ranges: bytes

/*.html
  Cache-Control: no-cache
HEADERS
success "_headers created"

# ─────────────────────────────────────────────────────────────
# 8. GitHub Pages: CNAME file (custom domain)
# ─────────────────────────────────────────────────────────────
info "Creating CNAME for GitHub Pages..."
echo "nexify.gr" > "$DIST/CNAME"
success "CNAME (nexify.gr)"

# ─────────────────────────────────────────────────────────────
# 9. Summary
# ─────────────────────────────────────────────────────────────
echo ""
echo "╔══════════════════════════════════════════╗"
echo "║   ✅ BUILD COMPLETE                      ║"
echo "╚══════════════════════════════════════════╝"
echo ""
TOTAL_SIZE=$(du -sh "$DIST" | cut -f1)
HTML_COUNT=$(find "$DIST" -name "*.html" | wc -l)
echo "  Output dir : $DIST"
echo "  Total size : $TOTAL_SIZE"
echo "  HTML pages : $HTML_COUNT"
echo ""
echo "  ─── Next steps ──────────────────────────────────────"
echo ""
echo "  OPTION A (Drag & Drop — no CLI needed):"
echo "    1. Zip the dist/ folder"
echo "    2. Cloudflare → Pages → Create → Upload assets"
echo "    3. Drag & drop the zip"
echo ""
echo "  OPTION B (Wrangler CLI — recommended):"
echo "    npm install -g wrangler"
echo "    wrangler login"
echo "    wrangler pages deploy $DIST --project-name nexify-gr"
echo ""
echo "  Then in Cloudflare: nexify-gr.pages.dev → Custom Domain → nexify.gr"
echo ""
