### Desafio Backend Pic Pay

Find task description at this [link](https://picpay.com/jobs/desafio-backend-php).

### Download postman collection

Download and import postman collection [here](picpay.postman_collection.json).

### Installing the application

#### Run docker-compose

```docker-compsose up -d --build```

#### Run composer

```docker exec docker exec -it picpay-php-fpm composer install```

#### Run schema update

```docker exec docker exec -it picpay-php-fpm php doctrine:schema:update --force```

#### Application will be running at http://localhost:8000



