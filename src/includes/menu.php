<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/index.php">CRUD Filmes</a>
        <div class="navbar-nav">
            <a class="nav-link" href="/filmes/listar.php">Filmes</a>
            <a class="nav-link" href="/generos/listar.php">Generos</a>
            <a class="nav-link" href="/logout.php">Sair (<?= htmlspecialchars($_SESSION['usuario_nome'] ?? '') ?>)</a>
        </div>
    </div>
</nav>
