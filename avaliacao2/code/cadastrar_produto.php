<?php
require_once 'classes/login.php';
require_once 'classes/DB.php';

$db = new bd();
$validador = new Login();
$validador->verificar_logado();

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db->cadastrarProduto($_POST['nome'], $_POST['preco'], $_POST['descricao'], $_POST['categoria']);
    $mensagem = "Produto cadastrado com sucesso!";
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Produto</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 60px;
      max-width: 600px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4">Cadastrar Novo Produto</h2>

    <?php if (!empty($mensagem)): ?>
      <div class="alert alert-success">
        <?= htmlspecialchars($mensagem) ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label for="nome">Nome do Produto</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
      </div>

      <div class="form-group">
        <label for="preco">Preço (R$)</label>
        <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
      </div>

      <div class="form-group">
        <label for="descricao">Descrição</label>
        <input type="text" class="form-control" id="descricao" name="descricao" required>
      </div>

      <div class="form-group">
        <label for="categoria">Categoria</label>
        <input type="text" class="form-control" id="categoria" name="categoria" required>
      </div>

      <button type="submit"class="btn btn-primary">Cadastrar Produto</button>
      <a href="home.php" class="btn btn-danger ml-2">← Voltar</a>
    </form>
  </div>
</body>
</html>
