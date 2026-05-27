#!/bin/bash
# ============================================================
# Nexify.gr - Transfer Files to Hetzner
# Εκτέλεσε ΑΠΟ ΤΟΝ DEVELOPMENT SERVER (ή local machine):
#   bash transfer-files.sh YOUR_HETZNER_IP
# ============================================================

HETZNER_IP="${1:-YOUR_HETZNER_IP}"
HETZNER_USER="${2:-root}"
SOURCE_DIR="/var/www/projects/nexifynewweb/"
DEST_DIR="/var/www/nexify/"

if [ "$HETZNER_IP" = "YOUR_HETZNER_IP" ]; then
    echo "❌ Δώσε το Hetzner IP:"
    echo "   bash transfer-files.sh 1.2.3.4"
    exit 1
fi

echo "=============================================="
echo " Nexify.gr - File Transfer"
echo "=============================================="
echo " Source:  $SOURCE_DIR"
echo " Dest:    $HETZNER_USER@$HETZNER_IP:$DEST_DIR"
echo "=============================================="
echo ""
echo "Πάτα Enter για να ξεκινήσεις..."
read

echo "Transferring files..."

rsync -avz \
    --progress \
    --exclude='.git' \
    --exclude='.gitignore' \
    --exclude='.claude' \
    --exclude='.heroagent' \
    --exclude='ticket_files/' \
    --exclude='deploy/' \
    --exclude='*.html' \
    --exclude='DEPLOY.md' \
    --exclude='QA_REPORT.md' \
    --exclude='README.md' \
    --exclude='VERIFICATION_REPORT.md' \
    --exclude='responsive-preview.php' \
    --exclude='test_file.txt' \
    --exclude='indexnewnexify.html' \
    --exclude='logos partners.pptx' \
    --exclude='*.pptx' \
    --exclude='.env' \
    "$SOURCE_DIR" \
    "$HETZNER_USER@$HETZNER_IP:$DEST_DIR"

echo ""
echo "✅ Transfer complete!"
echo ""
echo "Επόμενα βήματα:"
echo "1. SSH στον Hetzner: ssh $HETZNER_USER@$HETZNER_IP"
echo "2. Set permissions: chown -R www-data:www-data $DEST_DIR"
echo "3. Έλεγξε στο: http://$HETZNER_IP"
