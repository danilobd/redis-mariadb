# redis-mariadb
Script de comparação do Redis com MariaDB

# MARIADB

	sudo apt install mariadb-server
	sudo mysql_secure_installation

	CREATE USER 'php'@'localhost' IDENTIFIED BY '123456';
	GRANT ALL PRIVILEGES ON * . * TO 'php'@'localhost';
	FLUSH PRIVILEGES;
	CREATE DATABASE comparacao;

	USE comparacao;
	SOURCE comparacao.sql;

# PHP

	sudo apt install php
	sudo apt install php7.0-mysql

# COMPOSER

	sudo apt install composer
	composer install

# REDIS

	sudo apt install redis-server

/*TO REDIS SAVE ON DISK*/

	cd /etc/redis
	sudo nano redis.conf

comment: 'save 900 1'
add: 'save 1 1'

change 'appendonly' to 'yes'

chage 'appendfsync' to 'always'

	sudo service redis-server restart

	redis-cli
	ping
	exit

/*****/

	cd /home/<user>/redis-mariadb

	php index.php
