<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else {
    $error = '';
}

session_start()

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign up</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="signin.css">
  <link rel="icon" href="../Projet_img/WOA_1.svg" type="image/png">
</head>
<body>
  <div class="container">
    <p>Sign up</p>
    <?php if ($error !== ''): ?>
        <p style="color: red;font-size: 14px"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="log.php">
      <input type="text" name="nom" placeholder="Name">
      <input type="email" name="email" placeholder="Email">
      <input type="password" name="password" placeholder="Password" title="Le mot de passe doit contenir au moins 8 caractères">
      <input type="password" name="confirm_password" placeholder="Confirm password">
      <button type="submit" name="submit" disabled>Sign up</button>
    </form>
  </div>
  
  <script src="signin.js" > </script>
</body>
</html>

