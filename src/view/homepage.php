<?php
 include_once 'inc/header.inc.php';
require_once 'core/Db.php';

try {
    $q = $pdo->prepare("SELECT name from hikes");
    $q->execute();
}   catch(Exception $e) {
    echo $e->getMessage();
    exit;
}
$hikes = $q->fetchAll(PDO::FETCH_ASSOC);
foreach ($hikes as $hike):
    ?>
    <p><?php echo $hike['name'] ?></p>
<?php
endforeach;
