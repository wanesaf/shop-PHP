<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
    <link href="AdminView.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Add new Item</h1>
        <form action="addItems.php" method="post">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" placeholder="nom du produit" required>
            <label for="prix">Prix:</label>
            <input type="text" name="prix" placeholder="prix" required>
            <label for="description">Description:</label>
            <textarea name="desc" id="desc" cols="20" rows="3" placeholder="description du produit" required></textarea>
            <label for="path"> Le Chemin de l'image : </label>
            <input type="text" name="path" required placeholder="Chemin de l'image">
            <button type="submit">Confirmer</button>
        </form>
    </div>
</body>

</html>