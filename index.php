<?php
require 'config.php';
exigir_login();
$uid = $_SESSION['usuario_id'];

$filtro = $_GET['status'] ?? 'todas';
$sql = 'SELECT * FROM tarefas WHERE usuario_id = ?';
if ($filtro === 'pendentes') $sql .= ' AND concluida = 0';
if ($filtro === 'concluidas') $sql .= ' AND concluida = 1';
$stmt = $pdo->prepare($sql . ' ORDER BY id DESC');
$stmt->execute([$uid]);
$tarefas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Minhas tarefas</title><link rel="stylesheet" href="style.css"></head>
<body><main class="caixa">
  <p class="topo">Olá, <?= e($_SESSION['usuario_nome']) ?> · <a href="logout.php">Sair</a></p>
  <h1>Minhas tarefas</h1>

  <form method="post" action="acoes.php" class="linha">
    <input type="hidden" name="acao" value="criar">
    <input type="text" name="titulo" placeholder="Nova tarefa..." required>
    <button>Adicionar</button>
  </form>

  <p class="filtros">
    <a href="?status=todas">Todas</a> · <a href="?status=pendentes">Pendentes</a> · <a href="?status=concluidas">Concluídas</a>
  </p>

  <ul>
    <?php foreach ($tarefas as $t): ?>
      <li class="<?= $t['concluida'] ? 'feita' : '' ?>">
        <span><?= e($t['titulo']) ?></span>
        <form method="post" action="acoes.php" class="linha">
          <input type="hidden" name="id" value="<?= $t['id'] ?>">
          <button name="acao" value="alternar"><?= $t['concluida'] ? '↩️' : '✅' ?></button>
          <a href="editar.php?id=<?= $t['id'] ?>">✏️</a>
          <button name="acao" value="excluir" onclick="return confirm('Excluir esta tarefa?')">🗑️</button>
        </form>
      </li>
    <?php endforeach; ?>
    <?php if (!$tarefas): ?><li>Nenhuma tarefa por aqui.</li><?php endif; ?>
  </ul>
</main></body>
</html>
