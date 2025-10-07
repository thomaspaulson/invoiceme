
## Setting up locally

docker compose run --rm \
    -w /application \
    php-fpm \
    composer install

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan key:generate

docker compose up -d

To shutdown, run `docker compose down`


### if any isssue with file permission

sudo chown -R $USER: .

chmod -R 775 storage bootstrap/cache

sudo  chown -R $USER:www-data storage bootstrap/cache

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan migrate

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan migrate:rollback

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


docker compose run --rm \
    -w /application \
    php-fpm \
    sh

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan make:provider PsrEventServiceProvider

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan optimize:clear

docker compose run --rm \
    -w /application \
    php-fpm \
    php artisan make:queue-table


## Events

docker compose run --rm \
    -w /application \
    php-fpm \
    sh

    php artisan queue:work
