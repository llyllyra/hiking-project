<?php

require_once '../core/dbinfo.php';
require_once 'dbconnect.php';
require_once('Tag.php');

class Hikes extends Dbconnect
{
    //afficher toutes les randonnées
    public function getHikes(): array
    {
        $pdo = $this->getConnection();
        try {
            $q = $pdo->prepare("SELECT * FROM hikes");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    // afficher les randonnée pour l'admin
    public function getHikesAdmin(): array
    {
        $pdo = $this->getConnection();
        try {
            $q = $pdo->prepare("SELECT *, u.nickname, h.id AS hikeId FROM hikes h JOIN user u ON u.id = h.user_Id ORDER BY hikeId");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afficher les randonnées par id
    public function getHikeById(int $id): array
    {
        $pdo = $this->getConnection();

        try {
            $q = $pdo->prepare("SELECT *, user.nickname, date_format(h.createdDate, '%D %M  %Y') as date, h.id AS hikeId
            from hikes h
                inner join user   on user.id = h.user_Id
            WHERE h.id = $_GET[id]");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
        return $hikes;
    }

    // Afficher les randonnées par id user
    public function getHikeByUser(int $id): array
    {
        $pdo = $this->getConnection();

        try {
            $q = $pdo->prepare("SELECT *, h.id as hikeId from hikes h WHERE user_Id = $_SESSION[user_id]");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
        return $hikes;
    }

    // Afficher les randonnées par id pour l'effacer
    public function getDelHike($id): array
    {
        $pdo = $this->getConnection();
        try {
            $q = $pdo->prepare("SELECT name, user_Id, id from hikes WHERE id = $_GET[id]");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    //Ajout d'une randonnée
    public function addHikes()  :void
    {
        $imgName = $_FILES['fileToUpload']['name'];
        $imgSize = $_FILES['fileToUpload']['size'];
        $tmpName = $_FILES['fileToUpload']['tmp_name'];
        $imgEx = pathinfo($imgName, PATHINFO_EXTENSION);
        $allowedEx = ['jpg', 'png', 'jpeg', 'gif'];
        if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
            if (in_array($imgEx, $allowedEx)) {
                $newName = round(microtime(TRUE)) . '.' . $imgEx;
                $destination_path = getcwd() . DIRECTORY_SEPARATOR;
                $imgPath = $destination_path . 'upload/' . $newName;
                move_uploaded_file($tmpName, $imgPath);
                $imgUrl = $newName;
            }
        }
        $pdo = $this->getConnection();

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
        $user = $_SESSION['user_id'];

        $stmt->execute();
        $tag = new Tag();
        $tag->addTagHike();
        $message = "vous avez bien ajouter la randonnée";
        require_once "../view/messages.php";
        header('Refresh: 2, url=my_hikes');
        exit();
    }

    // delete Randonnée
    public function delHikes()
    {
        $pdo = $this->getConnection();
        try {
            $d = $pdo->prepare("DELETE FROM hikes WHERE id = :id");
            $d->bindParam('id', $id);
            $id = $_GET["id"];
            $d->execute();
            $message = "vous avez bien effacé la randonnée";
            require_once "../view/messages.php";
            header('Refresh: 2, url=my_hikes');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

    }

    //edit la randonnée
    public function updateHikes()
    {
        $pdo = $this->getConnection();
        $photo ="a";
        if ($_FILES['fileToUpload']['name'] > 0) {
            $imgName = $_FILES['fileToUpload']['name'];
            $imgSize = $_FILES['fileToUpload']['size'];
            $tmpName = $_FILES['fileToUpload']['tmp_name'];
            $imgEx = pathinfo($imgName, PATHINFO_EXTENSION);
            $allowedEx = ['jpg', 'png', 'jpeg', 'gif'];
            if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
                if (in_array($imgEx, $allowedEx)) {
                    $newName = round(microtime(TRUE)) . '.' . $imgEx;
                    $destination_path = getcwd() . DIRECTORY_SEPARATOR;
                    $imgPath = $destination_path . 'upload/' . $newName;
                    move_uploaded_file($tmpName, $imgPath);
                    $photo = $newName;
                }
            }
        }
        else {
            $p = $pdo->prepare("Select imgUrl from hikes WHERE id = $_GET[id]");
            $p->execute();
            $photos = $p->fetchAll(PDO::FETCH_ASSOC);
            foreach ($photos as $p) {
                $photo = $p['imgUrl'];
            }
        }
        
        
        if (isset($_POST['name']) && isset($_POST['departure']) && isset($_POST['arrive']) && isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['elevationgain']) && isset($_POST['description'])) {
            //enregistrer les données dans la base de données
            $stmt = $pdo->prepare(
                "UPDATE hikes SET name = :name, departure = :departure, arrive = :arrive, difficulty = :difficulty, distance = :distance, duration = :duration, elevationGain = :elevationgain, description = :description,  updateDate = :date, imgUrl = :imgUrl WHERE id = $_GET[id]"
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
            $stmt->bindParam(':imgUrl', $photo);
            
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
            //On execute l'insertion dans la bdd
            $stmt->execute();
            //On défini le message à afficher
            $message = "Hike updated successfully. Redirection...";
            require_once "../view/messages.php";
            //Redirection vers home après 2 secondes
            header("Refresh: 2;URL=my_hikes");
            exit();
            
        } else {
            echo 'error';
        }
    }
}