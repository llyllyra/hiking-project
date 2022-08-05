<?php
include_once '../view/inc/header.inc.php';
include_once 'model/user.php';
$sql = new User();
$users = $sql->getUserById($_SESSION['user_id']);
foreach ($users as $user):
?>
<section id="register">
    <h2>MY ACCOUNT</h2>
    <form method="post" action="user?page=account" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" value="<?=$user["email"];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" aria-describedby="firstnameHelp" value="<?= $user["firstName"];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" aria-describedby="lastnameHelp" value="<?=$user["lastName"];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Login name</label>
            <input type="text" name="login_name" class="form-control" aria-describedby="loginHelp" value="<?=$user["nickname"];?>" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="actual_password" placeholder="Enter your actual password" >
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="new_password" placeholder="Enter your new password" >
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password confirmation</label>
            <input type="password" class="form-control" name="confirm_new_password" placeholder="Please confirm new your password" >
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>     
    </form>
</section>
<?php
endforeach;
    
    include_once '../view/inc/footer.inc.php';