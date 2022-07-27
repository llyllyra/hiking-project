<?php 
include_once 'inc/header.inc.php'; 

// on teste la déclaration de nos variables
if (isset($_POST['email']) && isset($_POST['password'])) {
    require_once '../core/Db.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    //Récupérer les données de l'utilisateur
    $req = $pdo->prepare("SELECT * FROM user WHERE email = '$email'");
    $req->execute();
 

    foreach ($req as $row) {

        if (!password_verify($password, $row['password'])) { 
            //Redicrection
            header('Location: wrong_password');
            exit();
         }
         else {
            //Définition de la session utilisateur
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nickname'] = $row['nickame'];
            $_SESSION['role'] = $row['role'];
            //Redicrection
            header('Location: home');
            exit();
         }
    }

}
else {
    echo "Une erreur s'est produite, veuillez réessayer.";
}
?>

<section id="register">
    <h2>Login</h2>
    <form method="post" action="login_submit" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email address" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>     
    </form>
</section>