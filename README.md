# Habitissimo backend test: Bags Kata

This project tries to provide a solution to Bags Kata, following the SOLID principles through test-guided development (TDD)

## Infrastructure installation

1.- Access to docker folder

2.- Build the containers

```
docker-compose build --pull
```

3.- Run the containers

```
docker-compose up -d
```

4.- Install dependencies

```
docker exec -it kata-php bash
composer install
```

## Execute tests

```
docker exec -it kata-php bash
./vendor/bin/phpunit
```

## Execute PHPStan

```
docker exec -it kata-php bash
./vendor/bin/phpstan analyse
```

## Execute Psalm

```
docker exec -it kata-php bash
./vendor/bin/psalm
```

## Execute PHP-CS-FiXER

```
docker exec -it kata-php bash
./vendor/bin/php-cs-fixer fix
```

## Bags Kata

All the information about Bags Kata is available at: [Katalist](https://katalyst.codurance.com/bags)
