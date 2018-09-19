echo Down application
docker-compose down

echo Uploading Application container
docker-compose up -d

echo Config clear
php artisan config:clear

echo Copying the configuration example file
docker-compose exec app cp .env.example .env

echo Install dependencies
docker-compose exec app composer install

echo Generate key
docker-compose exec app php artisan key:generate

echo Migrate and seed
docker-compose exec app php artisan migrate:fresh --seed

echo Information of new containers
docker ps -a
