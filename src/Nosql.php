<?php

	namespace Src;


	/**
	 * 
	 */
	class Nosql
	{
		
		private $Quant, $Rodada;
		private $timeInsert, $timeSelect, $timeUpdate, $timeDelete;

		function __construct($Quant, $Rodada)
		{
			$this->Quant 	= $Quant;
			$this->Rodada 	= $Rodada;
		}

		function setNosql(){

			echo "Inserindo...";

			$predis = new \Predis\Client();

			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$predis->set('comparacao:'.$i, $i);

			}

			$this->timeInsert = microtime(true) - $time;

		}

		function getNosql(){

			echo "\nPegando...\n";

			$predis = new \Predis\Client();

			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				if($i <= 10){
					$v = $predis->get('comparacao:'.$i)." - ";
					echo $v;
				}else{
					$v = $predis->get('comparacao:'.$i)." - ";
					//echo $v;
				}

			}

			$this->timeSelect = microtime(true) - $time;


		}

		function updateNosql(){

			echo "\nAtualizando...\n";

			$predis = new \Predis\Client();

			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$predis->set('comparacao:'.$i, $i+1);

			}

			$this->timeUpdate = microtime(true) - $time;

		}

		function delNosql(){

			echo "Removendo...\n";

			$predis = new \Predis\Client();

			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$predis->del('comparacao:'.$i);

			}

			$this->timeDelete = microtime(true) - $time;

		}

		function limpaNosql(){

			echo "Limpando...\n";

			$predis = new \Predis\Client();

			$time = microtime(true);

			for($i=1;$i<=$this->Quant;$i++){

				$predis->FLUSHALL();

			}

			$this->timeDelete = microtime(true) - $time;

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