<?php

require_once '../core/dbinfo.php';
require_once 'dbconnect.php';

class confirmMail extends Dbconnect
{

    public function confirmMail(){

        if(isset($_GET['cle']) && !empty($_GET['cle']) ){
            $pdo = $this->getConnection();
            $cle = $_GET['cle'];
            $recupUser =  $pdo->prepare("SELECT * FROM user WHERE confirmation_email = $cle");
            $recupUser->execute();
            var_dump($recupUser);
           if ($recupUser->rowCount() > 0){
               $useInfo = $recupUser->fetch();

                if($useInfo['confirmation_email'] !== "confirmed"){
                    $confirm = 'confirmed';
                    $query = 'UPDATE user set `confirmation_email` = ?  WHERE confirmation_email = ?';
                     $update = $pdo->prepare($query);

                     $update->execute(array($confirm,$cle));
                    header('Location: home');
                } else{
                    var_dump($_GET['cle']);
                }
           }else{
               echo 'clé incorrect';
           }

        } else{
            echo "aucun utilisateur trouvé" ;
            
        }
    }
}