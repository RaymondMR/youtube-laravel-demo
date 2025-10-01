#!/bin/sh
set -e

APP_BASE="/var/www/html"
STORAGE_DIR="$APP_BASE/storage"
CACHE_DIR="$APP_BASE/bootstrap/cache"

rm -rf "$STORAGE_DIR/framework/{cache,sessions,views}"

mkdir -p \
  "$STORAGE_DIR/framework/cache" \
  "$STORAGE_DIR/framework/sessions" \
  "$STORAGE_DIR/framework/testing" \
  "$STORAGE_DIR/framework/views" \
  "$STORAGE_DIR/logs"

touch "$STORAGE_DIR/logs/laravel.log"

chown -R www-data:www-data "$STORAGE_DIR" "$CACHE_DIR"
chmod -R 775 "$STORAGE_DIR" "$CACHE_DIR"

if [ "${RUN_MIGRATIONS_ON_BOOT:-false}" = "true" ]; then
  echo "[entrypoint] Running database migrations" >&2
  until php artisan migrate --force; do
    status=$?
    if [ $status -eq 0 ]; then
      break
    fi
    echo "[entrypoint] Migrations failed (exit $status), retrying in 5s..." >&2
    sleep 5
  done
fi

exec "$@"