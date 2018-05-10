<?php

	namespace Src;


	/**
	 * 
	 */
	class Relacional
	{

		private $Quant, $Rodada;
		private $timeInsert, $timeSelect, $timeUpdate, $timeDelete;

		function __construct($Quant, $Rodada)
		{
			$this->Quant 	= $Quant;
			$this->Rodada 	= $Rodada;
		}

		function setRelacional(){

			echo "Inserindo...";

			try{
				$pdo = new \PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}

			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$db=$pdo->prepare("
					INSERT INTO
					  `coisas`
					SET
					  `valor` = :valor");
				$db->bindvalue(":valor", $i, \PDO::PARAM_INT);
				$db->execute();

				//SE ENCONTROU ALGUMA COISA
				if($db->rowCount() != 0);
					//echo "Foi no mysql";
				else
					echo "\n---------->Um erro ocorreu: Inserção";

			}

			$this->timeInsert = microtime(true) - $time;

		}

		function getRelacional(){

			echo "\nPegando...\n";

			try{
				$pdo = new \PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$db=$pdo->prepare("
					SELECT
					  valor
					FROM
					  `coisas`
					WHERE
					  `chave` = :chave");
				$db->bindvalue(":chave", $i, \PDO::PARAM_INT);
				$db->execute();

				//SE ENCONTROU ALGUMA COISA
				if($db->rowCount() != 0){
					$db = $db->fetchAll(\PDO::FETCH_OBJ);
					
					foreach($db AS $line){
						if($line->valor <= 10)
							echo $line->valor." - ";
					}

				}
				else
					echo "\n---------->Um erro ocorreu: Select";

			}

			$this->timeSelect = microtime(true) - $time;

			echo "\n";

		}

		function updateRelacional(){

			echo "Atualizando...";

			try{
				$pdo = new \PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}

			$time = microtime(true);
			
			for($i=1;$i<=$this->Quant;$i++){

				$db=$pdo->prepare("
					UPDATE
					  `coisas`
					SET
					  `valor` = :valor
					WHERE
					  chave = :chave");
				$db->bindvalue(":chave", $i, \PDO::PARAM_INT);
				$db->bindvalue(":valor", $i+1, \PDO::PARAM_INT);
				$db->execute();

				//SE ENCONTROU ALGUMA COISA
				if($db->rowCount() != 0);
					//
				else
					echo "\n---------->Um erro ocorreu: Update";

			}

			$this->timeUpdate = microtime(true) - $time;

			echo "\n";

		}

		function delRelacional(){

			echo "Removendo...";

			try{
				$pdo = new \PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$db=$pdo->prepare("
					DELETE
					FROM
					  `coisas`
					WHERE
					  `chave` = :chave");
				$db->bindvalue(":chave", $i, \PDO::PARAM_INT);
				$db->execute();

				//SE ENCONTROU ALGUMA COISA
				if($db->rowCount() != 0);
					//
				else
					echo "\n---------->Um erro ocorreu: Delete";

			}

			$this->timeDelete = microtime(true) - $time;

			echo "\n";

		}

		function limpaRelacional(){

			echo "Limpando...";

			try{
				$pdo = new \PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			for($i=1;$i<=$this->Quant;$i++){

				$db=$pdo->prepare("TRUNCATE coisas");
				$db->execute();

				//SE ENCONTROU ALGUMA COISA
				if($db->rowCount() != 0)
					echo "Relacional zerado...";
				//else;
					//echo "\n---------->Deu ruim no mysql - LIMPA";

			}

			echo "\n";

		}

		function getTimeInsert(){
			return $this->timeInsert;
		}

		function getTimeSelect(){
			return $this->timeSelect;
		}

		function getTimeUpdate(){
			return $this->timeUpdate;
		}

		function getTimeDelete(){
			return $this->timeDelete;
		}

	}