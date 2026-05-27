#!/bin/bash
# ============================================================
# NEXIFY.GR — Push dist/ to gh-pages branch
# ============================================================
# Χρήση:
#   cd /var/www/projects/nexifynewweb
#   bash deploy/push-to-ghpages.sh
#
# Αυτό το script:
# 1. Κάνει build (PHP → HTML)
# 2. Ανεβάζει τα static files στο branch gh-pages του GitHub
# ============================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

GREEN='\033[0;32m'; BLUE='\033[0;34m'; RED='\033[0;31m'; YELLOW='\033[1;33m'; NC='\033[0m'
info()    { echo -e "${BLUE}[INFO]${NC} $1"; }
success() { echo -e "${GREEN}[OK]${NC} $1"; }
warn()    { echo -e "${YELLOW}[WARN]${NC} $1"; }
error()   { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

# ─────────────────────────────────────────────────────────────
# 1. Build
# ─────────────────────────────────────────────────────────────
info "Running build..."
cd "$PROJECT_ROOT"
bash deploy/build.sh

# Get the dist path from build.sh export (fallback to /tmp/nexify-dist)
DIST="${NEXIFY_DIST:-/tmp/nexify-dist}"
if [ ! -d "$DIST" ]; then
    DIST="$SCRIPT_DIR/dist"
fi
if [ ! -d "$DIST" ]; then
    error "Build output not found at $DIST"
fi
success "Build complete — output: $DIST"

# ─────────────────────────────────────────────────────────────
# 2. Push dist/ to gh-pages branch via temp git repo
# ─────────────────────────────────────────────────────────────
info "Pushing to gh-pages branch on GitHub..."

# Get remote URL from project git
REMOTE_URL=$(cd "$PROJECT_ROOT" && git remote get-url origin 2>/dev/null) || error "Cannot get git remote URL"
info "Remote: $REMOTE_URL"

# Create temp work dir
TMP_DIR=$(mktemp -d)
cleanup() { rm -rf "$TMP_DIR"; }
trap cleanup EXIT

# Copy built files to temp dir
cp -r "$DIST/." "$TMP_DIR/"

# Init fresh git repo in temp dir
cd "$TMP_DIR"
git init -b gh-pages
git config user.email "deploy@nexify.gr"
git config user.name "Nexify Deploy"

# Add .nojekyll (IMPORTANT for GitHub Pages!)
touch .nojekyll

git add -A
git commit -m "Deploy $(date '+%Y-%m-%d %H:%M:%S')"

# Push to GitHub
git remote add origin "$REMOTE_URL"
git push origin gh-pages --force

success "✅ Pushed to gh-pages branch!"
echo ""
echo "  ─── Ρυθμίσεις GitHub Pages ────────────────────────"
echo ""
echo "  1. https://github.com/nexifysales/nexifynewweb"
echo "     → Settings → Pages"
echo ""
echo "  2. Build and deployment:"
echo "     Source: 'Deploy from a branch'"
echo "     Branch: 'gh-pages'  |  Folder: '/ (root)'"
echo "     → Save"
echo ""
echo "  3. Custom domain: nexify.gr"
echo "     → Save (θα δημιουργηθεί αυτόματα DNS check)"
echo ""
echo "  4. DNS στο Papaki/Cloudflare:"
echo "     CNAME  www    nexifysales.github.io"
echo "     A      @      185.199.108.153"
echo "     A      @      185.199.109.153"
echo "     A      @      185.199.110.153"
echo "     A      @      185.199.111.153"
echo ""
echo "  Σε 5-10 λεπτά θα είναι live στο nexify.gr 🚀"
echo ""
