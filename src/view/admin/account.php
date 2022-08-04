<?php
include_once '../view/inc/header.inc.php';
include_once 'model/User.php';

$sql = new user();

$users = $sql->getUserById($_SESSION['user_id']);
?>
<section id="register">
    <h2>MY ACCOUNT</h2>
    <?php
    foreach ($users as $user):
    ?>
    <p>mon prenom : <?= $user['firstName'] ?></p>
    <p>mon nom : <?= $user['lastName'] ?></p>
    <p>mon pseudo : <?= $user['nickname'] ?></p>
    <p>mon email : <?= $user['email'] ?></p>
    <div>
            <a href="updateUser?id=<?=$user['id']?>">
                <div class="btn">Update my account</div>
            </a> 
        </div>
</section>
<?php
endforeach;
include_once '../view/inc/footer.inc.php';