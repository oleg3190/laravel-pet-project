up: docker-up-d
down: docker-down
docker-up-d: 
		sudo docker-compose up
  
log: 
		docker-compose up logstash
phpcs:
		phpcs --standard=PSR12 app
ng: 
		docker-compose up nginx
f: 
		docker-compose up fpm
b: 
		docker-compose build fpm
n: 
		docker-compose build nginx
bl:
		docker-compose up blackfire
ex:
	docker exec -it 6a9cb804e6d7 blackfire agent:config --dump 
docker-down:
		sudo docker-compose down --remove-orphans

bash:
	docker exec -it d_fpm_1 bash

ar:
	docker exec -it d_fpm_1 php artisan $(n)

mig:
	docker exec -it d_fpm_1 php artisan migrate