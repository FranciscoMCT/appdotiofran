<?php
require_once __DIR__ . '/../config/database.php';

class Tarefa {
    private $db;
    private $table = 'Tarefas';

    public function __construct() {
        $this->db = new Database();
    }

    public function criar($dados) {
        $sql = "INSERT INTO {$this->table} (titulo, descricao, projeto_id, responsavel_id, prioridade, data_fim) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->query($sql, [
            $dados['titulo'], $dados['descricao'], $dados['projeto_id'], $dados['responsavel_id'], $dados['prioridade'], $dados['data_fim']
        ]);
        return $this->db->lastInsertId();
    }

    public function buscarComFiltros($filtros = []) {
        $sql = "SELECT t.*, p.nome as projeto_nome, u.nome as responsavel_nome FROM {$this->table} t LEFT JOIN Projetos p ON p.id = t.projeto_id LEFT JOIN Usuarios u ON u.id = t.responsavel_id WHERE 1=1";
        $params = [];
        if (!empty($filtros['status'])) { $sql .= " AND t.status = ?"; $params[] = $filtros['status']; }
        if (!empty($filtros['projeto_id'])) { $sql .= " AND t.projeto_id = ?"; $params[] = $filtros['projeto_id']; }
        $stmt = $this->db->query($sql, $params);
        return $stmt->fetchAll();
    }

    public function contarTodas() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->query($sql);
        $row = $stmt->fetch();
        return $row['total'] ?? 0;
    }

    public function atualizarStatus($id, $status) {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        $stmt = $this->db->query($sql, [$status, $id]);
        return true;
    }
}