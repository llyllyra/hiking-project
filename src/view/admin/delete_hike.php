<?php
include_once '../view/inc/header.inc.php';
require_once 'model/Sql.php';

$sql = new Sql();
$hikes= $sql->getDelHike($_GET['id']);
foreach ($hikes as $hike):
//On vérifie que la rando appartienne à l'utilisateur
    if ($hike['user_Id'] == $_SESSION['user_id']) {
        ?>
        <section id="register">
            <h2>Do you really want to delete this hike ?<br /><?= $hike['name'] ?></h2>
            <div class="action">
                <form action="deleteOneHike">
                    <button name="id" value="<?= $hike["id"] ?>" class="btn btn-success">Yes</button>
                </form>
                <form action="my_hikes">
                    <button class="btn btn-danger">Non</button>
                </form>
            </div>
        </section>
        <?php
    }
endforeach;
include_once '../view/inc/footer.inc.php';