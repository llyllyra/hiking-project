<?php

declare(strict_types=1);

require_once 'dbconnect.php';
require_once('../core/db.php');

class Tag extends Dbconnect
{

    // Afficher la list des tags
    public function getTag(): array
    {
        $pdo = $this->getConnection();
        try {
            $q = $pdo->prepare("SELECT * FROM tags");
            $q->execute();
            } catch (Exception $e) {
            echo $e->getMessage();
            exit; 
        }

        $tags = $q->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

    // Récupérer les tags d'une rando
    public function getTagByHike(): array
    {
        $pdo = $this->getConnection();
        try {
            $q = $pdo->prepare("SELECT * FROM hikesTag WHERE hike_id = $_GET[id]");
            $q->execute();
            } catch (Exception $e) {
            echo $e->getMessage();
            exit; 
        }

        $tags = $q->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

    // Afficher la list des tags  par id
    public function getTagById(): array
    {
        $pdo = $this->getConnection();
        try {
            $q = $pdo->prepare("SELECT * from tags WHERE id = $_GET[id]");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $tag = $q->fetchAll(PDO::FETCH_ASSOC);
        return $tag;
    }

    //Ajouter des tags
    public function addTags():void
    {
        $pdo = $this->getConnection();
        $stmt = $pdo->prepare("INSERT INTO tags (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);

        // insertion d'une ligne
        $name = $_POST['tag'];

        $stmt->execute();

        $message = "Tag added successfully";
        require_once "../view/messages.php";
        header('Refresh: 2, url=admin?page=tags');
        exit();
    }

   //Ajout de tags dans la table hikesTag
    public function addTagHike() : void
    {
        for ($i = 0; $i < count($_POST["tags"]); $i++) {
            $queryHikes = "SELECT MAX(id) AS id FROM hikes";
            $qhikes = $this->connection()->prepare($queryHikes);
            $qhikes->execute();
            $hikes = $qhikes->fetchAll(PDO::FETCH_ASSOC);
            foreach ($hikes as $row):
                $hike = $row['id'];
            endforeach;
            $tag = $_POST['tags'][$i];
            $query = 'INSERT INTO `hikesTag`(`hike_id`, `tag_id`) VALUES (?,?)';
            $taghike = $this->connection()->prepare($query);
            $taghike->execute([$hike, $tag]);

        }

    }

    //Editer des tags
    public function editTags(int $id):void
    {
        $pdo = $this->getConnection();
        $stmt = $pdo->prepare("UPDATE tags SET name = :name WHERE id = $id");
        $stmt->bindParam(':name', $name);

        // insertion d'une ligne
        $name = $_POST['tag'];

        $stmt->execute();

        $message = "Tag updated successfully";
        require_once "../view/messages.php";
        header('Refresh: 2, url=admin?page=tags');
        exit();
    }

    //Supprimer un tag
    public function deleteTag():void
    {
        $pdo = $this->getConnection();
        try {
            $d = $pdo->prepare("DELETE FROM tags WHERE id = :id");
            $d->bindParam('id', $id);
            $id = $_GET["id"];
            $d->execute();
            $message = "Tag deleted successfully";
            require_once "../view/messages.php";
            header('Refresh: 2, url=admin?page=tags');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}