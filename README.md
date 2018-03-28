# redis-mariadb
Script de comparação do Redis com MariaDB

# INSTALAÇÃO MARIADB

	sudo apt install mariadb-server
	sudo mysql_secure_installation

	CREATE USER 'php'@'localhost' IDENTIFIED BY '123456';
	GRANT ALL PRIVILEGES ON * . * TO 'php'@'localhost';
	FLUSH PRIVILEGES;
	CREATE DATABASE comparacao;

	USE comparacao;
	SOURCE comparacao.sql;

# INSTALAÇÃO PHP

	sudo apt install php

A versão usada é a 7.0, a padrão do Ubuntu 16.04.

# INSTALAÇÃO COMPOSER

	sudo apt install composer
	
Instalação do Predis:

	composer install

# INSTALAÇÃO REDIS

	sudo apt install redis-server

CONFIGURAÇÃO PARA O REDIS SALVAR TODAS AS ALTERAÇÕES NO DISCO:

	cd /etc/redis
	sudo nano redis.conf

Alterar as linhas:

	comentar: 'save 900 1'
	adicionar: 'save 1 1'

	mudar 'appendonly' para 'yes'

	mudar 'appendfsync' to 'always'

Reiniciar o Redis:

	sudo service redis-server restart

Testar o Redis:

	redis-cli

		ping
	

# EXECUTAR

	cd /home/<user>/redis-mariadb

Passar os parametros por argv para o script:

	php index.php [quantidade de linhas] [numero da rodada]

Exemplo:
	
	php index.php 15000 1

Sera escritas 15.000 linhas, atualizara as 15.000 linhas e removera as todas elas. Primeiramente do MariaDB e depois do Redis, na primeira rodada.

Repetindo isso pelo menos três vezes

	php index.php 15000 2
	php index.php 15000 3
	
E será armazenado os resultados ao final do tempo que levou para executar as operações em cada banco.

Para visualizar, sera feito a media com os dados obtidos para cada quantidade:

	SELECT
	  `tipo`,
	  `quant_insert`,
	  AVG(`time_redis`) AS redis,
	  AVG(`time_maria`) AS mariadb
	FROM
	  `resultado`
	WHERE
	  tipo = "[update] [select] [delete]"
	GROUP BY
	  `tipo`,
	  `quant_insert`
	  
Ou visualizando mais expecifico:
	
	SELECT
	  `tipo`,
	  `quant_insert`,
	  AVG(`time_redis`) AS redis,
	  AVG(`time_maria`) AS mariadb
	FROM
	  `resultado`
	WHERE
	  tipo = "[update] [select] [delete]" AND `quant_insert` = "[Quantidade de linhas]"
	GROUP BY
	  `tipo`,
	  `quant_insert`
	  
