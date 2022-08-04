<?php

require_once '../core/dbinfo.php';
require_once 'dbconnect.php';

class confirmMail extends Dbconnect
{

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
                    $query = 'UPDATE user set `confirmation_email` = ?  WHERE id = ?';
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