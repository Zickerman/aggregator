Before starting the project, you need to install docker and php on your computer.
Rename .env.example to .env

Then execute the following commands in the project root directory: 
 - docker compoose up -d
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

- open http://localhost:8098