#!/bin/sh

if [ ! -d "vendor" ]; then
	echo "Prepare composer autoloader..."
	composer install --no-dev
fi

if [ ! -f ".env" ]; then
	echo "Create local .env..."
	echo "APP_ENV=develop" >.env
    echo "APP_ID=$APP_ID" >>.env
    echo "APP_URL=http://localhost:8000" >>.env
    echo "APP_DOCKER_URL=http://localhost:8001" >>.env
    echo "API_TOKEN=d2a57dc1d883fd21fb9951699df71cc7" >>.env
    echo "default_host=localhost" >>.env
    echo "default_password=devel" >>.env
    echo "default_user=devel" >>.env
    echo "default_database=futured_register" >>.env
fi

exit 0
