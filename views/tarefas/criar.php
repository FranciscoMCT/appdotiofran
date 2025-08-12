<?php
ob_start();
?>
<h1>Criar Tarefa</h1>
<form method="post" action="tarefas_criar.php">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Projeto</label>
        <select name="projeto_id" class="form-select">
            <?php foreach ($projetos as $p): ?>
                <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nome']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button class="btn btn-success">Criar</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/base.php';