<?php
declare(strict_types = 1);
require_once '../core/dbinfo.php';
require_once 'dbconnect.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register  extends Dbconnect
{

    public function registers($mail)
    {
        $pdo = $this->getConnection();
        $req = $pdo->prepare("SELECT * FROM user WHERE email = '$mail'");
        $req->execute();
        $mails = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($mails);

          if(count($mails) === 0 ) {
            echo 'bonjour';
                if (isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['login_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

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
                        $confirmationMail =  round(microtime(TRUE));
                        $stmt->execute();
                        $recupUser = $pdo->prepare("SELECT * FROM user WHERE email = ?");
                        $recupUser->execute(array($email));
                        if ($recupUser->rowCount() > 0) {
                            $userInfo = $recupUser->fetch();
                            $_SESSION['id'] = $userInfo['id'];


                            $title = "Merci pour votre inscription";
                            $body = 'http://localhost:3000/confirmMail?cle=' . $confirmationMail;
                            $from = "randodev02@gmail.com";
                            $name = "randodev";
                            $this->sendEmail($email, $title, $body);
                        }
                        //Redirection

                        $message = "User added successfully";
                        require_once "../view/messages.php";
                        header('Refresh: 2, url=home');
                        header('Location: home');
                        exit();
                    } else {
                        ?>
                        <div class="box_container">
                            <div class="wrong_box">Adresse email invalide. <br/><a
                                        href="<?php echo "$_SERVER[HTTP_REFERER]"; ?>">Retour</a></div>
                        </div>
                        <?php
                    }
//Si les champs ne sont pas tous remplis
                } else {
                    echo "Veuillez remplir tous les champs";
                }
            }else{
              foreach ($mails as $row):
                  if ($row['email'] === $mail) {
                      $message = "Compte existant";
                      require_once "../view/messages.php";
                      header('Refresh: 2, url=home');
                      exit();
                  }
              endforeach;
          }

    }

    public function sendEmail($to, $subject, $body)
    {
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
        $mail->Body = $body;

        $mail->send();

    }
}