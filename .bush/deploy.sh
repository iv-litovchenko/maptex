##!/usr/bin/env bash
#set -x
#cd /home/forge/domain.com
#cd $FORGE_SITE_PATH
#$PHP_PATH artisan down || true
#git reset --hard
#git clean -df
#git pull origin $BRANCH
#composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
#npm ci
#npm install
#npm run production
#$PHP_PATH artisan optimize
#$PHP_PATH artisan migrate:auto --force
#$PHP_PATH artisan cache:clear
#$PHP_PATH artisan auth:clear-resets
#$PHP_PATH artisan route:cache
#$PHP_PATH artisan config:cache
#$PHP_PATH artisan view:cache
#$PHP_PATH artisan up
echo "Successful deployment [sh]!";
