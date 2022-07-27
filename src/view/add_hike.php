<?php 
include_once 'inc/header.inc.php'; 

//Si l'utilisateur n'est pas connecté : message d'erreur / Exit
if(!isset($_SESSION['user_id'])) {
    echo 'Veuillez vous connecter';
    exit();
}
// on teste la déclaration de nos variables
if (isset($_POST['name']) && isset($_POST['departure']) && isset($_POST['arrive']) &&  isset($_POST['login_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        require_once '../core/db.php';
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
    <h2>Add hike</h2>
    <form method="post" action="hike_submit" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="name" placeholder="Enter the name of your hike" required>
        </div>
        <div class="mb-3">
            <label for="departure" class="form-label">Departure</label>
            <input type="text" name="departure" class="form-control" aria-describedby="departure" placeholder="Enter departure point" required>
        </div>
        <div class="mb-3">
            <label for="arrive" class="form-label">Arrive</label>
            <input type="text" name="arrive" class="form-control" aria-describedby="arrive" placeholder="Enter arrived point" required>
        </div>
        <div class="mb-3">
            <label for="difficulty" class="form-label">Difficulty</label>
            <select class="form-select" aria-label="difficulty">
                <option selected>Open this select menu</option>
                <option value="1">Very easy</option>
                <option value="2">Easy</option>
                <option value="3">Medium</option>
                <option value="4">Hard</option>
                <option value="5">Very hard</option>
                <option value="6">Only for warriors</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Distance</label>
            <input type="text" name="distance" class="form-control" aria-describedby="firstnameHelp" placeholder="Enter distance" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Duration</label>
            <input type="text" name="duration" class="form-control" aria-describedby="lastnameHelp" placeholder="Enter duration" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Elevation gain</label>
            <input type="text" name="elevation_gain" class="form-control" aria-describedby="loginHelp" placeholder="Enter elevation gain" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description</label>
            <textarea class="form-control" aria-label="With textarea" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tags</label>
            <textarea class="form-control" aria-label="With textarea" name="tags"></textarea>
        </div>
        <div class="btn_box">
        <button type="submit" class="btn btn-success" name="register">Submit</button>
        </div>     
    </form>
</section>
<?php include_once 'inc/footer.inc.php'; ?>