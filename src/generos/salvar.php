<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';

$id = $_POST['id'] ?? '';
$genero = trim($_POST['genero'] ?? '');

if ($genero === '') {
    header('Location: /generos/listar.php?erro=vazio');
    exit;
}

try {
    if ($id !== '') {
        $stmt = $pdo->prepare('UPDATE generos SET genero = ? WHERE id = ?');
        $stmt->execute([$genero, $id]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO generos (genero) VALUES (?)');
        $stmt->execute([$genero]);
    }
} catch (PDOException $e) {
    header('Location: /generos/listar.php?erro=duplicado');
    exit;
}

header('Location: /generos/listar.php');
exit;
