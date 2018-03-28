<?php

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

/*header('Content-Type: text/html; charset=utf-8');
require 'vendor/autoload.php';*/

/**
* 	REDIS
*/
class RedisData{

	function SET($key, $value){//INSERE VALOR

		//require_once("conecta.php");
		require_once("vendor/predis/predis/autoload.php");
		Predis\Autoloader::register();

		try {
			$redis = new Predis\Client();
		}
		catch (Exception $e) {
			die($e->getMessage());
		}
		
		$make = $redis->pipeline()->SET($key, $value)->execute();

		if($make[0] == "OK")
			return "true";
		else
			return "false";

	}

	function GET($key){ //PEGA VALOR
			
		//require_once("conecta.php");
		require_once("vendor/predis/predis/autoload.php");
		Predis\Autoloader::register();

		try {
			$redis = new Predis\Client();
		}
		catch (Exception $e) {
			die($e->getMessage());
		}

		$make = $redis->pipeline()->GET($key)->execute();

		if( !empty($make[0]) )
			return $make[0];
		else
			return "false";

	}

	function DEL($key){ //REMOVE

		//require_once("conecta.php");
		require_once("vendor/predis/predis/autoload.php");
		Predis\Autoloader::register();

		try {
			$redis = new Predis\Client();
		}
		catch (Exception $e) {
			die($e->getMessage());
		}

		$make = $redis->pipeline()->DEL($key)->execute();

		if(!empty($make[0]))
			return "true";
		else
			return "false";

	}

	function INCR($key){ //IMPREMENTA O VALOR

		//require_once("conecta.php");
		require_once("vendor/predis/predis/autoload.php");
		Predis\Autoloader::register();

		try {
			$redis = new Predis\Client();
		}
		catch (Exception $e) {
			die($e->getMessage());
		}

		$make = $redis->pipeline()->INCR($key)->execute();

		if(!empty($make[0]))
			return "true";
		else
			return "false";

	}

	function ViewAll($key){ //LISTA TODAS AS CHAVES

		//require_once("conecta.php");
		require_once("vendor/predis/predis/autoload.php");
		Predis\Autoloader::register();

		$make = $redis->pipeline()->KEYS($key)->execute();

		$make = call_user_func_array('array_merge', $make);

		return $make;
		
	}

	function flushall(){

		//require_once("conecta.php");
		require_once("vendor/predis/predis/autoload.php");
		Predis\Autoloader::register();

		try {
			$redis = new Predis\Client();
		}
		catch (Exception $e) {
			die($e->getMessage());
		}

		$make = $redis->pipeline()->flushall()->execute();

		//$make = call_user_func_array('array_merge', $make);

		return $make;

	}
	
}

//$Redis = new RedisData();
//echo $Redis->SET("teste", "123");
//echo $Redis->GET("teste");
//echo $Redis->DEL("teste");
//echo $Redis->INCR("teste");
//echo "<pre>";
//print_r( $Redis->ViewAll("*") );

/*
FLUSHDB       - Removes data from your connection's CURRENT database.
FLUSHALL      - Removes data from ALL databases.
*/