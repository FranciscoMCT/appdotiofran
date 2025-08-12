<?php
// config/database.php
class Database {
    private $connection;

    public function __construct() {
        $server = getenv('DB_SERVER') ?: 'seu-servidor.database.windows.net';
        $database = getenv('DB_DATABASE') ?: 'db-gestao-projetos';
        $username = getenv('DB_USERNAME') ?: 'sqladmin';
        $password = getenv('DB_PASSWORD') ?: 'SuaSenhaSegura123!';

        // Usando PDO com sqlsrv (requer pdo_sqlsrv instalado)
        $dsn = "sqlsrv:Server=$server;Database=$database";

        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            error_log('DB Connection error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchOne($stmt) {
        return $stmt->fetch();
    }

    public function fetchAll($stmt) {
        return $stmt->fetchAll();
    }

    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
}
