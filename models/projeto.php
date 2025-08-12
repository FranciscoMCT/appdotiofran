<?php
require_once __DIR__ . '/../config/database.php';

class Projeto {
    private $db;
    private $table = 'Projetos';

    public function __construct() {
        $this->db = new Database();
    }

    public function listarAtivos() {
        $sql = "SELECT * FROM {$this->table} WHERE status = 'Ativo' ORDER BY nome";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->query($sql, [$id]);
        return $stmt->fetch();
    }

    public function buscarRecentes($limit = 5) {
        $sql = "SELECT TOP (?) * FROM {$this->table} ORDER BY data_criacao DESC";
        // NOTE: TOP with parameter isn't supported on all drivers; simplified:
        $sql = "SELECT * FROM {$this->table} ORDER BY data_criacao DESC";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll();
        return array_slice($rows, 0, $limit);
    }
}