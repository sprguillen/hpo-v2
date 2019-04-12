setup:
	composer install
	cp .env.example .env
	php artisan key:generate
	yarn
	make authorize

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
	npm run prod

refresh:
	php artisan cache:clear
	php artisan config:clear
	php artisan view:clear
	php artisan route:clear
	composer dump-autoload

migrate:
	php artisan migrate:fresh --seed
