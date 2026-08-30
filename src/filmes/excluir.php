<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? '';

if ($id !== '') {
    $stmt = $pdo->prepare('DELETE FROM filmes WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: /filmes/listar.php?sucesso=excluido');
exit;
