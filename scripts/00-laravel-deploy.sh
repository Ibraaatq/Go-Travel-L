#!/usr/bin/env bash
set -e

echo "==> Setting up storage and cache directories..."
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/database

# Jika menggunakan SQLite dan database belum ada, buat file database.sqlite
if [ "${DB_CONNECTION}" = "sqlite" ]; then
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        touch /var/www/html/database/database.sqlite
    fi
fi

chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/database

echo "==> Running Composer install..."
composer install --no-dev --optimize-autoloader --no-interaction --working-dir=/var/www/html

echo "==> Creating storage symlink..."
php artisan storage:link || true

echo "==> Caching Laravel configuration and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Running migrations & seeders..."
php artisan migrate --force
php artisan db:seed --force

echo "==> Go-Travel Laravel deployment ready!"
