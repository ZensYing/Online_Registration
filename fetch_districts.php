<?php
require_once 'db.php';

if (isset($_GET['province_id'])) {
  $province_id = $_GET['province_id'];
  $stmt = $pdo->prepare('SELECT id, names FROM districts WHERE province_id = :province_id');
  $stmt->execute(['province_id' => $province_id]);
  $districts = $stmt->fetchAll();
  echo json_encode($districts);
} else {
  echo json_encode([]);
}
?>