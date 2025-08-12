<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;
    private $table = 'Usuarios';

    public function __construct() {
        $this->db = new Database();
    }

    public function criar($dados) {
        $sql = "INSERT INTO {$this->table} (nome, email, senha, cargo) VALUES (?, ?, ?, ?)";
        $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $stmt = $this->db->query($sql, [
            $dados['nome'], $dados['email'], $senhaHash, $dados['cargo']
        ]);
        return $this->db->lastInsertId();
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = ? AND ativo = 1";
        $stmt = $this->db->query($sql, [$email]);
        return $stmt->fetch();
    }

    public function listarTodos() {
        $sql = "SELECT id, nome, email, cargo, data_criacao FROM {$this->table} WHERE ativo = 1 ORDER BY nome";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}