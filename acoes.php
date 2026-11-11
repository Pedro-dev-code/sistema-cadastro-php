<?php
require 'config.php';
exigir_login();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }

$uid = $_SESSION['usuario_id'];
$id = (int) ($_POST['id'] ?? 0);

switch ($_POST['acao'] ?? '') {
    case 'criar':
        $titulo = trim($_POST['titulo'] ?? '');
        if ($titulo !== '') {
            $pdo->prepare('INSERT INTO tarefas (usuario_id, titulo) VALUES (?, ?)')->execute([$uid, $titulo]);
        }
        break;
    case 'alternar':
        $pdo->prepare('UPDATE tarefas SET concluida = 1 - concluida WHERE id = ? AND usuario_id = ?')->execute([$id, $uid]);
        break;
    case 'excluir':
        $pdo->prepare('DELETE FROM tarefas WHERE id = ? AND usuario_id = ?')->execute([$id, $uid]);
        break;
    case 'editar':
        $titulo = trim($_POST['titulo'] ?? '');
        if ($titulo !== '') {
            $pdo->prepare('UPDATE tarefas SET titulo = ? WHERE id = ? AND usuario_id = ?')->execute([$titulo, $id, $uid]);
        }
        break;
}
header('Location: index.php');
