<?php
// il sait peut-etre trompé
if (isset($_GET['alre'])) {
    $error = $_GET['alre'];
} else {
    $error = '';
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css">
  <link rel="icon" href="../Projet_img/WOA_1.svg" type="image/png">
</head>
<body>
  <div class="container">
    <p>Login</p>
    <?php if ($error !== ''): ?>
        <p style="color: red;font-size: 14px"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="enter.php">
      <input type="email" name="email" placeholder="Mail" required>
      <input type="password" name="password" placeholder="Password" title="Le mot de passe doit contenir au moins 6 caractères" required>
      <button type="submit" name="submit">Enter</button>
      <a href="Reset/mdp.html">Mot de passe oublié ?</a>
    </form>
  </div>
</body>
</html>