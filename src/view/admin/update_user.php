<?php
include_once '../view/inc/header.inc.php';
require_once 'core/db.php';
require_once 'model/Sql.php';

$sql = new Sql();
$user = $sql->getUser($_GET['id']);
    if ($_GET['id'] == $_GET['id']){
        ?>
        <section id="register">
            <h2>Update user</h2>
            <form method="post" action="user?page=update_user" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder=<?=$user['email'];?> required>
        </div>
        <div class="mb-3">
            <label for="RexampleInputEmail1" class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" aria-describedby="firstnameHelp" placeholder="<?=$user['firstName'];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" aria-describedby="lastnameHelp" placeholder="<?=$user['lastName'];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Login name</label>
            <input type="text" name="login_name" class="form-control" aria-describedby="loginHelp" placeholder="<?=$user['nickname'];?>" required>
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>   
        </section>
        <?php
    }
include_once '../view/inc/footer.inc.php';