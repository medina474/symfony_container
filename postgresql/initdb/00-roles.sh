#!/bin/sh
set -e

BACKUP_PASSWORD=$(cat /run/secrets/backup_password)
GRAFANA_PASSWORD=$(cat /run/secrets/grafana_password)

psql -v ON_ERROR_STOP=1 <<EOF
-- Backup
create role backup login password '$BACKUP_PASSWORD';
grant connect on database $DATABASE_DB to backup;
grant pg_read_all_data to backup;
grant pg_read_all_settings to backup;
grant pg_read_all_stats to backup;

create role grafana noinherit login password '$GRAFANA_PASSWORD';
EOF
