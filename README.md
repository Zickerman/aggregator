Before starting the project, you need to install docker and php on your computer.
Rename .env.example to .env

Then execute the following commands in the project root directory: 
 - docker compose up -d
 - wait few minutes. If some problems like: "Ports are not available....... address already in use" try to execute:
 sudo lsof -i :<port_number>
 sudo kill <pid>

 - docker compose exec fpm bash
 - composer install
 - exit
 - docker exec -it postgresdb psql -U postgres
 - CREATE DATABASE agr;
 - exit
 - docker compose exec fpm bash
 - php artisan migrate
 - php artisan key:generate

make sure you have permissions to the STORAGE folder (outside the container)
if some problem when execute npm install like:
npm error [Error: EACCES: permission denied, mkdir '/var/www/laravel-docker/node_modules/fsevents']
execute:
- sudo chown -R 1000:1000 ./node_modules
- npm install


- open http://localhost:8098



usefull commands:
- docker compose exec -u root fpm bash

inside the container(docker compose exec -u root fpm bash)
execute (this allows you to launch npm run dev): 
apt install npm
to update mix components (launch after changes in the front side):
npm run dev

for launche the queue (we can check it here: http://localhost:15672):
php artisan queue:work

