COMPOSE=docker compose
EXECAPI=$(COMPOSE) exec api

start:
	$(COMPOSE) build --force-rm
	$(COMPOSE) up -d --remove-orphans --force-recreate

up:
	$(COMPOSE) up -d --remove-orphans

stop:
	$(COMPOSE) stop

down:
	$(COMPOSE) down

ssh:
	$(EXECAPI) sh
