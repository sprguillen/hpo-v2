setup:
	composer install
	cp .env.example .env
	php artisan key:generate
	yarn
	make authorize
	php artisan passport:install

authorize:
	rm -rf ./storage/logs/laravel.log
	touch ./storage/logs/laravel.log
	sudo chmod -R 777 ./storage/
	sudo chmod -R 777 ./vendor/
	sudo chmod -R 777 ./bootstrap/cache/
	composer dump-autoload
	php artisan cache:clear

update:
	rm -rf ./storage/logs/laravel.log
	touch ./storage/logs/laravel.log
	sudo chmod -R 777 ./storage
	composer install
	composer dump-autoload
	php artisan cache:clear
	php artisan migrate
	yarn
	make testApi

refresh:
	php artisan cache:clear
	php artisan config:clear
	php artisan view:clear
	php artisan route:clear
	php artisan optimize:clear
	composer dump-autoload

migrate:
	php artisan migrate:fresh --seed
	php artisan passport:install

testApi:
	./vendor/bin/phpunit ./tests/Api/.

testSpecific:
	./vendor/bin/phpunit --filter ${class} tests/Api/${path}

setupPassport:
	php artisan passport:install
	php artisan passport:client --client
