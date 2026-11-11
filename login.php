<?php
require 'config.php';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
    $stmt->execute([trim($_POST['email'] ?? '')]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['senha'] ?? '', $user['senha'])) {
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nome'] = $user['nome'];
        header('Location: index.php');
        exit;
    }
    $erro = 'E-mail ou senha inválidos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title><link rel="stylesheet" href="style.css"></head>
<body><main class="caixa">
  <h1>Entrar</h1>
  <?php if (isset($_GET['cadastro'])): ?><p class="ok">Conta criada! Faça login.</p><?php endif; ?>
  <?php if ($erro): ?><p class="erro"><?= e($erro) ?></p><?php endif; ?>
  <form method="post">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button>Entrar</button>
  </form>
  <p>Não tem conta? <a href="register.php">Cadastre-se</a></p>
</main></body>
</html>
