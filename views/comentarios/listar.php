<?php
ob_start();
?>
<h2>Comentários</h2>
<?php foreach ($comentarios as $c): ?>
    <div class="card mb-2">
        <div class="card-body">
            <strong><?php echo htmlspecialchars($c['usuario_nome']); ?></strong>
            <p><?php echo nl2br(htmlspecialchars($c['comentario'])); ?></p>
            <small><?php echo $c['data_criacao']; ?></small>
        </div>
    </div>
<?php endforeach; ?>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/base.php';