<?php
require_once 'classes/login.php';
require_once 'classes/DB.php';

// Instancia o banco de dados e busca todos os produtos
$db = new bd();
$produtos = $db->getAllProducts();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Produtos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
    }
    .button-group {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4">Produtos Cadastrados</h2>

    <table class="table table-striped table-bordered">
      <thead class="bg-info text-white">
        <tr>
          <th>ID</th>
          <th>Nome do Produto</th>
          <th>Preço</th>
          <th>Descrição</th>
          <th>Categoria</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($produtos as $p): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome_produto']) ?></td>
            <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['descricao']) ?></td>
            <td><?= htmlspecialchars($p['categoria']) ?></td>
         
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="button-group">
      <a href="home.php"class="btn btn-danger">← Voltar</a>
    </div>
  </div>
</body>
</html>
