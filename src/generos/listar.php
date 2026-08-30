<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/header.php';

$stmt = $pdo->query('SELECT * FROM generos ORDER BY genero');
$generos = $stmt->fetchAll();

$mensagensErro = [
    'uso' => 'Nao e possivel excluir este genero porque ha filmes cadastrados com ele.',
    'vazio' => 'O campo genero e obrigatorio.',
    'duplicado' => 'Ja existe um genero com esse nome.',
];

$mensagensSucesso = [
    'salvo' => 'Genero salvo com sucesso.',
    'excluido' => 'Genero excluido com sucesso.',
];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Generos</h1>
    <a href="/generos/form.php" class="btn btn-primary">Novo Genero</a>
</div>

<?php if (isset($_GET['erro']) && isset($mensagensErro[$_GET['erro']])): ?>
<div class="alert alert-danger"><?= htmlspecialchars($mensagensErro[$_GET['erro']]) ?></div>
<?php endif; ?>

<?php if (isset($_GET['sucesso']) && isset($mensagensSucesso[$_GET['sucesso']])): ?>
<div class="alert alert-success"><?= htmlspecialchars($mensagensSucesso[$_GET['sucesso']]) ?></div>
<?php endif; ?>

<?php if (count($generos) === 0): ?>
<p class="text-muted">Nenhum genero cadastrado ainda.</p>
<?php else: ?>
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
<?php endif; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>
