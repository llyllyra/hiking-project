<?php
require_once 'core/db.php';

try {
    $d = $pdo->prepare("DELETE FROM `hikes` WHERE id = :id");
    $d->bindParam('id', $id);
    $id = $_GET["id"];
    $d->execute();
    $message = "vous avez bien effacé la randonnée";
    require_once "../view/messages.php";
    header('Refresh: 2, url=my_hikes');
    exit();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit;
}