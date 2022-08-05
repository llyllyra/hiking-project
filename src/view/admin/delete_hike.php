<?php
include_once '../view/inc/header.inc.php';
require_once 'model/Hikes.php';

$sql = new Hikes();
$hikes= $sql->getDelHike($_GET['id']);
foreach ($hikes as $hike):
//On vérifie que la rando appartienne à l'utilisateur
    if ($hike['user_Id'] == $_SESSION['user_id'] || $_SESSION['role'] === 'admin') {
        ?>
        <section id="register">
            <h2>Do you really want to delete this hike ?</h2>
            <form action="deleteOneHike">
                <button name="id" value="<?= $hike["id"] ?>">Yes</button>
            </form>
            <a href="my_hikes">Retour en arrière</a>
        </section>
        <?php
    }
endforeach;
include_once '../view/inc/footer.inc.php';