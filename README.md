# AaxisTest

Building Symfony REST API.

## Build

Start a Postgres database.

```
docker compose build up --build -d 
```

## Run
Run the application

```
docker compose exec php bash
```

Inside the docker container

```
composer install
php bin/console doctrine:schema:create
```

Load initial Data
```
php bin/console doctrine:fixtures:load
```

Api Doc
```
http://localhost:8080/api/doc
```

Postman Samples
(Auth/GET/POST/PUT) (you need to import the collection and environment files)

```
postmanAaxisTest.postman_collection.json
postman/AaxisTest.postman_environment.json
```