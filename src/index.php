<?php

require __DIR__ . '/config/db.php';

$stmt = $pdo->query('SELECT * FROM generos');
$generos = $stmt->fetchAll();

foreach ($generos as $genero) {
    echo $genero['genero'] . '<br>';
}
