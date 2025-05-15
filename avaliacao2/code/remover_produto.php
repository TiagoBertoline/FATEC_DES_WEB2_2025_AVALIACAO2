<?php
require_once 'classes/login.php';
require_once 'classes/DB.php';

$db = new bd();
$validador = new Login();
$validador->verificar_logado();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db->removerVaga($_POST['id']);
    header("Location: home.php");
    exit();
}

$produtos = $db->getAllProducts();

if (empty($produtos)) {
    echo "<div class='container mt-5'>";
    echo "<div class='alert alert-warning'>Nenhum produto cadastrado.</div>";
    echo "<a href='home.php' class='btn btn-primary'>Voltar</a>";
    echo "</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Remover Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Remover Produto</h2>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= htmlspecialchars($produto['nome_produto']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($produto['descricao']) ?></td>
                    <td><?= htmlspecialchars($produto['categoria']) ?></td>
                    <td>
                        <form method="post" action="" onsubmit="return confirm('Tem certeza que deseja remover este produto?');">
                            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="home.php"  class="btn btn-danger">Voltar</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
