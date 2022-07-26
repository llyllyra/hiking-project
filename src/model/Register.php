<?php
require_once '../core/Db.php';

class Register extends Db {

    private $email;
    private $firstName;
    private $lastName;
    private $loginName;
    private $password;

    public function __construct(string $email, string $firstName, string $lastName, string $loginName, string $password)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->loginName = $loginName;
        $this->password = $password;
    }
    
    public function addUserToDb () {
        // on teste la déclaration de nos variables
        if (isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name'])&& isset($_POST['login_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            
                //enregistrer les données dans la base de données
                $dbh = $this->connectDb();
                $stmt = $dbh->prepare("INSERT INTO users (firstname, lastname, loginname, email, password) VALUES (:firstName, :lastName, loginName, :email, :password)");
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':loginName', $loginName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
            
                // insertion d'une ligne
                $firstName = $_POST['first_name'];
                $firstName = $_POST['last_name'];
                $firstName = $_POST['login_name'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $stmt->execute();
            
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
}