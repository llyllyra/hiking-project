<?php
require_once '../core/db.php';
 //todo faire la factorisation
//Récupérer les infos de la base de données pour l'utilisateur
try {
    $q = $pdo->prepare("SELECT * from user WHERE id = $_SESSION[user_id]");
    $q->execute();
}   catch(Exception $e) {
    echo $e->getMessage();
    exit;
}
$user = $q->fetchAll(PDO::FETCH_ASSOC);
$email = $user[0]['email'];
$firstName = $user[0]['firstName'];
$lastName = $user[0]['lastName'];
$login = $user[0]['nickname'];







    
// on teste la déclaration de nos variables
if (isset($_POST['email']) && isset($_POST['first_name']) && isset($_POST['last_name']) &&  isset($_POST['login_name']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

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