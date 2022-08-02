<?php
include_once '../view/inc/header.inc.php';
require_once 'core/db.php';
require_once 'model/Sql.php';
//Si l'utilisateur n'est pas connecté : message d'erreur / Exit
if (!isset($_SESSION['user_id'])) {
    echo 'Veuillez vous connecter';
    exit();
}

$sql = new Sql();
$hikes = $sql->getHikeById($_GET["id"]);

foreach ($hikes as $hike):

//On vérifie que la rando appartienne à l'utilisateur
    if ($hike['user_Id'] == $_SESSION['user_id'] || $_SESSION['role'] === "admin"){
        ?>
        <section id="register">
            <h2>Update hike</h2>
            <form method="post" action="update?id=<?=$hike['id']?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" aria-describedby="emailHelp" value="<?=$hike['name'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departure</label>
                    <input type="text" name="departure" class="form-control" aria-describedby="firstnameHelp" value="<?=$hike['departure'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Arrive</label>
                    <input type="text" name="arrive" class="form-control" aria-describedby="firstnameHelp" value="<?=$hike['arrive'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="difficulty" class="form-label">Difficulty</label>
                    <select name="difficulty" class="form-select" aria-label="difficulty">
                        <option selected><?=$hike['difficulty'];?></option>
                        <option value="Very easy">Very easy</option>
                        <option value="Easy">Easy</option>
                        <option value="Medium">Medium</option>
                        <option value="Hard">Hard</option>
                        <option value="Very hard">Very hard</option>
                        <option value="Only for warriors">Only for warriors</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="distance" class="form-label">Distance</label>
                    <input type="text" name="distance" class="form-control" aria-describedby="distance" value="<?=$hike['distance'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control" aria-describedby="duration" value="<?=$hike['duration'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="elevationgain" class="form-label">Elevation gain</label>
                    <input type="text" name="elevationgain" class="form-control" aria-describedby="elevationgain" value="<?=$hike['elevationGain'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Picture</label>
                    <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" aria-label="With textarea" name="description"><?=$hike['description'];?></textarea>
                </div>

                <!-- ajout de tags -->
                <?php
                // reprendre la db car inconnue
                require_once '../core/db.php';
                try {
                    $q = $pdo->prepare("SELECT * from tags");
                    $q->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                    exit;
                }
                $tags = $q->fetchAll(PDO::FETCH_ASSOC);
                foreach ($tags as $tag) :
                    ?>
                    <div class="form-check mb-3">
                        <input name="tags" value="<?= $tag['id']; ?>" class="form-check-input" type="checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= $tag['name']; ?>
                        </label>
                    </div>
                <?php
                endforeach;
                ?>
                <div class="btn_box">
                    <button type="submit" class="btn btn-success" value="<?php $hike['id'] ?>" name="submit">Submit</button>
                </div>
            </form>
        </section>
        <?php
    }
endforeach;
include_once '../view/inc/footer.inc.php';