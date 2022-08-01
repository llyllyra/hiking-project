<?php
include_once 'inc/header.inc.php';
require_once 'core/db.php';

try {
    $q = $pdo->prepare("SELECT * from hikes WHERE id = $_GET[id]");
    $q->execute();
}   catch(Exception $e) {
    echo $e->getMessage();
    exit;
}
$hikes = $q->fetchAll(PDO::FETCH_ASSOC);
foreach ($hikes as $hike):

//On vérifie que la rando appartienne à l'utilisateur
if ($hike['user_Id'] == $_SESSION['user_id']){
?>
<section id="register">
    <h2>Do you really want to delete this hike ?</h2>
</section>
<button type="button" class="btn btn-secondary">YES</button>
<button type="button" class="btn btn-danger">NO</button>

<?php
}
endforeach;
include_once 'inc/footer.inc.php'; ?>