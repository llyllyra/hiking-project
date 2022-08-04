<?php
include_once '../view/inc/header.inc.php';
include_once 'model/User.php';

$sql = new user();

$users = $sql->getUserById($_SESSION['user_id']);
foreach ($users as $user):
?>
<p>mon prenom : <?= $user['firstName'] ?></p>
<p>mon nom : <?= $user['lastName'] ?></p>
<p>mon pseudo : <?= $user['nickname'] ?></p>
<p>mon email : <?= $user['email'] ?></p>
<p>mon nom : <?= $user['firstName'] ?></p>

    <a href="updateUser?id=<?=$user['id']?>">modifier mon compte</a>

<?php
endforeach;
include_once '../view/inc/footer.inc.php';