<?php
include_once '../view/inc/header.inc.php';
require_once 'model/Sql.php';

$sql = new Sql();
$user= $sql->delUser($_GET['id']);
foreach ($user as $user):
//On vérifie que la rando appartienne à l'utilisateur
    if ($user['user_Id'] == $_SESSION['user_id']) {
        ?>
        <section id="register">
            <h2>Do you really want to delete this user <?= $user['name'] ?> ?</h2>
            <form action="deleteOneuser">
                <button name="id" value="<?= $user["id"] ?>">Yes</button>
            </form>
            <a href="my_users">Retour en arrière</a>
        </section>
        <?php
    }
endforeach;
include_once '../view/inc/footer.inc.php';