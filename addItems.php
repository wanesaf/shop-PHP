<?php
$host = "localhost";
$username = //le nom d'utilisateur de la db;
$password = //le mot de passe de la db;
$dbname = "items";
$port = 3306 ; 

$dsn = "mysql:host=$host;dbname=$dbname;port=$port";
$pdo = new PDO($dsn,$username,$password);
if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    if (isset($_POST['nom'],$_POST['prix'],$_POST['desc'],$_POST['path'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prix = htmlspecialchars($_POST['prix']);
        $descr = htmlspecialchars($_POST['desc']);
        $pathImg = htmlspecialchars($_POST['path']);

        $sql = "INSERT INTO item (nom,prix,descr,img) VALUES (:nom,:prix,:descr,:pathImg)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nom',$nom,PDO::PARAM_STR);
        $stmt->bindParam(':prix',$prix,PDO::PARAM_STR);
        $stmt->bindParam(':descr',$descr,PDO::PARAM_STR);
        $stmt->bindParam(':pathImg',$pathImg,PDO::PARAM_STR);
        try {   
            $stmt->execute(); 
            echo "Data inserted successfully."; 
        } catch (PDOException $e) 
        { echo "Error: " . $e->getMessage(); }
         
    }
    else { 
        echo "All fields are required.";
     }
} 
?>