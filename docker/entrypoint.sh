#!/bin/sh

echo "reserving mysql"
until nc -z lucky_game_app_mysql 3306; do
  sleep 1
done
echo "mysql ready"

if [ ! -f .env ]; then
  echo "copied .env"
  cp .env.example .env
fi

if [ ! -d vendor ]; then
  echo "install dependencies with composer"
  composer install --optimize-autoloader --no-interaction
fi

php artisan config:clear

php artisan key:generate

php artisan migrate --force
php artisan optimize

echo "started supervisord"
exec supervisord -c /etc/supervisord.conf
