<?php


try {
    $d = $pdo->prepare("DELETE FROM `hikes` WHERE id = $_GET[id]");
    $d->execute();
    header('Location: home');
    exit();
}
catch (Exception $e) {
    echo $e->getMessage();
    exit;
}