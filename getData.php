<?php
header("Content-Type: application/json");

$host = "localhost";
$username = //le nom d'utilisateur de la db;
$password = //le mot de passe de la db;
$dbname = "items";
$port = "3306"; 
$dsn = "mysql:host=$host;dbname=$dbname;port=$port";
$pdo = new PDO($dsn,$username,$password);
$stmt = $pdo->query("SELECT nom,prix from item");

$items = array() ; 
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $items[] = $row;
}
echo json_encode($items);
?>