<?php
require_once __DIR__ . '/../models/Tarefa.php';
require_once __DIR__ . '/../models/Projeto.php';
require_once __DIR__ . '/../models/Usuario.php';

class TarefaController {
    private $tarefaModel;
    private $projetoModel;
    private $usuarioModel;

    public function __construct() {
        $this->tarefaModel = new Tarefa();
        $this->projetoModel = new Projeto();
        $this->usuarioModel = new Usuario();
    }

    public function listar() {
        $filtros = [
            'status' => $_GET['status'] ?? '',
            'prioridade' => $_GET['prioridade'] ?? '',
            'projeto_id' => $_GET['projeto_id'] ?? '',
            'responsavel_id' => $_GET['responsavel_id'] ?? ''
        ];

        $tarefas = $this->tarefaModel->buscarComFiltros($filtros);
        $projetos = $this->projetoModel->listarAtivos();
        $usuarios = $this->usuarioModel->listarTodos();

        include __DIR__ . '/../views/tarefas/listar.php';
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'titulo' => $_POST['titulo'] ?? '',
                'descricao' => $_POST['descricao'] ?? '',
                'projeto_id' => $_POST['projeto_id'] ?? null,
                'responsavel_id' => $_POST['responsavel_id'] ?? null,
                'prioridade' => $_POST['prioridade'] ?? 'Media',
                'data_fim' => $_POST['data_fim'] ?? null
            ];

            $this->tarefaModel->criar($dados);
            header('Location: tarefas.php');
            exit;
        }

        $projetos = $this->projetoModel->listarAtivos();
        $usuarios = $this->usuarioModel->listarTodos();
        include __DIR__ . '/../views/tarefas/criar.php';
    }

    public function atualizarStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tarefa_id = $_POST['tarefa_id'];
            $novo_status = $_POST['novo_status'];
            if ($this->tarefaModel->atualizarStatus($tarefa_id, $novo_status)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
}