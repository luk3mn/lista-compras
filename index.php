<?php 
  include('php/database.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- CSS -->
  <link rel="stylesheet" href="styles/main.css">
  <link rel="stylesheet" href="styles/modal.css">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Oleo+Script:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="header">
      
      <div class="title">
        <div class="message-return">
          <?php if (isset($_SESSION['loginerr'])) { ?>
            <div class="message-error">
              <?php 
                echo $_SESSION['loginerr']; // printa a mensagem
                unset($_SESSION['loginerr']); // encerra a seesão
              ?>
            </div>
          <?php } ?>
        </div>
        <h2>Login</h2>
      </div>
    </div>
  </header>
  <main>
    <div class="container">
      <div class="content">
        <section class="form-input">
          <form action="php/database.php" method="POST">
            <label class="sr-only" for="user">Usuário</label>
            <input type="text" name="user" id="user" placeholder="Usuário">
            <label class="sr-only" for="pass">Senha</label>
            <input type="password" name="pass" id="pass" placeholder="Senha">
            <button name="entrar">Entrar</button>
          </form>
        </section>
        
        <section class="separator">
          <div></div>
          <div>ou</div>
          <div></div>
        </section>
  
        <section class="create">
          <a href="create.php">
            <button>CRIAR CONTA</button>
          </a>
        </section>
      </div>
    </div>
  </main>
</body>
</html>