<?php

session_start();

require_once 'config.php';

try {
if (isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    $photo_path = 'uploads/' . basename($photo['name']);
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }    
    
    error_log("Fichier temporaire : " . $photo['tmp_name']);
    error_log("Chemin du fichier de destination : " . $photo_path);

    $move_result = move_uploaded_file($photo['tmp_name'], $photo_path);
    error_log("Résultat du déplacement du fichier : " . move_uploaded_file($photo['tmp_name'], $photo_path));

    $banniere = $_FILES['banniere'];
    $banniere_path = 'uploads/' . basename($banniere['name']);
    move_uploaded_file($banniere['tmp_name'], $banniere_path);

    $couleur = $_POST['couleur'];

    session_start();
    $id_pic = $_SESSION['id_pic'];

    // Insérez les données dans la table profil
    $sql = "INSERT INTO Utilisateur_Details (id_pic, photo, banniere, couleur)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id_pic, PDO::PARAM_INT);
    $stmt->bindParam(2, $photo_path, PDO::PARAM_STR);
    $stmt->bindParam(3, $banniere_path, PDO::PARAM_STR);
    $stmt->bindParam(4, $couleur, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Redirigez l'utilisateur vers une page de confirmation ou la page de profil
        header("Location: ../Captcha/gatcha.php");
        exit;
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}
} catch(PDOException $e) {
    echo"Erreur: " . $e->getMessage();
}
    // Ferme la connexion PDO
$db = null;
?>