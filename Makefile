up:
	docker-compose up -d

down:
	docker-compose down

stop:
	docker-compose stop

app:
	docker compose exec app bash

db:
	docker compose exec db bash


