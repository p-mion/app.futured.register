#!/bin/sh

sh ./install.sh

export $(xargs <.env)

cat ./docker/mysql/entrypoint/init.sql | mysql -p -u $default_user --password=$default_password

echo "local server: http://localhost:8000"

php -S 0.0.0.0:8000 -t ./public
