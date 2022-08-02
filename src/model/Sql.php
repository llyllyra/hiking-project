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
    public function getHikes():array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT * from hikes");
            $q->execute();
        }   catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Afficher les randonnée par id
    public function getHikeById(int $id) :array
    {
        $pdo =$this->connection();
        
        try {
            $q = $pdo->prepare("SELECT *, user.nickname, date_format(h.createdDate, '%D %M  %Y') as date
                            from hikes h
                                inner join user   on user.id = h.user_Id
                            WHERE h.id = $_GET[id]");
        }
        catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
        return $hikes;
    }
    
    // Afficher les randonnée par id user
    public function getHikeByUser(int $id):array
    {
        $pdo =$this->connection();
        
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
    public function getDelHike($id):array{
        $pdo =$this->connection();
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
    public function getTag() :array{
        $pdo =$this->connection();
        try {
            $q = $pdo->prepare("SELECT * from tags");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        $tags = $q->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }
    
    //ajout
    
    public  function addHikes(){
    $pdo =$this->connection();
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
    
    public function addUser(){
        $pdo =$this->connection();
    }
    
    //modification
    
    
    // delete
    
    public function delHikes(){
        $pdo =$this->connection();
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