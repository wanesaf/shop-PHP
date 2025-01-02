<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini catalogue</title>
    <link rel="stylesheet" href="style.css">
    <script src="main.js" defer></script>
</head>

<body>
    <div class="content">
        <div class="flex">
            <div style="display: flex;flex-direction: row;justify-content: center;align-items: center;">
                <h1>Sport Corner</h1>
                <img src="football.png" alt="football" style="width: 50px;height: 50px;">
            </div>
            <div style="display: flex;justify-content: center;align-items: center;gap: 1rem;">
                <input type="search" id="search" placeholder="Rechercher 🧐"
                    style="border-radius: 5px; border: 1px solid rgb(77, 75, 75) ;outline:none ; padding : 0.5rem 3rem 0.5rem 3rem ; background-color: white;">
                <button id="panier"
                    style="margin-top: 0; padding: 0.1rem; border: none; background-color: whitesmoke;">🛒</button>
            </div>
            <form action="accueil.php" method="POST" style="display: flex;justify-content: center;align-items: center; gap:10px">
                <label for="logout">Se déconnecter</label>
                <button type="submit" style="border: none; background-color: whitesmoke; ">
                    <img src="logout.png" alt="logout" style="width: 50px ;height:50px">
                </button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                header("Location:index.php");
                exit();
            }
            ?>
        </div>
        <div class="container">
            <?php
            $host = "localhost";
            $username = //le nom d'utilisateur de la db;
            $password = //le mot de passe de la db;
            $dbname = "items";
            $port = "3306";
            $dsn = "mysql:host=$host;dbname=$dbname;port=$port";
            $pdo = new PDO($dsn, $username, $password);
            $stmt = $pdo->query("SELECT * from item");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <div>
                    <?php $i = 0 ?>
                    <img src="images/<?php echo $row['img'] ?>">
                    <p>Nom : <span><?php echo $row['nom'] ?></span><br>
                        Prix : <?php echo $row['prix'] ?> DA <br>
                        Description : <?php echo $row['descr'] ?><br>
                        <input type="number" name="qte" id=<?php echo $i ?> min="1" max="5" placeholder="qte">
                        <button class="details">Voir détails</button>
                        <button class="Ajouter">Ajouter au panier </button>
                        <?php $i++ ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="hidden">
        <button
            style="position: absolute; right: 10px; top:10px ; border: none; background-color: whitesmoke;">❌</button>
        <img src="grocery-store.png" alt="shopping"
            style="position: absolute;left: 10px;top: 5px;border: none; width: 35px;height: 35px;">
    </div>

    <div class="hidden2" style="background-color: white; border : 1px solid black ;">
        <button
            style="position: absolute; right: 10px; top:10px ; border: none; background-color: white;">❌
        </button>
        <div class="buttons">
            <button class="prev">
                &lt;
            </button>
            <button class="next">
                &gt;
            </button>
        </div>
    </div>
</body>

</html>