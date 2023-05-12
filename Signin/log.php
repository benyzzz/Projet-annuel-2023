<?php

require_once 'config.php';

session_start();

try {
    if (isset($_POST['submit'])) {
        // Récupère les valeurs saisies dans le formulaire
        $name = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Vérifie si les mots de passe correspondent
        if ($password !== $confirm_password) {
            header("Location: signin.php?error=" . urlencode("Les mots de passe ne correspondent pas. Veuillez réessayer."));
            exit();
        } else if (strlen($password) < 8) {
            header("Location: signin.php?error=" . urlencode("Le mot de passe doit contenir au moins 8 caractères."));
            exit();
        } else if (!preg_match('/[A-Z]/', $password)) {
            header("Location: signin.php?error=" . urlencode("Le mot de passe doit contenir au moins une lettre majuscule."));
            exit();
        } else if (!preg_match('/[a-z]/', $password)) {
            header("Location: signin.php?error=" . urlencode("Le mot de passe doit contenir au moins une lettre minuscule."));
            exit();
        } else if (!preg_match('/[0-9]/', $password)) {
            header("Location: signin.php?error=" . urlencode("Le mot de passe doit contenir au moins un chiffre."));
            exit();
        } else {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['name'] = $_POST['nom'];
            $_SESSION['password'] = $_POST['password'];

            // Vérifie si l'utilisateur existe déjà
            $stmt = $conn->prepare("SELECT * FROM Utilisateur WHERE email=:email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                header("Location: ../Login/login.php?exist=" . urlencode("L'utilisateur avec l'adresse e-mail $email existe déjà. Veuillez vous connecter."));
                exit();
            } else {
                header("Location: 2log.php");
                exit();
            }
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Ferme la connexion PDO
$db = null;
?>