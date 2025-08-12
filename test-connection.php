<?php
require_once __DIR__ . '/config/database.php';
try {
    $db = new Database();
    $stmt = $db->query('SELECT COUNT(*) as total_usuarios FROM Usuarios');
    $row = $stmt->fetch();
    echo json_encode(['status' => 'success', 'total_usuarios' => $row['total_usuarios'] ?? 0]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
