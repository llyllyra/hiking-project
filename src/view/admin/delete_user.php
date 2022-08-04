<?php
include_once '../view/inc/header.inc.php';
require_once 'model/User.php';

$sql = new User();
$user= $sql->delUser($_GET['id']);
//On vérifie que la rando appartienne à l'utilisateur
    if ($user['user_Id'] == $_SESSION['user_id']) {
        ?>
        <section id="register">
            <h2>Do you really want to delete this user <?= $user['name'] ?> ?</h2>
            <form action="deleteOneuser">
                <button name="id" value="<?= $user["id"] ?>">Yes</button>
            </form>
        </section>
        <?php
    }

include_once '../view/inc/footer.inc.php';