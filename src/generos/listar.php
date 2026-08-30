<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/header.php';

$stmt = $pdo->query('SELECT * FROM generos ORDER BY genero');
$generos = $stmt->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Generos</h1>
    <a href="/generos/form.php" class="btn btn-primary">Novo Genero</a>
</div>

<?php if (isset($_GET['erro']) && $_GET['erro'] === 'uso'): ?>
<div class="alert alert-danger">Nao e possivel excluir este genero porque ha filmes cadastrados com ele.</div>
<?php endif; ?>

<table class="table table-striped bg-white">
    <thead>
        <tr>
            <th>ID</th>
            <th>Genero</th>
            <th>Acoes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($generos as $genero): ?>
        <tr>
            <td><?= $genero['id'] ?></td>
            <td><?= htmlspecialchars($genero['genero']) ?></td>
            <td>
                <a href="/generos/form.php?id=<?= $genero['id'] ?>" class="btn btn-sm btn-secondary">Editar</a>
                <a href="/generos/excluir.php?id=<?= $genero['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma a exclusao deste genero?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../includes/footer.php'; ?>
