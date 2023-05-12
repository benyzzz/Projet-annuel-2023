<?php

require_once 'config.php';

session_start();

try {
    if (isset($_POST['submit'])) {
        // Récupère les valeurs saisies dans le formulaire
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['Phone'];
        $address = $_POST['Address'];
        $postal = $_POST['postal'];
        $birth = $_POST['date_naissance'];

        $email = $_SESSION['email'];
        $name = $_SESSION['name'];
        $password = $_SESSION['password'];

        // Hash le mot de passe
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // Insère les données dans la base de données
        $stmt = $conn->prepare("INSERT INTO Utilisateur (nom, email, password, first_name, last_name, phone_number, address, code_postal, date_naissance) VALUES (:name, :email, :password, :first_name, :last_name, :phone, :address, :postal, :birth)");

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hashed);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":postal", $postal);
        $stmt->bindParam(":birth", $birth);

        
        if ($stmt->execute()) {
            session_start();
            $id_pic = $conn->lastInsertId();
            $_SESSION['id_pic'] = $id_pic;
            header("Location: profil.php");
            // Redirige vers 2log.php après l'enregistrement des données
            exit();
        } else {
            echo "<p>Erreur lors de l'enregistrement de l'utilisateur.</p>";
        }
    }
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

// Ferme la connexion PDO
$db = null;

?>