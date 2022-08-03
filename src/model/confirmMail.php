<?php

require_once '../core/dbinfo.php';

class confirmMail{
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

    public function confirmMail(){

        if(isset($_GET['id']) && !empty($_GET['id']) ){
            $pdo = $this->getConnection();
            $getid = $_GET['id'];
            $recupUser =  $pdo->prepare("SELECT * FROM user WHERE id= $getid");
            $recupUser->execute();

           if ($recupUser->rowCount() > 0){
               $useInfo = $recupUser->fetch();

                if($useInfo['confirmation_email'] === "not_confirmed"){
                    $confirm = 'confirmed';
                    $query = 'UPDATE user set `confirmation_email` = ?  WHERE ?';
                     $update = $pdo->prepare($query);

                     $update->execute(array($confirm,$getid));
                    var_dump($useInfo);
                    header('Location: home');
                } else{
                    var_dump($_GET['id']);
                }
           }else{
               echo 'clé incorrect';
           }

        } else{
            echo "aucun utilisateur trouvé" ;
            
        }
    }
}