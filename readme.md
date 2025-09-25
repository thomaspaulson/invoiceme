
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

sudo  chown -R $USER:www-data storage bootstrap/cache


docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan migrate

chmod -R 775 database
chmod 664 database/database.sqlite
sudo chown -R $USER:www-data database


docker compose down -v

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan make:migration create_invoices_table

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan install:api

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan route:list
