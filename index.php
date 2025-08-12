<?php
session_start();
require_once __DIR__ . '/models/Projeto.php';
require_once __DIR__ . '/models/Tarefa.php';

$projetoModel = new Projeto();
tarefaModel = new Tarefa();

$pageTitle = 'Dashboard';
ob_start();
?>
<h1>Dashboard</h1>
<p>Bem-vindo ao sistema de gestão de projetos.</p>
<?php
$content = ob_get_clean();
include __DIR__ . '/views/layouts/base.php';
?>

