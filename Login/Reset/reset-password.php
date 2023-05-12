
<?php

// reset-password.php

// Inclure le fichier de configuration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once '../../config.php';

// Inclure les classes PHPMailer
require __DIR__.'/PHPMailer/src/Exception.php';
require __DIR__.'/PHPMailer/src/PHPMailer.php';
require __DIR__.'/PHPMailer/src/SMTP.php';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Vérifie si l'utilisateur existe
    $stmt = $conn->prepare("SELECT * FROM Utilisateur WHERE email=:email");
    $stmt->execute(array(':email'=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row !== false) {
        // Génère un token unique pour la réinitialisation du mot de passe
        $token = bin2hex(random_bytes(32));

        // Stocke le token dans la base de données avec la date d'expiration
        $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour')); // valide pendant une heure
        $stmt = $conn->prepare("INSERT INTO PasswordReset (user_id, token, expiry_time) VALUES (:user_id, :token, :expiry_time)");
        $stmt->execute(array(':user_id'=>$row['id_utilisateur'], ':token'=>$token, ':expiry_time'=>$expiry_time));

        // Envoie l'e-mail de réinitialisation du mot de passe à l'utilisateur
        $reset_link = "https://www.woa-auctions.fr/Login/Reset/confirm.php?token=" . $token; // 

        $mail = new PHPMailer;

                try {
                    // Paramètres du serveur SMTP
                    $mail->SMTPDebug = 0;                      // Débogage SMTP (0 = désactivé)
                    $mail->isSMTP();                           // Utiliser SMTP
                    $mail->Host = 'smtp-mail.outlook.com';     // Nom du serveur SMTP
                    $mail->SMTPAuth = true;                    // Authentification SMTP activée
                    $mail->Username = 'WOA_Serv@outlook.fr'; // Nom d'utilisateur SMTP
                    $mail->Password = 'esgipeek2023';          // Mot de passe SMTP
                    $mail->SMTPSecure = 'tls';                 // Protocole de sécurité SMTP
                    $mail->Port = 587 ;                        // Port TCP pour se connecter au serveur SMTP

                    // Destinataire
                    $mail->setFrom('WOA_Serv@outlook.fr');
                    $mail->addAddress($email);         // Ajouter un destinataire

                    // Contenu du message
                    $mail->isHTML(true);                       // Format HTML activé
                    $mail->Subject = 'WOA.fr - Réinitialisation de mot de passe';
                    
                    $mail->Body = 
                    
                    
                    "Bonjour,\n\nVous avez demandé une réinitialisation de votre mot de passe. Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :\n\n$reset_link\n\nSi vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet e-mail.\n\nCordialement,\nL'équipe de WOA.fr";
                    
                    
                    
                    
                         // Envoi du message
                    $mail->send();
                    echo 'Message envoyé';

        // Redirige l'utilisateur vers une page de confirmation
        header("Location: reset_password_confirmation.php");
        exit();

        } catch(Exception $e) {
                    echo "<p>Erreur lors de l'envoi de l'email de confirmation: " . $mail->ErrorInfo . "</p>";
                }
    } else {
        header("Location: ../../Signin/signin.php?bha=" . urlencode("Aucun compte enregistré avec l'adresse :" . $email));
        exit();
    }
}
?>





