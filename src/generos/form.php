<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';

$genero = ['id' => '', 'genero' => ''];

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM generos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $genero = $stmt->fetch();
}

require __DIR__ . '/../includes/header.php';
?>

<h1 class="h3 mb-3"><?= $genero['id'] ? 'Editar Genero' : 'Novo Genero' ?></h1>

<form method="post" action="/generos/salvar.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($genero['id']) ?>">

    <div class="mb-3">
        <label for="genero" class="form-label">Genero</label>
        <input type="text" class="form-control" id="genero" name="genero" value="<?= htmlspecialchars($genero['genero']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/generos/listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require __DIR__ . '/../includes/footer.php'; ?>
