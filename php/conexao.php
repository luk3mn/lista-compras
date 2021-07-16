<?php

$server = 'mysql:host=localhost;dbname=shoppingList';
$user = 'root';
$psw = '';

try {
  $conexao = new PDO($server,$user,$psw);

  $tbitens_lista = '
    CREATE TABLE itens_lista (
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      user VARCHAR(16) NOT NULL,
      item VARCHAR(64) NOT NULL
    )
  ';

  $tbusuarios = '
    CREATE TABLE usuario (
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      user VARCHAR(16) NOT NULL,
      pass VARCHAR(32) NOT NULL
    )
  ';

  $conexao->exec($tbitens_lista);
  $conexao->exec($tbusuarios);
} catch (PDOException $e) {
  echo "Código de erro: ".$e->getCode() . " ....... Mensagem: " . $e->getMessage();
}