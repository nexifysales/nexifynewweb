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
# 2. Ανεβάζει το dist/ στο branch gh-pages του GitHub
# ============================================================

set -e

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"
DIST="$SCRIPT_DIR/dist"

GREEN='\033[0;32m'; BLUE='\033[0;34m'; RED='\033[0;31m'; NC='\033[0m'
info()    { echo -e "${BLUE}[INFO]${NC} $1"; }
success() { echo -e "${GREEN}[OK]${NC} $1"; }
error()   { echo -e "${RED}[ERROR]${NC} $1"; exit 1; }

# ─────────────────────────────────────────────────────────────
# 1. Build
# ─────────────────────────────────────────────────────────────
info "Running build..."
cd "$PROJECT_ROOT"
bash deploy/build.sh
success "Build complete"

# ─────────────────────────────────────────────────────────────
# 2. Push dist/ to gh-pages branch
# ─────────────────────────────────────────────────────────────
info "Pushing dist/ to gh-pages branch..."

# Δημιούργησε temp dir
TMP_DIR=$(mktemp -d)
trap "rm -rf $TMP_DIR" EXIT

# Copy dist files
cp -r "$DIST/." "$TMP_DIR/"

# Init git στο temp dir και push
cd "$TMP_DIR"
git init
git config user.email "deploy@nexify.gr"
git config user.name "Nexify Deploy"
git checkout -b gh-pages

# Προσθήκη .nojekyll (σημαντικό για GitHub Pages!)
touch .nojekyll

git add -A
git commit -m "Deploy $(date '+%Y-%m-%d %H:%M:%S')"

# Push στο GitHub (χρησιμοποιεί τα credentials του συστήματος)
git remote add origin "$(cd "$PROJECT_ROOT" && git remote get-url origin)"
git push origin gh-pages --force

success "✅ Pushed to gh-pages branch!"
echo ""
echo "  Τώρα:"
echo "  1. github.com/nexifysales/nexifynewweb → Settings → Pages"
echo "  2. Source: 'Deploy from a branch'"
echo "  3. Branch: 'gh-pages' | Folder: '/ (root)'"
echo "  4. Save"
echo "  5. Custom domain: nexify.gr"
echo ""
echo "  Σε 2-3 λεπτά θα είναι live! 🚀"
