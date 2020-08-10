# make control register docker service

export $(xargs <.env)

export APP_ENV=stage
export APP_URL=http://localhost:8001
export APP_ID=app.futured.register
export MYSQL_ROOT_HOST=dbmysql
export MYSQL_ROOT_PASSWORD=devel
export MYSQL_USER=devel
export MYSQL_PASSWORD=devel
export MYSQL_DATABASE=futured_register
export API_TOKEN=d2a57dc1d883fd21fb9951699df71cc7

.PHONY: install build

install:
	sh ./install.sh

build: install
	docker-compose build

start: install
	docker-compose up
stop:
	docker-compose down
