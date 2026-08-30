<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';

$id = $_POST['id'] ?? '';
$titulo = trim($_POST['titulo'] ?? '');
$diretor = trim($_POST['diretor'] ?? '');
$genero_id = $_POST['genero_id'] ?? '';
$duracao_minutos = $_POST['duracao_minutos'] ?? '';
$ano_lancamento = $_POST['ano_lancamento'] ?? '';
$plataforma = $_POST['plataforma'] ?? '';

$camposValidos = $titulo !== '' && $diretor !== '' && $genero_id !== ''
    && $duracao_minutos !== '' && $ano_lancamento !== ''
    && in_array($plataforma, ['streaming', 'cinema', 'ambos'], true);

if ($camposValidos) {
    if ($id !== '') {
        $stmt = $pdo->prepare('UPDATE filmes SET titulo = ?, diretor = ?, genero_id = ?, duracao_minutos = ?, ano_lancamento = ?, plataforma = ? WHERE id = ?');
        $stmt->execute([$titulo, $diretor, $genero_id, $duracao_minutos, $ano_lancamento, $plataforma, $id]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO filmes (titulo, diretor, genero_id, duracao_minutos, ano_lancamento, plataforma) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$titulo, $diretor, $genero_id, $duracao_minutos, $ano_lancamento, $plataforma]);
    }
}

header('Location: /filmes/listar.php');
exit;
