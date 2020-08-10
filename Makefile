# make control register docker service


export $(xargs <.env)

export APP_ENV=stage
export APP_ID=app.futured.register
export APP_URL=http://localhost:8001
export MYSQL_ROOT_HOST=dbmysql
export MYSQL_ROOT_PASSWORD=devel
export MYSQL_USER=devel
export MYSQL_PASSWORD=devel
export MYSQL_DATABASE=futured_register
export API_TOKEN=d2a57dc1d883fd21fb9951699df71cc7

.PHONY: build

build: prepare
	docker-compose build --no-cache

prepare:
	@sh ./install.sh

start: prepare
	docker-compose up --remove-orphans

stop:
	docker-compose down
