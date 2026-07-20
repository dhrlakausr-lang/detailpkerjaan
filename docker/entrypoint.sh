#!/bin/sh
set -e

if [ ! -f .env ]; then
    {
        echo "APP_NAME=${APP_NAME:-LokerinAja}"
        echo "APP_ENV=${APP_ENV:-production}"
        echo "APP_KEY=${APP_KEY}"
        echo "APP_DEBUG=${APP_DEBUG:-false}"
        echo "APP_URL=${APP_URL:-http://localhost:8000}"
        echo "ASSET_URL=${ASSET_URL:-${APP_URL:-http://localhost:8000}}"
        echo
        echo "APP_LOCALE=${APP_LOCALE:-en}"
        echo "APP_FALLBACK_LOCALE=${APP_FALLBACK_LOCALE:-en}"
        echo "APP_FAKER_LOCALE=${APP_FAKER_LOCALE:-en_US}"
        echo
        echo "LOG_CHANNEL=${LOG_CHANNEL:-stack}"
        echo "LOG_STACK=${LOG_STACK:-single}"
        echo "LOG_LEVEL=${LOG_LEVEL:-debug}"
        echo
        echo "DB_CONNECTION=${DB_CONNECTION:-mysql}"
        echo "DB_HOST=${DB_HOST:-127.0.0.1}"
        echo "DB_PORT=${DB_PORT:-3306}"
        echo "DB_DATABASE=${DB_DATABASE:-lokerinaja}"
        echo "DB_USERNAME=${DB_USERNAME:-root}"
        echo "DB_PASSWORD=${DB_PASSWORD:-}"
        echo
        echo "SESSION_DRIVER=${SESSION_DRIVER:-file}"
        echo "SESSION_LIFETIME=${SESSION_LIFETIME:-120}"
        echo "SESSION_ENCRYPT=${SESSION_ENCRYPT:-false}"
        echo "SESSION_PATH=${SESSION_PATH:-/}"
        echo "SESSION_DOMAIN=${SESSION_DOMAIN:-null}"
        echo
        echo "BROADCAST_CONNECTION=${BROADCAST_CONNECTION:-log}"
        echo "FILESYSTEM_DISK=${FILESYSTEM_DISK:-local}"
        echo "QUEUE_CONNECTION=${QUEUE_CONNECTION:-sync}"
        echo "CACHE_STORE=${CACHE_STORE:-file}"
        echo
        echo "MAIL_MAILER=${MAIL_MAILER:-log}"
        echo "MAIL_HOST=${MAIL_HOST:-127.0.0.1}"
        echo "MAIL_PORT=${MAIL_PORT:-2525}"
        echo "MAIL_USERNAME=${MAIL_USERNAME:-null}"
        echo "MAIL_PASSWORD=${MAIL_PASSWORD:-null}"
        echo "MAIL_ENCRYPTION=${MAIL_ENCRYPTION:-null}"
        echo "MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-hello@example.com}"
        echo "MAIL_FROM_NAME=${MAIL_FROM_NAME:-LokerinAja}"
        echo
        echo "VITE_APP_NAME=${VITE_APP_NAME:-LokerinAja}"
    } > .env
fi

if ! grep -q '^APP_KEY=base64:' .env; then
    php artisan key:generate --force
fi

php artisan optimize:clear >/dev/null 2>&1 || true

exec "$@"
