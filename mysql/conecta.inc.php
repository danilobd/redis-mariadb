<?php


function conect(){

  try{
    $pdo=new PDO("mysql:host=localhost;dbname=comparacao;","php","123456");
  }
  catch(PDOException $e){

    echo $e->getMessage();

  }

  return $pdo;

}


?>