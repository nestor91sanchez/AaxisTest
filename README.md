# AaxisTest

Building Symfony REST API.

## Requirements
- Docker
- Docker Compose

## Build

Start PHP, Nginx, and Postgres database.

```
docker compose build
docker compose up -d
```

## Run
Run the application

```
docker compose exec php bash

# Run the following commands inside the PHP container:

    # Install dependencies 
    > composer install
    
    # Create database schema
    > php bin/console doctrine:schema:create
    
    # Generate keys
    > php bin/console lexik:jwt:generate-keypair
    
    # Load initial data
    > php bin/console doctrine:fixtures:load
    
```

## Test API

Api Doc
```
http://localhost:8080/api/doc
```

Postman Samples
(Auth/GET/POST/PUT) (import the collection and environment files in your postman app)

```
postmanAaxisTest.postman_collection.json
postman/AaxisTest.postman_environment.json
```