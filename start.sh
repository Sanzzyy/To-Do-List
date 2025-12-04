#!/usr/bin/env bash
set -e

# fallback mount path jika RAILWAY_VOLUME_MOUNT_PATH tidak tersedia
VOLUME_PATH="${RAILWAY_VOLUME_MOUNT_PATH:-/data}"

# path sqlite (gunakan DB_DATABASE env jika tersedia, kalau tidak pakai fallback)
DB_PATH="${DB_DATABASE:-${VOLUME_PATH}/database.sqlite}"

echo "Using DB path: $DB_PATH"

# pastikan direktori ada
mkdir -p "$(dirname "$DB_PATH")"

# buat file sqlite jika belum ada
if [ ! -f "$DB_PATH" ]; then
  echo "Creating sqlite file at $DB_PATH"
  touch "$DB_PATH"
fi

# generate APP_KEY jika belum ada
if [ -z "$APP_KEY" ]; then
  echo "APP_KEY not set - generating key"
  php artisan key:generate --force
fi

# jalankan migrate (pakai --force agar non-interactive)
echo "Running migrations..."
php artisan migrate --force || true

# jalankan server
PORT="${PORT:-8080}"
echo "Starting php built-in server on 0.0.0.0:$PORT"
php artisan serve --host=0.0.0.0 --port="$PORT"
