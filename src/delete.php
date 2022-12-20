<?php
//Verwijderen van een boom

require 'db.php';
$conn = pdo_connect_mysql();
$id = $_GET['id'];
$sql = 'DELETE FROM boom WHERE id=:id';
$statement = $conn->prepare($sql);
if ($statement->execute([':id' => $id])) {
  header("Location: map.php");
}