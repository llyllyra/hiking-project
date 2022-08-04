<?php
include_once '../view/inc/header.inc.php';
require_once 'model/User.php';

$sql = new User();
$users = $sql->getUserById($_GET['id']);
foreach ($users as $user)     :
    if ($_GET['id'] == $_GET['id']){
        ?>
        <section id="register">
            <h2>Update user</h2>
            <form method="post" action="updateUser?id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="RexampleInputEmail1" class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" aria-describedby="firstnameHelp" value="<?=$user['firstName'];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" aria-describedby="lastnameHelp" value="<?=$user['lastName'];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Login name</label>
            <input type="text" name="login_name" class="form-control" aria-describedby="loginHelp" value="<?=$user['nickname'];?>" required>
        </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">role</label>
                    <select name="role" class="form-select" aria-label="role">
                        <option selected><?=$user['role'];?></option>
                        <option value="admin">admin</option>
                        <option value="moderateur">moderateur</option>
                        <option value="user">user</option>
                    </select>
                </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>   
        </section>
        <?php
    }
    endforeach;
include_once '../view/inc/footer.inc.php';