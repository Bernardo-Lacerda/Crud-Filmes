<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';

$id = $_GET['id'] ?? '';

if ($id !== '') {
    try {
        $stmt = $pdo->prepare('DELETE FROM generos WHERE id = ?');
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        header('Location: /generos/listar.php?erro=uso');
        exit;
    }
}

header('Location: /generos/listar.php');
exit;
