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
            $q = $pdo->prepare("SELECT * from hikes WHERE user_Id = $_SESSION[user_id]");
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
    
    //ajout
    
    public function addHikes()
    {
        $pdo = $this->connection();
        $stmt = $pdo->prepare(
            "INSERT INTO hikes (name, departure, arrive, difficulty, distance, duration, elevationGain, description, tags_id, createdDate, user_Id) VALUES (:name, :departure, :arrive, :difficulty, :distance, :duration, :elevationgain, :description, :tags, :date, :user)"
        );
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
        $user = $_SESSION['user_id'];
        
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
    /*
    public function updateHikes()
    {
        
        
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
            //$tags = implode(';', $_POST['tags']);
            $date = date('Y-m-d');
            $user = $_SESSION['user_id'];
            
            $target_dir = "/public/upload/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            
            $uploadOk = 1;
            //Récupérer l'extension du fichier
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== FALSE) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                }
                else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            //On accepete que les fichiers dont l'extension est jpg, png, jpeg ou gif
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                exit();
                // if everything is ok, try to upload file
            }
            else {
                //Renommer le fichier avant l'upload. Le nom du fichier est microtime().extension
                $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                $newfilename = round(microtime(TRUE)) . '.' . end($temp);
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],  "/public/upload/" . $newfilename)) {
                    $imgUrl = $newfilename;
                    //Supprimer l'ancien fichier
                    try {
                        $q = $pdo->prepare("SELECT imgUrl from hikes WHERE id = $_GET[id]");
                        $q->execute();
                    }
                    catch (Exception $e) {
                        echo $e->getMessage();
                        exit;
                    }
                    $img = $q->fetchAll(PDO::FETCH_ASSOC);
                    $lastPicture = $img[0]['imgUrl'];
                    $fichier = "upload/'.$lastPicture.'";
                    if (file_exists($fichier)) {
                        unlink($fichier);
                    }
                }
                else {
                    echo "Sorry, there was an error uploading your file.";
                    exit();
                }
            }
            
            //On execute l'insertion dans la bdd
            $stmt->execute();
            
            //On défini le message à afficher
            $message = "Hike updated successfully. Redirection...";
            include_once 'messages.php';
            //Redirection vers home après 2 secondes
            header("Refresh: 2;URL=my_hikes");
            exit();
        }
    }
    */
    public function updateHikes()
    {
    
        $imgName = $_FILES['fileToUpload']['name'];
        $imgSize = $_FILES['fileToUpload']['size'];
        $tmpName = $_FILES['fileToUpload']['tmp_name'];
        $imgEx = pathinfo($imgName, PATHINFO_EXTENSION);
        $allowedEx = ['jpg', 'png', 'jpeg', 'gif'];
    
        var_dump($_FILES['fileToUpload']['size']);
        var_dump($imgEx);
        if (in_array($imgEx, $allowedEx)) {
            $newName = round(microtime(TRUE)) . '.' . $imgEx;
            $destination_path = getcwd() . DIRECTORY_SEPARATOR;
            $imgPath = $destination_path . 'upload/' . $newName;
            move_uploaded_file($tmpName, $imgPath);
            var_dump($imgPath);
            /*

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
            */
        }
        else {
            echo 'error';
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
    
}