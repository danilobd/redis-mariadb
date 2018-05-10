# GIT CLONE

	https://github.com/danilobd/redis-mariadb.git

	cd redis-mariadb

# MARIADB

	sudo apt install mariadb-server

	sudo mysql_secure_installation

## CRIANDO USUARIO

	CREATE USER 'php'@'localhost' IDENTIFIED BY '123456';
	GRANT ALL PRIVILEGES ON * . * TO 'php'@'localhost';
	FLUSH PRIVILEGES;
	CREATE DATABASE comparacao;

	USE comparacao;
	SOURCE comparacao.sql;

# PHP

	sudo apt install php
	sudo apt install php7.0-mysql


## COMPOSER

	sudo apt install composer
	composer install --no-dev

# REDIS

	sudo apt install redis-server
	cd /etc/redis

## TO REDIS SAVE ON DISK

	sudo nano redis.conf

	comment: 'save 900 1'
	add: 'save 1 1'

	change 'appendonly' to 'yes'

	change 'appendfsync' to 'always'

	sudo service redis-server restart

	redis-cli
	ping
	exit


	cd /home/<user>/redis-mariadb

# TESTES

## TESTE 1

	php index.php 1 1
	php index.php 1 2
	php index.php 1 3
	php index.php 1 4
	php index.php 1 5

## TESTE 50

	php index.php 50 1
	php index.php 50 2
	php index.php 50 3
	php index.php 50 4
	php index.php 50 5

## TESTE 100

	php index.php 100 1
	php index.php 100 2
	php index.php 100 3
	php index.php 100 4
	php index.php 100 5

## TESTE 500

	php index.php 500 1
	php index.php 500 2
	php index.php 500 3
	php index.php 500 4
	php index.php 500 5

## TESTE 1.000

	php index.php 1000 1
	php index.php 1000 2
	php index.php 1000 3
	php index.php 1000 4
	php index.php 1000 5

## TESTE 5.000

	php index.php 5000 1
	php index.php 5000 2
	php index.php 5000 3
	php index.php 5000 4
	php index.php 5000 5

## TESTE 10.000

	php index.php 1000 1
	php index.php 1000 2
	php index.php 1000 3
	php index.php 1000 4
	php index.php 1000 5

## TESTE 15.000

	php index.php 15000 1
	php index.php 15000 2
	php index.php 15000 3
	php index.php 15000 4
	php index.php 15000 5

## TESTE 20.000

	php index.php 20000 1
	php index.php 20000 2
	php index.php 20000 3
	php index.php 20000 4
	php index.php 20000 5

## TESTE 25.000

	php index.php 25000 1
	php index.php 25000 2
	php index.php 25000 3
	php index.php 25000 4
	php index.php 25000 5

## TESTE 30.000

	php index.php 30000 1
	php index.php 30000 2
	php index.php 30000 3
	php index.php 30000 4
	php index.php 30000 5

