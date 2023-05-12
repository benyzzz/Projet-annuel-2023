
<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de mot de passe</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="confirm.css">
    <link rel="icon" href="../Projet_img/WOA_1.svg" type="image/png">
</head>
<body>
<?php 
  session_start();
  $_SESSION['code'] = $_GET['token'];
?>
    <div class="container">
        <p>Réinitialisation de mot de passe</p>
        <form method="POST" action="reset_password_form.php">
            <input type="password" name="password" placeholder="Nouveau mot de passe">
            <input type="password" name="password_confirm" placeholder="Confirmer le nouveau mot de passe">
            <button type="submit" name="submit">Réinitialiser le mot de passe</button>
        </form>
    </div>
</body>
</html>