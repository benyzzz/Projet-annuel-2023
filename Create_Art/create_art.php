<?php
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header('Content-Type: application/json');
    echo json_encode(["result" => "error", "message" => "Utilisateur non connecté"]);
    exit;
}
header('Content-Type: application/json');

include 'config.php';

$categorie = $_POST['categorie'];
$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$prix = $_POST['prix'];
$id_utilisateur = $_SESSION['id_utilisateur'];

$image = $_FILES['image'];
$imagePath = __DIR__ . '/uploads/' . time() . '-' . basename($image['name']);
$relativeImagePath = '/Create_Art/uploads/' . time() . '-' . basename($image['name']);
move_uploaded_file($image['tmp_name'], $imagePath);


try {
    $stmt = $conn->prepare("INSERT INTO Art (categorie, titre, auteur, prix, image, id_utilisateur) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $categorie, PDO::PARAM_STR);
    $stmt->bindParam(2, $titre, PDO::PARAM_STR);
    $stmt->bindParam(3, $auteur, PDO::PARAM_STR);
    $stmt->bindParam(4, $prix, PDO::PARAM_INT);
    $stmt->bindParam(5, $relativeImagePath, PDO::PARAM_STR);
    $stmt->bindParam(6, $id_utilisateur, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(["result" => "success", "message" => "Offre d'art créée avec succès"]);
    } else {
        echo json_encode(["result" => "error", "message" => "Erreur lors de la création de l'offre d'art"]);
    }
} catch (PDOException $e) {
    echo json_encode(["result" => "error", "message" => "Erreur : " . $e->getMessage()]);
}

$conn = null;

