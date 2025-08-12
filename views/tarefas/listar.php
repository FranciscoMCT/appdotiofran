<?php
// views/tarefas/listar.php
ob_start();
?>
<h1>Tarefas</h1>
<a class="btn btn-primary mb-3" href="tarefas_criar.php">Nova Tarefa</a>
<table class="table table-striped">
    <thead>
        <tr><th>Título</th><th>Projeto</th><th>Responsável</th><th>Status</th></tr>
    </thead>
    <tbody>
    <?php foreach ($tarefas as $t): ?>
        <tr>
            <td><?php echo htmlspecialchars($t['titulo']); ?></td>
            <td><?php echo htmlspecialchars($t['projeto_nome'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($t['responsavel_nome'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($t['status'] ?? ''); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/base.php';