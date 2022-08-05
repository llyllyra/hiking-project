<?php
require_once '../core/dbinfo.php';


class Sql
{
    private function connection()
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
    

    // Afficher tous les utilisateurs

    public function getUser(): array
    {
        $pdo = $this->connection();

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
        $pdo = $this->connection();

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
    



    //ajout

    

    

    //modification

  

    //edit user par l'admin

    public function updateUserByAdmin()
    {

        $pdo = $this->connection();
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


    // delete
    
}