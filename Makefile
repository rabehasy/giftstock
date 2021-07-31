init:
	docker-compose build --force-rm --no-cache
	make up
up:
	docker-compose up -d
	echo "App is running - http://127.0.0.1:8030"