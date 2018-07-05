<?php 


	$Quantidade = $argv[1];
	$Rodada 	= $argv[2];
	$METODO 	= $argv[3];
	$DISK 		= $argv[4];
	$BANCO		= strtolower($argv[5]);

	require "vendor/autoload.php";

	echo "\n----------------------\n";
	echo "\nQuantidade: ".$Quantidade." Rodada: ".$Rodada;
	echo "\nBanco: ".$BANCO." | Disco: ".$DISK." | Metodo: ".$METODO;

	if($BANCO == "mariadb"){

		echo "\n\n*****Relacional:*****\n\n";

		$relacional = new Src\Relacional($Quantidade, $Rodada);

		$relacional->setRelacional();
		$relacional->getRelacional();
		$relacional->updateRelacional();
		$relacional->delRelacional();
		$relacional->limpaRelacional();

		echo "\n\n*****RESULTADO:*****\n";

		echo "\nTempo Insert: ".$relacional->getTimeInsert();
		echo "\nTempo Select: ".$relacional->getTimeSelect();
		echo "\nTempo Update: ".$relacional->getTimeUpdate();
		echo "\nTempo Delete: ".$relacional->getTimeDelete();

		$TimeInsert = $relacional->getTimeInsert();
		$TimeSelect = $relacional->getTimeSelect();
		$TimeUpdate = $relacional->getTimeUpdate();
		$TimeDelete = $relacional->getTimeDelete();

	}else if($BANCO == "redis"){

		echo "\n\n*****NoSQL:*****\n\n";

		$nosql 	= new Src\Nosql($Quantidade, $Rodada);

		$nosql->setNosql();
		$nosql->getNosql();
		$nosql->updateNosql();
		$nosql->delNosql();
		$nosql->limpaNosql();

		echo "\n\n*****RESULTADO:*****\n\n";

		echo "\nTempo Insert: ".$nosql->getTimeInsert();
		echo "\nTempo Select: ".$nosql->getTimeSelect();
		echo "\nTempo Update: ".$nosql->getTimeUpdate();
		echo "\nTempo Delete: ".$nosql->getTimeDelete();

		$TimeInsert = $nosql->getTimeInsert();
		$TimeSelect = $nosql->getTimeSelect();
		$TimeUpdate = $nosql->getTimeUpdate();
		$TimeDelete = $nosql->getTimeDelete();

	}else{
		echo "Banco ".$BANCO." não identificado...";
		exit;
	}


	echo "\n\n\nSalvando...\n";


	try{
		$pdo = new \PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}


	/*INSERT*/	
	$db=$pdo->prepare("
		INSERT INTO
		  `resultado`(
		    `banco`,
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time`,
		    `metodo`,
		    `disk`,
		    `insert_on`
		  )
		VALUES(
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?
		)");
	$db->bindvalue(1, $BANCO, \PDO::PARAM_INT);
	$db->bindvalue(2, "insert", \PDO::PARAM_INT);
	$db->bindvalue(3, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(4, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(5, $TimeInsert, \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
	$db->execute();

	//SE ENCONTROU ALGUMA COISA
	if($db->rowCount() != 0);
		//		
	else
		echo "\n---------->Um erro ocorreu: Salvar dados insert";


	/*SELECT*/
	$db=$pdo->prepare("
		INSERT INTO
		  `resultado`(
		    `banco`,
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time`,
		    `metodo`,
		    `disk`,
		    `insert_on`
		  )
		VALUES(
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?
		)");
	$db->bindvalue(1, $BANCO, \PDO::PARAM_INT);
	$db->bindvalue(2, "select", \PDO::PARAM_INT);
	$db->bindvalue(3, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(4, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(5, $TimeSelect, \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
	$db->execute();

	//SE ENCONTROU ALGUMA COISA
	if($db->rowCount() != 0);
		//		
	else
		echo "\n---------->Um erro ocorreu: Salvar dados select";


	/*UPDATE*/
	$db=$pdo->prepare("
		INSERT INTO
		  `resultado`(
		    `banco`,
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time`,
		    `metodo`,
		    `disk`,
		    `insert_on`
		  )
		VALUES(
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?
		)");
	$db->bindvalue(1, $BANCO, \PDO::PARAM_INT);
	$db->bindvalue(2, "update", \PDO::PARAM_INT);
	$db->bindvalue(3, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(4, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(5, $TimeUpdate, \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
	$db->execute();

	//SE ENCONTROU ALGUMA COISA
	if($db->rowCount() != 0);
		//		
	else
		echo "\n---------->Um erro ocorreu: Salvar dados update";


	/*DELETE*/	
	$db=$pdo->prepare("
		INSERT INTO
		  `resultado`(
		    `banco`,
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time`,
		    `metodo`,
		    `disk`,
		    `insert_on`
		  )
		VALUES(
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?,
		  ?
		)");
	$db->bindvalue(1, $BANCO, \PDO::PARAM_INT);
	$db->bindvalue(2, "delete", \PDO::PARAM_INT);
	$db->bindvalue(3, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(4, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(5, $TimeDelete, \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
	$db->execute();

	//SE ENCONTROU ALGUMA COISA
	if($db->rowCount() != 0);
		//		
	else
		echo "\n---------->Um erro ocorreu: Salvar dados delete";

	echo "Salvo.\n\n";


	/*

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