<?php
require 'config.php';
exigir_login();

$stmt = $pdo->prepare('SELECT * FROM tarefas WHERE id = ? AND usuario_id = ?');
$stmt->execute([(int) ($_GET['id'] ?? 0), $_SESSION['usuario_id']]);
$tarefa = $stmt->fetch();
if (!$tarefa) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar tarefa</title><link rel="stylesheet" href="style.css"></head>
<body><main class="caixa">
  <h1>Editar tarefa</h1>
  <form method="post" action="acoes.php">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
    <input type="text" name="titulo" value="<?= e($tarefa['titulo']) ?>" required>
    <button>Salvar</button>
  </form>
  <p><a href="index.php">Cancelar</a></p>
</main></body>
</html>
