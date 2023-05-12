<?php

require_once 'config.php';

session_start();


try {
    // Enregistrez les informations de la troisième étape
    if (isset($_FILES['photo'])) {
        $photo = $_FILES['photo'];
        $photo_path = 'uploads/' . basename($photo['name']);
        move_uploaded_file($photo['tmp_name'], $photo_path);

        $banner = $_FILES['banner'];
        $banner_path = 'uploads/' . basename($banner['name']);
        move_uploaded_file($banner['tmp_name'], $banner_path);

        $couleur = $_POST['couleur'];

        $stmt = $conn->prepare("INSERT INTO Utilisateur_Details (id_utilisateur, photo, banniere, couleur) VALUES (:id_utilisateur, :photo_path, :banner_path, :couleur)");

        $stmt->bindParam(":id_utilisateur", $_SESSION['id_utilisateur']);
        $stmt->bindParam(":photo_path", $photo_path);
        $stmt->bindParam(":banner_path", $banner_path);
        $stmt->bindParam(":couleur", $couleur);

        if ($stmt->execute()) {
            echo "Étape 3 : Création de votre Profil avec succès !";
            header("Location: ../Auction/Auction.html");
            exit();
        } else {
            echo "<p>Erreur lors du profil de l'utilisateur.</p>";
        }
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Ferme la connexion PDO
$db = null;

?>