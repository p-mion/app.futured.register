#!/bin/sh

source .env
cat ./database/sql/init.sql | mysql -p -u $default_user --password=$default_password
