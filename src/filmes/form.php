<?php

require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../config/db.php';

$filme = [
    'id' => '',
    'titulo' => '',
    'diretor' => '',
    'genero_id' => '',
    'duracao_minutos' => '',
    'ano_lancamento' => '',
    'plataforma' => '',
];

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM filmes WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $filme = $stmt->fetch();
}

$generos = $pdo->query('SELECT * FROM generos ORDER BY genero')->fetchAll();

require __DIR__ . '/../includes/header.php';
?>

<h1 class="h3 mb-3"><?= $filme['id'] ? 'Editar Filme' : 'Novo Filme' ?></h1>

<?php if (count($generos) === 0): ?>
<div class="alert alert-warning">
    Nenhum genero cadastrado ainda. <a href="/generos/form.php">Cadastre um genero</a> antes de cadastrar um filme.
</div>
<?php else: ?>

<form method="post" action="/filmes/salvar.php">
    <input type="hidden" name="id" value="<?= htmlspecialchars($filme['id']) ?>">

    <div class="mb-3">
        <label for="titulo" class="form-label">Titulo</label>
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="diretor" class="form-label">Diretor</label>
        <input type="text" class="form-control" id="diretor" name="diretor" value="<?= htmlspecialchars($filme['diretor']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="genero_id" class="form-label">Genero</label>
        <select class="form-select" id="genero_id" name="genero_id" required>
            <option value="">Selecione</option>
            <?php foreach ($generos as $genero): ?>
            <option value="<?= $genero['id'] ?>" <?= $filme['genero_id'] == $genero['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($genero['genero']) ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="duracao_minutos" class="form-label">Duracao (minutos)</label>
            <input type="number" class="form-control" id="duracao_minutos" name="duracao_minutos" min="1" value="<?= htmlspecialchars($filme['duracao_minutos']) ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="ano_lancamento" class="form-label">Ano de lancamento</label>
            <input type="number" class="form-control" id="ano_lancamento" name="ano_lancamento" min="1888" max="2100" value="<?= htmlspecialchars($filme['ano_lancamento']) ?>" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Plataforma de exibicao</label>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="plataforma" id="plataforma_streaming" value="streaming" <?= $filme['plataforma'] === 'streaming' ? 'checked' : '' ?> required>
            <label class="form-check-label" for="plataforma_streaming">Streaming</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="plataforma" id="plataforma_cinema" value="cinema" <?= $filme['plataforma'] === 'cinema' ? 'checked' : '' ?>>
            <label class="form-check-label" for="plataforma_cinema">Cinema</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="plataforma" id="plataforma_ambos" value="ambos" <?= $filme['plataforma'] === 'ambos' ? 'checked' : '' ?>>
            <label class="form-check-label" for="plataforma_ambos">Cinema + Streaming</label>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/filmes/listar.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php endif; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>
