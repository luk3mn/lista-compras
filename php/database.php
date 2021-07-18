<?php
require('conexao.php');
session_start();

# ADICIONAR ELEMENTO
if (isset($_POST['adicionar'])) {
  $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
  $username = $_SESSION['username'];

  if ($item) {
    $stmt = $conexao->prepare("INSERT INTO itens_lista (user, item) VALUES (?, ?)");
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $item);
    $stmt->execute();
  } else {
    # grava uma sessão
    $_SESSION['error'] = "Campo não pode ficar vazio!";
  }
  header('location: ../home.php');
}

# Remover item do banco de dados
if (isset($_GET['del'])) {
  $id = $_GET['del'];

  $stmt = $conexao->prepare("DELETE FROM itens_lista WHERE id=?");
  $stmt->bindValue(1, $id);

  # executa a instrução
  $stmt->execute();
  header('location: ../home.php');
}

/* ========== INSTRUÇÔES DE LOGIN e CREATE ========== */
# CREATE ACCOUNT
if (isset($_POST['create'])) {
  $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
  $password2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);

  if (($username) && ($password) && ($password2)) {
    
    # testa se as senhas são igauis
    if ($password == $password2) {

      # Valida o usuario no banco de dados
      $stmt = $conexao->prepare("SELECT * FROM usuario WHERE user=?");
      $stmt->bindValue(1, $username);
      $stmt->execute();

      if ($stmt->rowCount() != 1) {
        # Instruções sql
        $stmt = $conexao->prepare("INSERT INTO usuario (user,pass) VALUES (?,?)");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, md5($password));
        
        # verifica se a execução foi bem sucedida
        if ($stmt->execute() > 0) {
          $_SESSION['create-ok'] = "Conta criada com sucesso!";
        } else {
          $_SESSION['create-err'] = "Ocorreu um erro! Tente novamente";
        }
      } else {
        $_SESSION['create-err'] = "Nome de usuário já existe!";
      }

    } else {
      $_SESSION['create-err'] = "As senha não coincidem";
    }

  } else {
    $_SESSION['create-err'] = "Preencha todos os campos!";
  }

  # redireciona para a tela de cadastro
  header('location: ../create.php');
}

# LOGIN ACCOUNT
if (isset($_POST['entrar'])) {
  $username = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
  $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

  if (($username) && ($password)) {
    # consulta sql
    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE user=? AND pass=?");
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, md5($password));
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
      $_SESSION['loginok'] = "Logado com sucesso";
      $_SESSION['username'] = $_POST['user'];
      header('location: ../home.php');
    } else {
      $_SESSION['loginerr'] = "Usuário e/ou senha inválidos";
      header('location: ../index.php');
    }
  } else {
    $_SESSION['loginerr'] = "Preencha todos os campos!";
    header('location: ../index.php');
  }
}