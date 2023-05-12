<?php
require_once '../config.php';

// Vérifier que les champs email et password sont renseignés
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Récupère les valeurs saisies dans le formulaire
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Préparation de la requête pour récupérer les informations de l'utilisateur
    $stmt = $conn->prepare("SELECT * FROM Utilisateur WHERE email=:email");
    $stmt->execute(array(':email'=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification si l'utilisateur existe
    if($row === false) {
        header("Location: login.php?alre=" . urlencode("Nom d'utilisateur ou mot de passe incorrect."));
        exit();
    } else {
        // Vérification si le mot de passe correspond
        if(password_verify($password, $row['password'])) {
            // Vérification si l'utilisateur est bloqué
            if($row['statue'] == "b") {
                header("Location: login.php?alre=utilisateur_bloque");
                exit();
            }
            // Début de la session de l'utilisateur
            session_start();
            $_SESSION['id_utilisateur'] = $row['id_utilisateur'];
            $_SESSION['username'] = $row['nom'];
            header("Location: ../Auction/auction.html"); // Redirection vers la page d'accueil
            exit();
        } else {
            header("Location: login.php?alre=" . urlencode("Nom d'utilisateur ou mot de passe incorrect."));
            exit();
        }
    }
}
// Si les champs ne sont pas renseignés ou si le formulaire n'a pas été soumis, rediriger vers login.php
header("Location: ../index.html");
exit();
?>