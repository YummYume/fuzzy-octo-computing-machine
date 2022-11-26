COMPOSE=docker compose
EXECNODE=$(COMPOSE) exec node
EXECPHP=$(COMPOSE) exec php
EXECREACT=$(COMPOSE) exec react

start:
	$(COMPOSE) build --force-rm
	$(COMPOSE) up -d --remove-orphans --force-recreate
	make composer
	make db

up:
	$(COMPOSE) up -d --remove-orphans

stop:
	$(COMPOSE) stop

down:
	$(COMPOSE) down

ssh-node:
	$(EXECNODE) bash

ssh-php:
	$(EXECPHP) bash

ssh-react:
	$(EXECREACT) bash

composer:
	$(EXECPHP) composer install --ignore-platform-reqs

db-drop:
	make wait-for-db
	$(EXECPHP) php bin/console d:d:d --if-exists --force
	make db

db:
	make wait-for-db
	$(EXECPHP) php bin/console d:d:c --if-not-exists
	$(EXECPHP) php bin/console d:s:u --force

rabbitmq-consume:
	$(EXECPHP) php bin/console messenger:consume -vv

wait-for-db:
	$(EXECPHP) php -r "set_time_limit(60);for(;;){if(@fsockopen(\"db\",3306)){break;}echo \"Waiting for DB\n\";sleep(1);}"
