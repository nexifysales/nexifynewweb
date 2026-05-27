#!/bin/bash
# ============================================================
# NEXIFY.GR — ΒΗΜΑ 2: Μεταφορά αρχείων στο Hetzner
# ============================================================
# Τρέξε ΣΤΟΝ DEVELOPMENT SERVER (αυτόν εδώ):
#   bash 2-upload-files.sh YOUR_HETZNER_IP
#
# ΠΑΡΑΔΕΙΓΜΑ:
#   bash 2-upload-files.sh 135.181.155.141
#
# ΠΡΟΑΠΑΙΤΟΥΜΕΝΑ:
#   1. SSH access στον Hetzner (root ή www-data)
#   2. Να έχεις τρέξει ήδη το 1-setup-hetzner.sh
# ============================================================

set -e

# ─────────────────────────────────────────
# Έλεγχος παραμέτρων
# ─────────────────────────────────────────
if [ -z "$1" ]; then
    echo ""
    echo "❌ Λείπει το Hetzner IP!"
    echo ""
    echo "Χρήση:   bash 2-upload-files.sh HETZNER_IP"
    echo "Παράδειγμα: bash 2-upload-files.sh 135.181.155.141"
    echo ""
    exit 1
fi

HETZNER_IP="$1"
SSH_USER="${2:-root}"           # Default: root (μπορείς να αλλάξεις)
SOURCE_DIR="/var/www/projects/nexifynewweb"
DEST_DIR="/var/www/nexify"
SSH_PORT="${3:-22}"             # Default port 22

# Χρώματα
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo ""
echo "=============================================="
echo " NEXIFY.GR — Μεταφορά αρχείων στο Hetzner"
echo "=============================================="
echo ""
echo " Από: $SOURCE_DIR"
echo " Σε:  $SSH_USER@$HETZNER_IP:$DEST_DIR"
echo " Port: $SSH_PORT"
echo ""

# ─────────────────────────────────────────
# Υπολογισμός μεγέθους
# ─────────────────────────────────────────
echo -e "${BLUE}[INFO]${NC} Υπολογισμός αρχείων..."
du -sh "$SOURCE_DIR" 2>/dev/null | awk '{print "Σύνολο source: " $1}'
echo ""

# ─────────────────────────────────────────
# ΕΞΑΙΡΕΣΕΙΣ (ΔΕΝ ανεβαίνουν στο production)
# ─────────────────────────────────────────
# - deploy/         → scripts, όχι για production
# - ticket_files/   → dev artifacts
# - .git/           → git repo
# - .claude/        → dev config
# - .heroagent/     → dev tool
# - *.md            → documentation
# - test_file.txt   → dev test
# - responsive-preview.php → dev only
# - *.html          → χρησιμοποιούμε .php, όχι .html
# - *pptx, *pdf (παρουσιάσεις, δεν χρειάζονται)
# ─────────────────────────────────────────

RSYNC_EXCLUDES=(
    "--exclude=deploy/"
    "--exclude=ticket_files/"
    "--exclude=.git/"
    "--exclude=.claude/"
    "--exclude=.heroagent/"
    "--exclude=*.md"
    "--exclude=DEPLOY.md"
    "--exclude=README.md"
    "--exclude=QA_REPORT.md"
    "--exclude=VERIFICATION_REPORT.md"
    "--exclude=test_file.txt"
    "--exclude=responsive-preview.php"
    "--exclude=indexnewnexify.html"
    "--exclude=*.pptx"
    "--exclude=_preview_logo.png"
    "--exclude=_unused_nexify_logo.svg"
    "--exclude=Slide*.PNG"
    "--exclude=pages/"
    "--exclude=.gitignore"
)

echo "Αρχεία που ΔΕΝ ανεβαίνουν (dev/test files):"
for excl in "${RSYNC_EXCLUDES[@]}"; do
    echo "  ✗ ${excl/--exclude=/}"
done
echo ""

echo "Πάτα ENTER για να ξεκινήσει η μεταφορά ή Ctrl+C για ακύρωση..."
read -r

