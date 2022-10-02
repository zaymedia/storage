init: init-ci
init-ci: docker-down-clear \
	docker-pull docker-build docker-up \
	composer-install wait-db db-migrations

up: docker-up
down: docker-down
restart: down up

#Check all
check: lint analyze db-validate-schema test

#Docker
docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build --pull

wait-db:
	docker-compose run --rm php-cli wait-for-it db:3306 -t 30

#Lint and analyze
lint:
	docker-compose run --rm php-cli composer lint
	docker-compose run --rm php-cli composer php-cs-fixer fix -- --dry-run --diff

cs-fix:
	docker-compose run --rm php-cli composer php-cs-fixer fix

analyze:
	docker-compose run --rm php-cli composer psalm

#DB
db-validate-schema:
	docker-compose run --rm php-cli composer app orm:validate-schema

db-migrations-diff:
	docker-compose run --rm php-cli composer app migrations:diff

db-migrations:
	docker-compose run --rm php-cli composer app migrations:migrate -- --no-interaction

db-fixtures:
	docker-compose run --rm php-cli composer app fixtures:load

#Tests
test:
	docker-compose run --rm php-cli composer test

test-coverage:
	docker-compose run --rm php-cli composer test-coverage

test-unit:
	docker-compose run --rm php-cli composer test -- --testsuite=unit

test-unit-coverage:
	docker-compose run --rm php-cli composer test-coverage -- --testsuite=unit

test-functional:
	docker-compose run --rm php-cli composer test -- --testsuite=functional

test-functional-coverage:
	docker-compose run --rm php-cli composer test-coverage -- --testsuite=functional

#Composer
composer-install:
	docker-compose run --rm php-cli composer install

composer-update:
	docker-compose run --rm php-cli composer update

composer-autoload:
	docker-compose run --rm php-cli composer dump-autoload

composer-outdated:
	docker-compose run --rm php-cli composer outdated
