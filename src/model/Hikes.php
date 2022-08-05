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
            $q = $pdo->prepare("SELECT *, user.nickname, date_format(h.createdDate, '%D %M  %Y') as date, h.id as hikeId
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

    //Récupérer les tags correspondants à une rando
    public function getTagsByHike(int $hikeId): array
    {
        $pdo = $this->getConnection();

        try {
            $q = $pdo->prepare("SELECT name
            from tags t
                inner join hikesTag h on h.tag_id = t.id
            WHERE h.hike_id = $_GET[id]");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $tags = $q->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

}