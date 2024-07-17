#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    CREATE USER nextcloud WITH PASSWORD '$POSTGRES_PASSWORD';
    GRANT ALL PRIVILEGES ON DATABASE "nextcloud" to nextcloud;
    ALTER USER "nextcloud" WITH PASSWORD '$POSTGRES_PASSWORD';
EOSQL