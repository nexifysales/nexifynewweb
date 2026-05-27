#!/bin/bash
# ============================================================
# Nexify.gr - Export Database
# Εκτέλεσε στον development server για να φτιάξεις backup DB
# ============================================================

TIMESTAMP=$(date +%Y%m%d_%H%M%S)
BACKUP_FILE="/tmp/nexify_db_${TIMESTAMP}.sql"
HETZNER_IP="${1:-}"

echo "Exporting database..."
mysqldump \
    -u nexifynewweb_user \
    -p'IC684uwjinsHPZrQ' \
    --single-transaction \
    --routines \
    --triggers \
    nexifynewweb_db > "$BACKUP_FILE" 2>/dev/null

if [ $? -eq 0 ]; then
    echo "✅ Database exported to: $BACKUP_FILE"
    ls -lh "$BACKUP_FILE"

    if [ -n "$HETZNER_IP" ]; then
        echo ""
        echo "Copying to Hetzner ($HETZNER_IP)..."
        scp "$BACKUP_FILE" "root@$HETZNER_IP:/tmp/nexify_db.sql"
        echo "✅ Copied to Hetzner"
        echo ""
        echo "Now on Hetzner run:"
        echo "  mysql -u nexify_user -p nexify_db < /tmp/nexify_db.sql"
    else
        echo ""
        echo "Για να στείλεις στο Hetzner:"
        echo "  scp $BACKUP_FILE root@YOUR_HETZNER_IP:/tmp/nexify_db.sql"
        echo ""
        echo "Μετά στο Hetzner:"
        echo "  mysql -u nexify_user -p nexify_db < /tmp/nexify_db.sql"
    fi
else
    echo "❌ Database export failed"
    exit 1
fi
