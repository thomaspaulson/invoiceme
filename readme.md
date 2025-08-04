
docker compose up -d


docker compose run --rm \
    -w /application \
    php-fpm \
    composer install

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan key:generate

sudo chown -R $USER: .

chmod -R 775 storage bootstrap/cache

sudo   chown -R $USER:www-data storage bootstrap/cache


docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan migrate
