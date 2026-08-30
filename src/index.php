<?php

require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/header.php';
?>

<h1 class="h3 mb-3">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></h1>
<p>Use o menu acima para gerenciar filmes e generos.</p>

<?php require __DIR__ . '/includes/footer.php'; ?>
