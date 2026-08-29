<?php

$host = 'db';
$port = '3306';
$dbname = 'crud_filmes';
$user = 'crud_user';
$pass = 'crud_pass';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro na conexao com o banco: ' . $e->getMessage());
}
