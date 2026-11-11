<?php
require 'config.php';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($senha) < 6) {
        $erro = 'Preencha tudo corretamente (senha com no mínimo 6 caracteres).';
    } else {
        $existe = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $existe->execute([$email]);
        if ($existe->fetch()) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
            $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT)]);
            header('Location: login.php?cadastro=ok');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro</title><link rel="stylesheet" href="style.css"></head>
<body><main class="caixa">
  <h1>Criar conta</h1>
  <?php if ($erro): ?><p class="erro"><?= e($erro) ?></p><?php endif; ?>
  <form method="post">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button>Cadastrar</button>
  </form>
  <p>Já tem conta? <a href="login.php">Entrar</a></p>
</main></body>
</html>
