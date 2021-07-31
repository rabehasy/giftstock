init:
	docker-compose build --force-rm --no-cache
	make up
up:
	docker-compose up -d
	echo "App is running - http://127.0.0.1:8030"

schema-update:
	docker exec -it giftstock /home/giftstock/bin/console doctrine:database:create --if-not-exists
	docker exec -it giftstock /home/giftstock/bin/console doctrine:schema:update --force