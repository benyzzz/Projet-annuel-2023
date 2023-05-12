<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Création du Profil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <form action="etape3.php" method="post" enctype="multipart/form-data">

        <label for="photo">Photo de profil (glisser-déposer):</label>
            <input type="file" id="photo" name="photo" required><br><br>

            <a href="create_avatar.html">Créer ton Avatar</a><br><br>

        <label for="photo">Image de la Bannière (glisser-déposer):</label>
            <input type="file" id="banniere" name="banniere" required><br><br>

        <label for="couleur">Thème du Profil</label>
            <input type="color" id="couleur" name="couleur" required><br><br>


            <button type="submit">Crée mon Profil</button>
        </form>
    </div>
</body>
</html>