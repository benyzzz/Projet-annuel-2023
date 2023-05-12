<?php
require_once '../../config.php';
//reset_password_form.php
// Vérifie si le code de réinitialisation de mot de passe est présent dans l'URL
session_start();
if(!isset($_SESSION['code']) || empty($_SESSION['code'])) {
    header("Location: ../login.php");
    exit();
}
// FAIRE EN SQL UN TTRUC POUR RECUPERER WHERE $_SESSION['code'] == token et récupe id et la mettre dans 'user _id';
// Retirer la ligne de la table après where $_SESSION['code'] == token

// Vérifie si le code de réinitialisation de mot de passe est valide
$stmt = $conn->prepare("SELECT * FROM PasswordReset WHERE token=:code AND expiry_time > NOW()");
$stmt->execute(array(':code'=>$_SESSION['code']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$row) {
    header("Location: ../login.php?pot");
    exit();
}

// Traitement du formulaire de réinitialisation de mot de passe
if(isset($_POST['submit'])) {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
  
    var_dump($_SESSION);  
  
    // Validation du mot de passe
    if(strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif($password === $password_confirm) {
        // Hash le mot de passe
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe dans la base de données
        $stmt = $conn->prepare("UPDATE Utilisateur SET password=:password_hashed WHERE id_utilisateur=:user_id");
        $stmt->execute(array(':password_hashed'=>$password_hashed, ':user_id'=>$row['user_id']));

        // Supprime le code de réinitialisation de la base de données
        $stmt = $conn->prepare("DELETE FROM PasswordReset WHERE user_id=:user_id");
        $stmt->execute(array(':user_id'=>$row['user_id']));

        // Redirige l'utilisateur vers la page de connexion
        header("Location: ../login.php?password_reset_success=1");
        exit();
    } else {
        $error = "Les deux mots de passe ne correspondent pas.";
    }
} else {
    echo ("ERROR");
}
?>