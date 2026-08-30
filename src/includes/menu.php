<?php

$rota = $_SERVER['REQUEST_URI'] ?? '';
$ativoFilmes = str_starts_with($rota, '/filmes') ? 'active' : '';
$ativoGeneros = str_starts_with($rota, '/generos') ? 'active' : '';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/index.php">CRUD Filmes</a>
        <div class="navbar-nav">
            <a class="nav-link <?= $ativoFilmes ?>" href="/filmes/listar.php">Filmes</a>
            <a class="nav-link <?= $ativoGeneros ?>" href="/generos/listar.php">Generos</a>
            <a class="nav-link" href="/logout.php">Sair (<?= htmlspecialchars($_SESSION['usuario_nome'] ?? '') ?>)</a>
        </div>
    </div>
</nav>
