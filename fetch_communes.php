<?php
require_once 'db.php';

if (isset($_GET['district_id'])) {
  $district_id = $_GET['district_id'];
  $stmt = $pdo->prepare('SELECT id, names FROM communes WHERE district_id = :district_id');
  $stmt->execute(['district_id' => $district_id]);
  $communes = $stmt->fetchAll();
  echo json_encode($communes);
} else {
  echo json_encode([]);
}
?>