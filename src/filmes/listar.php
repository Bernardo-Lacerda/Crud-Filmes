<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';
require __DIR__ . '/../includes/header.php';

$stmt = $pdo->query('SELECT f.*, g.genero FROM filmes f JOIN generos g ON f.genero_id = g.id ORDER BY f.titulo');
$filmes = $stmt->fetchAll();

$plataformas = [
    'streaming' => 'Streaming',
    'cinema' => 'Cinema',
    'ambos' => 'Cinema + Streaming',
];

$mensagensErro = [
    'vazio' => 'Preencha todos os campos obrigatorios corretamente.',
];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Filmes</h1>
    <a href="/filmes/form.php" class="btn btn-primary">Novo Filme</a>
</div>

<?php if (isset($_GET['erro']) && isset($mensagensErro[$_GET['erro']])): ?>
<div class="alert alert-danger"><?= htmlspecialchars($mensagensErro[$_GET['erro']]) ?></div>
<?php endif; ?>

<table class="table table-striped bg-white">
    <thead>
        <tr>
            <th>Titulo</th>
            <th>Diretor</th>
            <th>Genero</th>
            <th>Duracao</th>
            <th>Ano</th>
            <th>Plataforma</th>
            <th>Acoes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($filmes as $filme): ?>
        <tr>
            <td><?= htmlspecialchars($filme['titulo']) ?></td>
            <td><?= htmlspecialchars($filme['diretor']) ?></td>
            <td><?= htmlspecialchars($filme['genero']) ?></td>
            <td><?= $filme['duracao_minutos'] ?> min</td>
            <td><?= $filme['ano_lancamento'] ?></td>
            <td><?= $plataformas[$filme['plataforma']] ?></td>
            <td>
                <a href="/filmes/form.php?id=<?= $filme['id'] ?>" class="btn btn-sm btn-secondary">Editar</a>
                <a href="/filmes/excluir.php?id=<?= $filme['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma a exclusao deste filme?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../includes/footer.php'; ?>
