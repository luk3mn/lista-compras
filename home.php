<?php 
  require('php/database.php');

  # LENDO OS ITENS
  $stmt = $conexao->prepare("SELECT * FROM itens_lista");
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $results = $stmt->fetchAll();
  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Compras</title>
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
      <div class="menu">
        <img src="assets/menu.svg" alt="menu" id="open">
      </div>
      <div class="title">
        <h2>Lista de compras</h2>
      </div>
    </div>
  </header>
  <main>
    <div class="container">
      <section class="msg-return">
        
        <?php if (isset($_SESSION['error'])) { ?>
          <div class="msg-error">
            <?php
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            ?>
            <div class="okay">
              <a href="home.php">OK</a>
            </div>
          </div>
        <?php } ?>
        
      </section>
      <section class="content">
        <div class="input">
          <form action="php/database.php" method="POST">
            <label class="sr-only" for="add-item">Informar item</label>
            <input type="text" id="id-item" name="item" placeholder="Informar item">
            <button name="adicionar">Adicionar</button>
          </form>
        </div>
        <div class="box-list">
          <ul>
            <?php if ($stmt->rowCount() > 0) { ?><!-- Testa se foi encontrado algum registro -->
              <?php foreach ($results as $result) { ?> <!-- Percorre os registros do banco de dados -->
                <li>
                  <a href="php/batabase.php?del=<?php echo $result['id']; ?>">X</a><input type="checkbox"><span><?php echo $result['item']; ?></span>
                </li>
              <?php } ?>
            <?php } ?>
          </ul>
        </div>
      </section>
    </div>
  </main>

  <!-- MODAL -->
  <div class="box-modal">
    <div class="modal">
      <div class="modal-header"><div class="close"></div></div>
      <div class="modal-content">
        <ul>
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </div>
  <script src="scripts/modal.js"></script>
</body>
</html>