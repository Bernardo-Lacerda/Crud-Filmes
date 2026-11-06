<?php

require __DIR__ . '/includes/auth.php';

$pasta = __DIR__ . '/uploads/';
$tipos = ['image/jpeg' => 'jpg', 'image/png' => 'png'];
$erro = '';
$sucesso = '';

if (!is_dir($pasta)) {
    mkdir($pasta, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arquivo = $_FILES['imagem'];

    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        $erro = 'Erro no envio do arquivo.';
    } elseif ($arquivo['size'] > 2 * 1024 * 1024) {
        $erro = 'A imagem deve ter no maximo 2 MB.';
    } elseif (!isset($tipos[mime_content_type($arquivo['tmp_name'])])) {
        $erro = 'Envie apenas imagens JPG ou PNG.';
    } else {
        $nome = uniqid() . '.' . $tipos[mime_content_type($arquivo['tmp_name'])];
        move_uploaded_file($arquivo['tmp_name'], $pasta . $nome);
        $sucesso = 'Imagem enviada com sucesso.';
    }
}

$imagens = array_diff(scandir($pasta), ['.', '..']);

require __DIR__ . '/includes/header.php';
?>

<h1 class="h3 mb-3">Upload de Imagens</h1>

<?php if ($erro): ?>
<div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<?php if ($sucesso): ?>
<div class="alert alert-success"><?= $sucesso ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="d-flex gap-2 mb-4">
    <input type="file" name="imagem" class="form-control" accept="image/jpeg,image/png" required>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<h2 class="h5">Imagens salvas</h2>

<?php if (count($imagens) === 0): ?>
<p class="text-muted">Nenhuma imagem enviada ainda.</p>
<?php else: ?>
<div class="d-flex flex-wrap gap-3">
    <?php foreach ($imagens as $imagem): ?>
    <img src="/uploads/<?= htmlspecialchars($imagem) ?>" alt="Imagem enviada" class="rounded" style="width: 180px; height: 180px; object-fit: cover;">
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
