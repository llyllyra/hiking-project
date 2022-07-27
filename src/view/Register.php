<?php 
include_once 'inc/header.inc.php'; 

    // on teste la déclaration de nos variables
if (isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']) &&  isset($_POST['login_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        require_once '../core/Db.php';
        //enregistrer les données dans la base de données
        $stmt = $pdo->prepare("INSERT INTO user (firstName, lastName, nickname, email, password, role) VALUES (:firstname, :lastname, :loginname, :email, :password, :role)");
        $stmt->bindParam(':firstname', $firstName);
        $stmt->bindParam(':lastname', $lastName);
        $stmt->bindParam(':loginname', $loginName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
    
        // insertion d'une ligne
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $loginName = $_POST['login_name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = "user";
        var_dump($firstName,$lastName,$loginName,$email,$password,$role);
        $stmt->execute();
    
        //Redicrection
        header('Location: home');
        exit();
    } else {
        ?>
            <div class="box_container"><div class="wrong_box">Adresse email invalide. <br /><a href="<?php echo "$_SERVER[HTTP_REFERER]"; ?>">Retour</a></div></div>
        <?php
    }
//Si les champs ne sont pas tous remplis    
}
else {
    echo "Veuillez remplir tous les champs";
}

?>

<section id="register">
    <h2>Register</h2>
    <form method="post" action="register_submit" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" aria-describedby="firstnameHelp" placeholder="Enter your first name" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" aria-describedby="lastnameHelp" placeholder="Enter your last name" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Login name</label>
            <input type="text" name="login_name" class="form-control" aria-describedby="loginHelp" placeholder="Choose your login name" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password confirmation</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Please confirm your password" required>
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>     
    </form>
</section>
<?php include_once 'inc/footer.inc.php'; ?>