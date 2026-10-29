#!/bin/bash

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force --seed

# Storage link
php artisan storage:link

# Start php-fpm
php-fpm -D

# Start nginx
nginx -g "daemon off;"
