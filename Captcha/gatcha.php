<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Inclure les classes PHPMailer
require __DIR__.'/PHPMailer/src/Exception.php';
require __DIR__.'/PHPMailer/src/PHPMailer.php';
require __DIR__.'/PHPMailer/src/SMTP.php';


session_start();

if (isset($_GET['veriff'])) {
    $error = $_GET['veriff'];
} else {
    $error = '';
}

if (isset($_POST['submit'])) {
    // Vérifiez ici si le gatcha est valide

    $email = $_SESSION['email'];
    $name = $_SESSION['name'];

    $gatchaValide = true; // Exemple de valeur pour $gatchaValide, à adapter à votre logique de validation

    // Si le gatcha est valide, envoyez l'e-mail
    if ($gatchaValide) {
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
                    $mail->addAddress($email, $name);         // Ajouter un destinataire

                    // Contenu du message
                    $mail->isHTML(true);                       // Format HTML activé
                    $mail->Subject = 'Mail Confirmation';
                    $mail->Body = '<div style="background-color: #f2f2f2; padding: 20px;">
                    <h2 style="color: #007bff;">Confirmation de votre inscription</h2>
                    <p style="font-size: 16px;">Bonjour,</p>
                    <p style="font-size: 16px;">Nous vous confirmons que votre inscription a bien été enregistrée.</p>
                    <p style="font-size: 16px;">Merci de votre confiance.</p>
                    </div>';
                         // Envoi du message
                    $mail->send();
                    echo 'Message envoyé';

                    header("Location: ../Auction/auction.html?veriff=" .urlencode("Utilisateur enregistré avec succès"));
                    exit();

                    } catch(Exception $e) {
                    echo "<p>Erreur lors de l'envoi de l'email de confirmation: " . $mail->ErrorInfo . "</p>";
                }    } else {
        // Le gatcha n'est pas valide, affichez un message d'erreur
        $error = "Le gatcha est invalide.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captcha Puzzle</title>
    <link rel="stylesheet" href="gatcha.css">
</head>
<body>
    <center>
        <?php if ($error !== ''): ?>
        <p style="color: green;font-size: 14px"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <div class="puzzle-container" id="puzzle-container">
            <!-- Les pièces du puzzle seront générées ici -->
        </div>
        <form method="post">
            <button id="submit-btn" name="submit">Valider</button>
        </form>
        <script src="script.js"></script>
    </center>
</body>
</html>