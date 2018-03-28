<?php 


	$tanto 	= $argv[1];
	$rodada = $argv[2];

	echo "\nQuantidade: ".$tanto." Rodada: $rodada\n\n\n";

	echo "********INSERÇÃO:********\n";

	function ColocaMysql(){
	
		global $tanto;

		require_once("mysql/conecta.inc.php");
		$pdo = conect();

		for($i=1;$i<=$tanto;$i++){

			$ColocaMysql=$pdo->prepare("
				INSERT INTO
				  `coisas`
				SET
				  `valor` = :valor");
			$ColocaMysql->bindvalue(":valor", $i, PDO::PARAM_INT);
			$ColocaMysql->execute();

			//SE ENCONTROU ALGUMA COISA
			if($ColocaMysql->rowCount() != 0);
				//echo "Foi no mysql";
			else
				echo "\n---------->Deu ruim no mysql - Inserção";

		}

	}
	
	function ColocaRedis(){

		global $tanto;

		require_once("redis/redis.class.php");

		$Redis = new RedisData();

		for($i=1;$i<=$tanto;$i++){
			$result = $Redis->SET("teste:".$i, $i);
		}

	}


	$inicioColoca1 = microtime(true);
		ColocaMysql();
	$totalColoca1 = microtime(true) - $inicioColoca1;
	echo "\nMariaDB: ".$totalColoca1;


	$inicioColoca2 = microtime(true);
		ColocaRedis();
	$totalColoca2 = microtime(true) - $inicioColoca2;
	echo " | Redis: ".$totalColoca2;


	if($totalColoca1 <= $totalColoca2){
		echo "\n\nMariaDB win: ".($totalColoca2 - $totalColoca1)." mais rápido\n\n";
		$resultadoColoca = $totalColoca2 - $totalColoca1;
	}
	else{
		echo "\n\nRedis win: ".($totalColoca1 - $totalColoca2)." mais rápido\n\n";	
		$resultadoColoca = $totalColoca1 - $totalColoca2;
	}





	echo "\n********ATUALIZAÇÃO:********\n";

	function AtualizaMysql(){
	
		global $tanto;

		require_once("mysql/conecta.inc.php");
		$pdo = conect();

		for($i=1;$i<=$tanto;$i++){

			$ColocaMysql=$pdo->prepare("
				UPDATE
				  `coisas`
				SET
				  `valor` = :valor
				WHERE
				  `chave` = :chave");
			$ColocaMysql->bindvalue(":chave", $i, PDO::PARAM_INT);
			$ColocaMysql->bindvalue(":valor", $i+1, PDO::PARAM_INT);
			$ColocaMysql->execute();

			//SE ENCONTROU ALGUMA COISA
			if($ColocaMysql->rowCount() != 0);
				//echo "Foi no mysql";
			else
				echo "\n---------->Deu ruim no mysql - Atualização";

		}

	}
	
	function AtualizaRedis(){

		global $tanto;

		require_once("redis/redis.class.php");

		$Redis = new RedisData();

		for($i=1;$i<=$tanto;$i++){
			$result = $Redis->SET("teste:".$i, $i+1);
		}

	}


	$inicioAtualiza1 = microtime(true);
		AtualizaMysql();
	$totalAtualiza1 = microtime(true) - $inicioAtualiza1;
	echo "\nMariaDB: ".$totalAtualiza1;


	$inicioAtualiza2 = microtime(true);
		AtualizaRedis();
	$totalAtualiza2 = microtime(true) - $inicioAtualiza2;
	echo " | Redis: ".$totalAtualiza2;


	if($totalAtualiza1 <= $totalAtualiza2){
		echo "\n\nMariaDB win: ".($totalAtualiza2 - $totalAtualiza1)." mais rápido\n\n";
		$resultadoAtualiza = $totalAtualiza2 - $totalAtualiza1;
	}
	else{
		echo "\n\nRedis win: ".($totalAtualiza1 - $totalAtualiza2)." mais rápido\n\n";
		$resultadoAtualiza = $totalAtualiza1 - $totalAtualiza2;
	}






	echo "\n********REMOÇÃO:********\n";

	function LimpaMaria(){

		require_once("mysql/conecta.inc.php");
		$pdo = conect();

		global $tanto;

		for($i=1;$i<=$tanto;$i++){

			$ColocaMysql=$pdo->prepare("
				DELETE FROM `coisas` WHERE chave = :chave");
			$ColocaMysql->bindvalue(":chave", $i, PDO::PARAM_INT);
			$ColocaMysql->execute();

			//SE ENCONTROU ALGUMA COISA
			if($ColocaMysql->rowCount() != 0);
				//echo "MariaDB limpo | ";
			else
				echo "\n---------->Deu ruim no mysql - Remoção\n\n";

		}

	}

	
	function LimpaRedis(){	

		global $tanto;

		require_once("redis/redis.class.php");

		$Redis = new RedisData();

		for($i=1;$i<=$tanto;$i++){
			$result = $Redis->DEL("teste:".$i, $i);
		}

	}


	$inicioLimpa1 = microtime(true);
		LimpaMaria();
	$totalLimpa1 = microtime(true) - $inicioLimpa1;
	echo "\nMariaDB: ".$totalLimpa1." | ";

	
	$inicioLimpa2 = microtime(true);
		LimpaRedis();
	$totalLimpa2 = microtime(true) - $inicioLimpa2;
	echo "Redis: ".$totalLimpa2;



	function ZeraMaria(){

		require_once("mysql/conecta.inc.php");
		$pdo = conect();

		$ColocaMysql=$pdo->prepare("TRUNCATE coisas; FLUSH TABLE coisas;");
		$ColocaMysql->execute();

		//SE ENCONTROU ALGUMA COISA
		if($ColocaMysql->rowCount() != 0);
			//echo "MariaDB limpo | ";
		else
			echo "\n---------->Deu ruim no mysql - Truncar tabela\n\n";

	}
	

	if($totalLimpa1 <= $totalLimpa2){
		echo "\n\nMariaDB win: ".($totalLimpa2 - $totalLimpa1)." mais rápido\n\n";
		$resultadoLimpa = $totalLimpa2 - $totalLimpa1;
	}
	else{
		echo "\n\nRedis win: ".($totalLimpa1 - $totalLimpa2)." mais rápido\n\n";
		$resultadoLimpa = $totalLimpa1 - $totalLimpa2;
	}









	
	require_once("mysql/conecta.inc.php");
	$pdo = conect();


	echo "\nSalvando...\n\n";

	/*INSERT*/
	$ColocaMysql=$pdo->prepare("
		INSERT INTO
		  	`resultado` 
		SET
		    `tipo` 			= :tipo,
		    `quant_insert` 	= :quant,
		    `rodada` 		= :rodada,
		    `time_redis` 	= :time_maria,
		    `time_maria` 	= :time_redis,
		    `resultado`		= :resultado,
		    `insert_on`		= :insert_on
		");
	$ColocaMysql->bindvalue(":tipo", "insert", PDO::PARAM_INT);
	$ColocaMysql->bindvalue(":quant", $tanto, PDO::PARAM_INT);
	$ColocaMysql->bindvalue(":rodada", $rodada, PDO::PARAM_INT);
	$ColocaMysql->bindvalue(":time_maria", $totalColoca1, PDO::PARAM_INT);
	$ColocaMysql->bindvalue(":time_redis", $totalColoca2, PDO::PARAM_INT);
	$ColocaMysql->bindvalue(":resultado", $resultadoColoca, PDO::PARAM_INT);
	$ColocaMysql->bindvalue(":insert_on", date("Y-m-d H:i:s"), PDO::PARAM_INT);
	$ColocaMysql->execute();

	//SE ENCONTROU ALGUMA COISA
	if($ColocaMysql->rowCount() != 0);
		//echo "***Resultado salvo\n\n";
	else
		echo "\nDeu ruim no mysql - resultado\n\n";


	$AtualizaMysql=$pdo->prepare("
		INSERT INTO
		  	`resultado` 
		SET
		    `tipo` 			= :tipo,
		    `quant_insert` 	= :quant,
		    `rodada` 		= :rodada,
		    `time_redis` 	= :time_maria,
		    `time_maria` 	= :time_redis,
		    `resultado`		= :resultado,
		    `insert_on`		= :insert_on
		");
	$AtualizaMysql->bindvalue(":tipo", "update", PDO::PARAM_INT);
	$AtualizaMysql->bindvalue(":quant", $tanto, PDO::PARAM_INT);
	$AtualizaMysql->bindvalue(":rodada", $rodada, PDO::PARAM_INT);
	$AtualizaMysql->bindvalue(":time_maria", $totalAtualiza1, PDO::PARAM_INT);
	$AtualizaMysql->bindvalue(":time_redis", $totalAtualiza2, PDO::PARAM_INT);
	$AtualizaMysql->bindvalue(":resultado", $resultadoAtualiza, PDO::PARAM_INT);
	$AtualizaMysql->bindvalue(":insert_on", date("Y-m-d H:i:s"), PDO::PARAM_INT);
	$AtualizaMysql->execute();

	//SE ENCONTROU ALGUMA COISA
	if($AtualizaMysql->rowCount() != 0);
		//echo "***Resultado salvo\n\n";
	else
		echo "\nDeu ruim no mysql - resultado\n\n";

	$RemoveMysql=$pdo->prepare("
		INSERT INTO
		  	`resultado` 
		SET
		    `tipo` 			= :tipo,
		    `quant_insert` 	= :quant,
		    `rodada` 		= :rodada,
		    `time_redis` 	= :time_maria,
		    `time_maria` 	= :time_redis,
		    `resultado`		= :resultado,
		    `insert_on`		= :insert_on
		");
	$RemoveMysql->bindvalue(":tipo", "delete", PDO::PARAM_INT);
	$RemoveMysql->bindvalue(":quant", $tanto, PDO::PARAM_INT);
	$RemoveMysql->bindvalue(":rodada", $rodada, PDO::PARAM_INT);
	$RemoveMysql->bindvalue(":time_maria", $totalLimpa1, PDO::PARAM_INT);
	$RemoveMysql->bindvalue(":time_redis", $totalLimpa2, PDO::PARAM_INT);
	$RemoveMysql->bindvalue(":resultado", $resultadoLimpa, PDO::PARAM_INT);
	$RemoveMysql->bindvalue(":insert_on", date("Y-m-d H:i:s"), PDO::PARAM_INT);
	$RemoveMysql->execute();

	//SE ENCONTROU ALGUMA COISA
	if($RemoveMysql->rowCount() != 0);
		//echo "***Resultado salvo\n\n";
	else
		echo "\nDeu ruim no mysql - resultado\n\n";

	/*

	TRUNCATE TABLE coisas; FLUSH TABLE coisas;


	SELECT
	  `tipo`,
	  `quant_insert`,
	  AVG(`time_redis`) AS redis,
	  AVG(`time_maria`) AS mariadb
	FROM
	  `resultado`
	WHERE
	  tipo = "update"
	GROUP BY
	  `tipo`,
	  `quant_insert`

	
	SELECT
	  `tipo`,
	  `quant_insert`,
	  AVG(`time_redis`) AS redis,
	  AVG(`time_maria`) AS mariadb
	FROM
	  `resultado`
	WHERE
	  tipo = "insert" AND `quant_insert` = "50"
	GROUP BY
	  `tipo`,
	  `quant_insert`


	*/