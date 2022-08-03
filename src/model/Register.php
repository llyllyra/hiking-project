<?php

require_once '../core/dbinfo.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register
{
    private function getConnection()
    {
        try {
            $pdo = new PDO(DNS, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function register()
    {
        $pdo = $this->getConnection();

        if (isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']) &&  isset($_POST['login_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                require_once '../core/db.php';
                //enregistrer les données dans la base de données
                $stmt = $pdo->prepare("INSERT INTO user (firstName, lastName, nickname, email, password, role, confirmation_email) VALUES (:firstname, :lastname, :loginname, :email, :password, :role, :confirmMail)");
                $stmt->bindParam(':firstname', $firstName);
                $stmt->bindParam(':lastname', $lastName);
                $stmt->bindParam(':loginname', $loginName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':confirmMail', $confirmationMail);

                // insertion d'une ligne
                $firstName = htmlspecialchars($_POST['first_name']);
                $lastName = htmlspecialchars($_POST['last_name']);
                $loginName = htmlspecialchars($_POST['login_name']);
                $email = htmlspecialchars($_POST['email']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $role = "user";
                $confirmationMail = "not_confirmed";
                $stmt->execute();
                $recupUser= $pdo->prepare("select * from user WHERE email = ?") ;
                $recupUser->execute(array($email));
                if($recupUser->rowCount()> 0){
                    $userInfo = $recupUser->fetch();
                    $_SESSION['id'] = $userInfo['id'];

                
                $title = "Merci pour votre inscription";
                $body = 'http://localhost:3000/confirmMail?id='.$_SESSION['id'];
                $from =  "randodev02@gmail.com";
                $name= "randodev";
                $this->sendEmail($email, $title, $body );
                }
                //Redirection
                header('Location: home');
                exit();
            } else {
                ?>
                <div class="box_container"><div class="wrong_box">Adresse email invalide. <br /><a href="<?php echo "$_SERVER[HTTP_REFERER]"; ?>">Retour</a></div></div>
                <?php
            }
//Si les champs ne sont pas tous remplis
        }
        else {
            echo "Veuillez remplir tous les champs";
        }
    }
    public function sendEmail($to, $subject, $body){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Mailer = "smtp";                   // Set mailer to use SMTP

        $mail->SMTPDebug = 1;                     // Enable verbose debug output
        $mail->SMTPAuth = TRUE;                   // Enable SMTP authentication
        $mail->SMTPSecure = "tls";                // Enable TLS encryption, 'ssl' (a predecessor to TSL) is also accepted
        $mail->Port = 587;                        // TCP port to connect to (587 is a standard port for SMTP)
        $mail->Host = "smtp.gmail.com";           // Specify main and backup SMTP servers
        $mail->Username = "randodev02@gmail.com";  // SMTP username
        $mail->Password = 'chimciwjsvlnbtsb';         // SMTP password

        $mail->setFrom('randodev02@gmail.com', 'randoDev');
        $mail->addAddress($to, 'name-is-optional');

        $mail->isHTML(true);                      // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();

    }
}