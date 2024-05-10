#!/bin/bash
echo "Deployment script started"

# temporary shutdown your Laravel server
php artisan down

# pull the latest changes from your git repository
git pull origin main

# TODO: add --no-dev option
# installing/updating composer dependencies
composer2 install --no-interaction --prefer-dist --optimize-autoloader

# running database migrations
php artisan migrate:fresh
php artisan db:seed
php artisan db:seed --class=TestSeeders

# Clear various caches
php artisan optimize:clear

# if you're using Laravel Telescope, you might want to clear entries
php artisan telescope:clear

# cache important data for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Restart queue worker daemons after their current job, commented out
# php artisan queue:restart

# restart your Laravel server
php artisan up

echo "Deployment script completed"
