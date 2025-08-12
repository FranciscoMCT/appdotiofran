<?php
require_once __DIR__ . '/../config/database.php';

class Comentario {
    private $db;
    private $table = 'Comentarios';

    public function __construct() {
        $this->db = new Database();
    }

    public function criar($dados) {
        $sql = "INSERT INTO {$this->table} (tarefa_id, usuario_id, comentario) VALUES (?, ?, ?)";
        $this->db->query($sql, [$dados['tarefa_id'], $dados['usuario_id'], $dados['comentario']]);
        return $this->db->lastInsertId();
    }

    public function buscarPorTarefa($tarefa_id) {
        $sql = "SELECT c.*, u.nome as usuario_nome FROM {$this->table} c LEFT JOIN Usuarios u ON u.id = c.usuario_id WHERE c.tarefa_id = ? ORDER BY c.data_criacao ASC";
        $stmt = $this->db->query($sql, [$tarefa_id]);
        return $stmt->fetchAll();
    }
}
