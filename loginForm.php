<?php
session_start();
$host = "localhost";
$username = //le nom d'utilisateur de la db;
$password = //le mot de passe de la db;
$dbname = "db_persons";
$port = 3306;
$dsn = "mysql:host=$host;dbname=$dbname;port=$port";
$pdo = new PDO($dsn, $username, $password);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $sqlOne = "SELECT * from users WHERE username=:username";

        $stmtOne = $pdo->prepare($sqlOne); 

        $stmtOne->bindParam(':username', $username, PDO::PARAM_STR);

        $stmtOne->execute();

        while ($row = $stmtOne->fetch(PDO::FETCH_ASSOC)) {
            if ($row['password'] == $password) {
                session_destroy();
                session_unset();
                session_start();
                $_SESSION['username'] = $username;
                header("Location:accueil.php");
                exit();
                break;
            }
        }
        $sqlTwo = "SELECT * from admins WHERE username=:username";

        $stmtTwo = $pdo->prepare($sqlTwo); 

        $stmtTwo->bindParam(':username', $username, PDO::PARAM_STR);

        $stmtTwo->execute();

        while ($row = $stmtTwo->fetch(PDO::FETCH_ASSOC)) {
            if ($row['password'] == $password) {
                session_destroy();
                session_unset();
                session_start();
                $_SESSION['username'] = $username;
                header("Location:itemsForm.php");
                exit();
                break;
            }
        }
        echo "invalid username or password";
    }
}