# ─────────────────────────────────────────
# DRY RUN πρώτα (δείχνει τι θα ανέβει)
# ─────────────────────────────────────────
echo ""
echo -e "${BLUE}[INFO]${NC} Dry run — αρχεία που θα ανέβουν:"
echo "───────────────────────────────────────────"

rsync -avzn \
    --progress \
    -e "ssh -p $SSH_PORT -o StrictHostKeyChecking=no" \
    "${RSYNC_EXCLUDES[@]}" \
    "$SOURCE_DIR/" \
    "$SSH_USER@$HETZNER_IP:$DEST_DIR/" \
    2>&1 | grep -v "^$" | grep -v "^sending" | grep -v "^sent" | grep -v "^total" | head -50

echo "───────────────────────────────────────────"
echo ""
echo "Πάτα ENTER για να ξεκινήσει η ΠΡΑΓΜΑΤΙΚΗ μεταφορά..."
read -r

# ─────────────────────────────────────────
# ΠΡΑΓΜΑΤΙΚΗ ΜΕΤΑΦΟΡΑ
# ─────────────────────────────────────────
echo ""
echo -e "${BLUE}[INFO]${NC} Ξεκινά μεταφορά (μπορεί να πάρει λίγα λεπτά για τα videos)..."
echo ""

rsync -avz \
    --progress \
    --stats \
    -e "ssh -p $SSH_PORT -o StrictHostKeyChecking=no" \
    "${RSYNC_EXCLUDES[@]}" \
    "$SOURCE_DIR/" \
    "$SSH_USER@$HETZNER_IP:$DEST_DIR/"

echo ""
echo -e "${GREEN}✅ Μεταφορά ολοκληρώθηκε!${NC}"
echo ""

# ─────────────────────────────────────────
# Ρύθμιση permissions στον Hetzner
# ─────────────────────────────────────────
echo -e "${BLUE}[INFO]${NC} Ρύθμιση permissions..."

ssh -p "$SSH_PORT" -o StrictHostKeyChecking=no "$SSH_USER@$HETZNER_IP" << 'REMOTE'
    # Ownership: www-data
    chown -R www-data:www-data /var/www/nexify/

    # Directories: 755
    find /var/www/nexify -type d -exec chmod 755 {} \;

    # Files: 644
    find /var/www/nexify -type f -exec chmod 644 {} \;

    # PHP files: 640 (slightly more restrictive)
    find /var/www/nexify -name "*.php" -exec chmod 640 {} \;

    # Block execute on web files
    find /var/www/nexify -name "*.sh" -exec rm -f {} \; 2>/dev/null || true

    echo "✅ Permissions OK"

    # Verify files
    echo ""
    echo "Files στο /var/www/nexify:"
    ls -la /var/www/nexify/ | head -30
    echo ""
    echo "Μέγεθος site:"
    du -sh /var/www/nexify/
REMOTE

echo ""
echo "=============================================="
echo -e " ${GREEN}✅ ΜΕΤΑΦΟΡΑ ΟΛΟΚΛΗΡΩΘΗΚΕ!${NC}"
echo "=============================================="
echo ""
echo "Test (HTTP - πριν το DNS): http://$HETZNER_IP/"
echo ""
echo "ΕΠΟΜΕΝΑ ΒΗΜΑΤΑ:"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "ΒΗΜΑ 3: Αλλαγή DNS στο Cloudflare"
echo ""
echo "  1. Πήγαινε: https://dash.cloudflare.com"
echo "  2. Επίλεξε nexify.gr"
echo "  3. DNS → Records"
echo "  4. Άλλαξε A record nexify.gr → $HETZNER_IP"
echo "  5. Άλλαξε A record www → $HETZNER_IP"
echo "  6. ⚠️  ΑΠΕΝΕΡΓΟΠΟΙΗΣΕ το orange cloud (proxy OFF)"
echo "     Αυτό είναι κρίσιμο για να δουλέψει το SSL!"
echo ""
echo "ΒΗΜΑ 4: Μόλις αλλάξει το DNS (5-30 λεπτά):"
echo "  bash 3-ssl.sh $HETZNER_IP"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
