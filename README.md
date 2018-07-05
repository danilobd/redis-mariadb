# Comparação

## GIT CLONE

	https://github.com/danilobd/redis-mariadb.git

	cd redis-mariadb

## MARIADB

	sudo apt install mariadb-server

	sudo mysql_secure_installation

### CRIANDO USUARIO

	CREATE USER 'php'@'localhost' IDENTIFIED BY '123456';
	GRANT ALL PRIVILEGES ON * . * TO 'php'@'localhost';
	FLUSH PRIVILEGES;
	CREATE DATABASE comparacao;

	USE comparacao;
	SOURCE comparacao.sql;

## PHP

	sudo apt install php
	sudo apt install php7.0-mysql


### COMPOSER

	sudo apt install composer
	composer install --no-dev

## REDIS

	sudo apt install redis-server
	cd /etc/redis

### TO REDIS SAVE ON DISK

	sudo nano redis.conf

	comment: 'save 900 1'
	add: 'save 1 1'

	change 'appendonly' to 'yes'

	change 'appendfsync' to 'always'
	change 'appendfsync' to 'no'
	change 'appendfsync' to 'everysec'

	sudo service redis-server restart

	redis-cli
	ping
	exit


	cd /home/<user>/redis-mariadb


## TESTES

### On HD

#### everysec (A)
	bash rodatudo.sh a hd

#### always (B)
	bash rodatudo.sh b hd

#### no (C)
	bash rodatudo.sh c hd


### On SSD

#### everysec (A)
	bash rodatudo.sh a ssd

#### always (B)
	bash rodatudo.sh b ssd

#### no (C)
	bash rodatudo.sh c ssd


## Exportando

	mysqldump -u php -p comparacao resultado > resultado.sql