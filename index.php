<?php 


	$Quantidade = $argv[1];
	$Rodada 	= $argv[2];
	$METODO 	= $argv[3];
	$DISK 		= $argv[4];

	require "vendor/autoload.php";


	echo "\nQuantidade: ".$Quantidade." Rodada: ".$Rodada."\n\n\n";


	echo "*****Relacional:*****\n\n";

	$relacional = new Src\Relacional($Quantidade, $Rodada);

	$relacional->setRelacional();
	$relacional->getRelacional();
	$relacional->updateRelacional();
	$relacional->delRelacional();
	$relacional->limpaRelacional();


	echo "\nTempo Insert: ".$relacional->getTimeInsert();
	echo "\nTempo Select: ".$relacional->getTimeSelect();
	echo "\nTempo Update: ".$relacional->getTimeUpdate();
	echo "\nTempo Delete: ".$relacional->getTimeDelete();
	

	
	echo "\n\n\n\n*****NoSQL:*****\n\n";

	$nosql 	= new Src\Nosql($Quantidade, $Rodada);

	$nosql->setNosql();
	$nosql->getNosql();
	$nosql->updateNosql();
	$nosql->delNosql();
	$nosql->limpaNosql();

	echo "\nTempo Insert: ".$nosql->getTimeInsert();
	echo "\nTempo Select: ".$nosql->getTimeSelect();
	echo "\nTempo Update: ".$nosql->getTimeUpdate();
	echo "\nTempo Delete: ".$nosql->getTimeDelete();


	echo "\n\n\n\n*****RESULTADO:*****\n\n";


	echo "\nInsert: ";

	if($relacional->getTimeInsert() > $nosql->getTimeInsert()){
		echo "NoSql ganhou";
		$resultadoInsert = $relacional->getTimeInsert() - $nosql->getTimeInsert();
	}else{
		echo "Relacional ganhou";
		$resultadoInsert = $nosql->getTimeInsert() - $relacional->getTimeInsert();
	}

	echo "\nSelect: ";

	if($relacional->getTimeSelect() > $nosql->getTimeSelect()){
		echo "NoSql ganhou";
		$resultadoSelect = $relacional->getTimeSelect() - $nosql->getTimeSelect();
	}else{
		echo "Relacional ganhou";
		$resultadoSelect = $nosql->getTimeSelect() - $relacional->getTimeSelect();
	}

	echo "\nUpdate: ";

	if($relacional->getTimeUpdate() > $nosql->getTimeUpdate()){
		echo "NoSql ganhou";
		$resultadoUpdate = $relacional->getTimeUpdate() - $nosql->getTimeUpdate();
	}else{
		echo "Relacional ganhou";
		$resultadoUpdate = $nosql->getTimeUpdate() - $relacional->getTimeUpdate();
	}

	echo "\nDelete: ";

	if($relacional->getTimeDelete() > $nosql->getTimeDelete()){
		echo "NoSql ganhou";
		$resultadoDelete = $relacional->getTimeDelete() - $nosql->getTimeDelete();
	}else{
		echo "Relacional ganhou";
		$resultadoDelete = $nosql->getTimeDelete() - $relacional->getTimeDelete();
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
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time_redis`,
		    `time_maria`,
		    `metodo`,
		    `disk`,
		    `resultado`,
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
		  ?,
		  ?
		)");
	$db->bindvalue(1, "insert", \PDO::PARAM_INT);
	$db->bindvalue(2, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(3, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(4, $nosql->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(5, $relacional->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, $resultadoInsert, \PDO::PARAM_INT);
	$db->bindvalue(9, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
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
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time_redis`,
		    `time_maria`,
		    `metodo`,
		    `disk`,
		    `resultado`,
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
		  ?,
		  ?
		)");
	$db->bindvalue(1, "select", \PDO::PARAM_INT);
	$db->bindvalue(2, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(3, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(4, $nosql->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(5, $relacional->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, $resultadoInsert, \PDO::PARAM_INT);
	$db->bindvalue(9, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
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
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time_redis`,
		    `time_maria`,
		    `metodo`,
		    `disk`,
		    `resultado`,
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
		  ?,
		  ?
		)");
	$db->bindvalue(1, "update", \PDO::PARAM_INT);
	$db->bindvalue(2, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(3, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(4, $nosql->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(5, $relacional->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, $resultadoInsert, \PDO::PARAM_INT);
	$db->bindvalue(9, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
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
		    `tipo`,
		    `quant_insert`,
		    `rodada`,
		    `time_redis`,
		    `time_maria`,
		    `metodo`,
		    `disk`,
		    `resultado`,
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
		  ?,
		  ?
		)");
	$db->bindvalue(1, "delete", \PDO::PARAM_INT);
	$db->bindvalue(2, $Quantidade, \PDO::PARAM_INT);
	$db->bindvalue(3, $Rodada, \PDO::PARAM_INT);
	$db->bindvalue(4, $nosql->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(5, $relacional->getTimeInsert(), \PDO::PARAM_INT);
	$db->bindvalue(6, $METODO, \PDO::PARAM_INT);
	$db->bindvalue(7, $DISK, \PDO::PARAM_INT);
	$db->bindvalue(8, $resultadoInsert, \PDO::PARAM_INT);
	$db->bindvalue(9, date("Y-m-d H:i:s"), \PDO::PARAM_INT);
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