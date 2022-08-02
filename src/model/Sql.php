<?php
require_once '../core/dbinfo.php';


class Sql
{
    private $pdo;
    
    private function connection()
    {
        try {
            $pdo = new PDO(DNS, USER, PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    
    //afficher toutes les randonnées
    public function getHikes()
    : array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT * from hikes");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getHikesAdmin()
    : array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT *, u.nickname, h.id as hikeId from hikes h join user u on u.id = h.user_Id ORDER BY hikeId");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Afficher les randonnée par id
    public function getHikeById(int $id)
    : array {
        $pdo = $this->connection();
        
        try {
            $q = $pdo->prepare("SELECT * from hikes WHERE id = $_GET[id]");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
        return $hikes;
    }
    
    // Afficher les randonnée par id user
    public function getHikeByUser(int $id)
    : array {
        $pdo = $this->connection();
        
        try {
            $q = $pdo->prepare("SELECT *, h.id as hikeId from hikes h WHERE user_Id = $_SESSION[user_id]");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
        return $hikes;
    }
    
    // Afficher les randonnée par id pour l'effacer
    public function getDelHike($id)
    : array {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT name, user_Id, id from hikes WHERE id = $_GET[id]");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Afficher la list des tags
    public function getTag()
    : array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT * from tags");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $tags = $q->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }
    
    // afficher le profil
    
    public function getUserbyId(){
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT * FROM user WHERE id = $_SESSION[user_id] ");
            $q->execute();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $user = $q->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
    
    //ajout
    
    public function addHikes()
    {
        $pdo = $this->connection();
    
        //enregistrer les données dans la base de données
        $stmt = $pdo->prepare("INSERT INTO hikes (name, departure, arrive, difficulty, distance, duration, elevationGain, description, tags_id, createdDate, user_Id, imgUrl) VALUES (:name, :departure, :arrive, :difficulty, :distance, :duration, :elevationgain, :description, :tags, :date, :user, :imgUrl)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':departure', $departure);
        $stmt->bindParam(':arrive', $arrive);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':elevationgain', $elevationgain);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':imgUrl', $imgUrl);
    
        // insertion d'une ligne
        $name = $_POST['name'];
        $departure = $_POST['departure'];
        $arrive = $_POST['arrive'];
        $difficulty = $_POST['difficulty'];
        $distance = $_POST['distance'];
        $duration = $_POST['duration'];
        $elevationgain = $_POST['elevationgain'];
        $description = $_POST['description'];
        $tags = implode(';', $_POST['tags']);
        $date = date('Y-m-d');
        $user= $_SESSION['user_id'];
        
        $stmt->execute();
        $message = "vous avez bien ajouter la randonnée";
        require_once "../view/messages.php";
        header('Refresh: 2, url=my_hikes');
        exit();
    }
    
    public function addUser()
    {
        $pdo = $this->connection();
        
    }
    
    //modification
    
    public function updateHikes()
    {
    
        $imgName = $_FILES['fileToUpload']['name'];
        $imgSize = $_FILES['fileToUpload']['size'];
        $tmpName = $_FILES['fileToUpload']['tmp_name'];
        $imgEx = pathinfo($imgName, PATHINFO_EXTENSION);
        $allowedEx = ['jpg', 'png', 'jpeg', 'gif'];
        if (in_array($imgEx, $allowedEx)) {
            $newName = round(microtime(TRUE)) . '.' . $imgEx;
            $destination_path = getcwd() . DIRECTORY_SEPARATOR;
            $imgPath = $destination_path . 'upload/' . $newName;
            move_uploaded_file($tmpName, $imgPath);
        
            $pdo = $this->connection();
            if (isset($_POST['name']) && isset($_POST['departure']) && isset($_POST['arrive']) && isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['elevationgain']) && isset($_POST['description'])) {
                //enregistrer les données dans la base de données
                $stmt = $pdo->prepare(
                    "UPDATE hikes SET name = :name, departure = :departure, arrive = :arrive, difficulty = :difficulty, distance = :distance, duration = :duration, elevationGain = :elevationgain, description = :description,  updateDate = :date, user_Id = :user, imgUrl = :imgUrl WHERE id = $_GET[id]"
                );
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':departure', $departure);
                $stmt->bindParam(':arrive', $arrive);
                $stmt->bindParam(':difficulty', $difficulty);
                $stmt->bindParam(':distance', $distance);
                $stmt->bindParam(':duration', $duration);
                $stmt->bindParam(':elevationgain', $elevationgain);
                $stmt->bindParam(':description', $description);
                //$stmt->bindParam(':tags', $tags);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':imgUrl', $newName);
            
                // insertion d'une ligne
                $name = $_POST['name'];
                $departure = $_POST['departure'];
                $arrive = $_POST['arrive'];
                $difficulty = $_POST['difficulty'];
                $distance = $_POST['distance'];
                $duration = $_POST['duration'];
                $elevationgain = $_POST['elevationgain'];
                $description = $_POST['description'];
                //$tags = implode(';', $_POST['tags']);
                $date = date('Y-m-d');
                $user = $_SESSION['user_id'];
            
            
                //On execute l'insertion dans la bdd
                $stmt->execute();
                //On défini le message à afficher
                $message = "Hike updated successfully. Redirection...";
                //include_once 'messages.php';
                //Redirection vers home après 2 secondes
                header("Refresh: 2;URL=my_hikes");
                exit();
            
            }
            else {
                echo 'error';
            }
        }
    }
    
    // delete
    
    public function delHikes()
    {
        $pdo = $this->connection();
        try {
            $d = $pdo->prepare("DELETE FROM `hikes` WHERE id = :id");
            $d->bindParam('id', $id);
            $id = $_GET["id"];
            $d->execute();
            $message = "vous avez bien effacé la randonnée";
            require_once "../view/messages.php";
            header('Refresh: 2, url=my_hikes');
            exit();
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        
    }
    
    // Connexion
    
    public function connexion(){
        $pdo = $this->connection();
        // on teste la déclaration de nos variables
        if (isset($_POST['email']) && isset($_POST['password'])) {
            require_once '../core/db.php';
            $email = $_POST['email'];
            $password = $_POST['password'];
            //Récupérer les données de l'utilisateur
            $req = $pdo->prepare("SELECT * FROM user WHERE email = '$email'");
            $req->execute();
        
        
            foreach ($req as $row) {
            
                if (!password_verify($password, $row['password'])) {
                    //Redicrection
                    header('Location: wrong_password');
                    exit();
                }
                else {
                    //Définition de la session utilisateur
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['nickname'] = $row['nickame'];
                    $_SESSION['role'] = $row['role'];
                    //Redicrection
                    header('Location: home');
                    exit();
                }
            }
        
        }
        else {
            //Afficher message d'erreur
            //echo "Une erreur s'est produite, veuillez réessayer.";
        }
    }
    
}