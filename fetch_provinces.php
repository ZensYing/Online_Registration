<?php
require_once 'db.php';
$stmt = $pdo->query('SELECT id, names FROM provinces');
$provinces = $stmt->fetchAll();
echo json_encode($provinces);
?>