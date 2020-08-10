# make control register docker service

export $(xargs <.env)

export APP_ENV=stage
export MYSQL_ROOT_HOST=dbmysql
export MYSQL_ROOT_PASSWORD=devel
export MYSQL_USER=devel
export MYSQL_PASSWORD=devel
export MYSQL_DATABASE=futured_register
export API_TOKEN=d2a57dc1d883fd21fb9951699df71cc7

.PHONY: build

build:
	docker-compose build

start:
	docker-compose up
stop:
	docker-compose down
