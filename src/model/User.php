<?php
declare(strict_types = 1);
require_once '../core/dbinfo.php';
require_once 'dbconnect.php';



class User    extends Dbconnect
{

    // Afficher tous les utilisateurs

    public function getUser(): array
    {
        $pdo = $this->getConnection();;

        try {
            $q = $pdo->prepare("SELECT * FROM user");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $users = $q->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }


    // Afficher les utilisateurs par id
    public function getUserById(int $id): array
    {
        $pdo = $this->getConnection();;

        try {
            $q = $pdo->prepare("SELECT * FROM user WHERE id = $id");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $user = $q->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    //edit user par l'admin

    public function updateUserByAdmin()   :void
    {

        $pdo = $this->getConnection();;
        if (isset($_POST['first_name'])) {
            //enregistrer les données dans la base de données
            $stmt = $pdo->prepare(
                "UPDATE 
                            user 
                        SET 
                            firstName = :firstName,
                            lastName= :lastName,
                            nickname= :login,
                            role= :role
                        WHERE id = $_GET[id]"
            );
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':role', $role);


            // insertion d'une ligne
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $login = $_POST['login_name'];
            $role = $_POST['role'];

            //On execute l'insertion dans la bdd
            $stmt->execute();
            //On défini le message à afficher
            $message = "User updated successfully. Redirection...";
            require_once "../view/messages.php";
            //Redirection vers home après 2 secondes
            header("Refresh: 2;URL=viewUser");
            exit();

        } else {
            echo 'error';
        }
    }

    // delete user

    public function delUser()  :void
    {
        $pdo = $this->getConnection();;
        try {
            $d = $pdo->prepare("DELETE FROM user WHERE id = :id");
            $d->bindParam('id', $id);
            $id = $_GET["id"];
            $d->execute();
            $message = "vous avez bien effacé l'utilisateur";
            require_once "../view/messages.php";
            header('Refresh: 2, url=viewUser');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function connexion()
    {

        // on teste la déclaration de nos variables
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $pdo = $this->getConnection();
            $email = $_POST['email'];
            $password = $_POST['password'];
            //Récupérer les données de l'utilisateur
            $req = $pdo->prepare("SELECT * FROM user WHERE email = '$email'");


            $req->execute();


            foreach ($req as $row) {

                if (!password_verify($password, $row['password'])) {
                    //Redirection
                    header('Location: home');
                    exit();
                } else {
                    if($row["confirmation_email"] === "confirmed"){
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['nickname'] = $row['nickame'];
                        $_SESSION['role'] = $row['role'];
                        //Redirection
                        header('Location: home');
                        exit();
                    } else {
                        //message de confirmation
                        header('Location: home');
                        exit();
                    }


                }
            }

        } else {
            //Afficher message d'erreur
            //echo "Une erreur s'est produite, veuillez réessayer.";
        }
    }
}