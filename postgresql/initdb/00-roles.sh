#!/bin/sh
set -e

ROLE_BACKUP_PASSWORD=$(cat /run/secrets/role_backup_password)
ROLE_GRAFANA_PASSWORD=$(cat /run/secrets/role_grafana_password)

psql -v ON_ERROR_STOP=1 \
    --username "$POSTGRES_USER" \
    --dbname "$POSTGRES_DB" <<EOF
-- Backup
create role backup login password '$ROLE_BACKUP_PASSWORD';
grant connect on database $POSTGRES_DB to backup;
grant pg_read_all_data to backup;
grant pg_read_all_settings to backup;
grant pg_read_all_stats to backup;

create role grafana noinherit login password '$ROLE_GRAFANA_PASSWORD';
EOF
