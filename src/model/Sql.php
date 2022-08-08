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

    //afficher toutes les randonnées
    public function getHikes(): array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT * FROM hikes");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getHikesAdmin(): array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT *, u.nickname, h.id AS hikeId FROM hikes h JOIN user u ON u.id = h.user_Id ORDER BY hikeId");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afficher les randonnée par id
    public function getHikeById(int $id): array
    {
        $pdo = $this->connection();

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

    // Afficher les randonnée par id user
    public function getHikeByUser(int $id): array
    {
        $pdo = $this->connection();

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

    // Afficher les randonnée par id pour l'effacer
    public function getDelHike($id): array
    {
        $pdo = $this->connection();
        try {
            $q = $pdo->prepare("SELECT name, user_Id, id from hikes WHERE id = $_GET[id]");
            $q->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
        return $hikes = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    // Afficher la list des tags
    public function getTag(): array
    {
        $pdo = $this->connection();
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


    // Afficher la list des tags
    public function getTagById(): array
    {
        $pdo = $this->connection();
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



    //ajout

    //Ajout d'une randonnée
    public function addHikes()
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
        $user = $_SESSION['user_id'];

        $stmt->execute();


        //Ajout des tags personnalisés
        if (isset($_POST['custom_tags'])){
            $tagArray = explode(",", $_POST['custom_tags']);
            foreach($tagArray as $tag){
                $stmt = $pdo->prepare("INSERT INTO tags (name) VALUES (:tag)");
                $stmt->bindParam(':tag', $tag);
                $stmt->execute();
            }
        }

        $this->addTagHike();
        $message = "vous avez bien ajouter la randonnée";
        require_once "../view/messages.php";
        header('Refresh: 2, url=my_hikes');
        exit();
    }

    //Ajout d'un utilisateur
    public function addUser()
    {
        $pdo = $this->connection();

    }

    //Ajouter des tags
    public function addTags()
    {
        $pdo = $this->connection();
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

    public function addTagHike()
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

    //modification

    //edit la randonnée

    public function updateHikes()
    {
        $pdo = $this->connection();
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

        //edit user par l'user

        public function updateUserByUser()
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
                                email= :email,
                                password= :password,
                            WHERE id = $_GET[id]"
                );
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
    
    
                // insertion d'une ligne
                $firstName = $_POST['first_name'];
                $lastName = $_POST['last_name'];
                $login = $_POST['login_name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                //On execute l'insertion dans la bdd
                $stmt->execute();
                //On défini le message à afficher
                $message = "Updated successfully. Redirection...";
                require_once "../view/messages.php";
                //Redirection vers home après 2 secondes
                header("Refresh: 2;URL=viewUser");
                exit();
    
            } else {
                echo 'error';
            }
        }

    //Editer des tags
    public function editTags($id)
    {
        $pdo = $this->connection();
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



    // delete

    // delete Randonnée
    public function delHikes()
    {
        $pdo = $this->connection();
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

    // delete user

    public function delUser()
    {
        $pdo = $this->connection();
        try {
            $d = $pdo->prepare("DELETE FROM user WHERE id = :id");
            $d->bindParam('id', $id);
            $id = $_GET["id"];
            $d->execute();
            $message = "vous avez bien effacé l'utilisateur";
            require_once "../view/messages.php";
            header('Refresh: 2, url=viewUser');
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    //Supprimer un tag
    public function deleteTag()
    {
        $pdo = $this->connection();
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

    // Connexion



}