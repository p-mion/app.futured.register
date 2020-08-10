#!/bin/sh

cd /var/www/

echo "APP_ENV=$APP_ENV" >.env
echo "APP_ID=$APP_ID" >>.env
echo "APP_URL=$APP_URL" >>.env
echo "API_TOKEN=$API_TOKEN" >>.env
echo "default_host=$MYSQL_ROOT_HOST" >>.env
echo "default_password=$MYSQL_ROOT_PASSWORD" >>.env
echo "default_user=$MYSQL_USER" >>.env
echo "default_database=$MYSQL_DATABASE" >>.env

sync

php -S 0.0.0.0:8001 -t /var/www/public
