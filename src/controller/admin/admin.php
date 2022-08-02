<?php
require_once 'model/Sql.php';
//Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id']) && !isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    echo 'Error. Not connected';
    exit;
}

if(!isset($_GET['page'])){
    $sql = new Sql();
    $hikes = $sql->getHikes();
    require_once 'view/admin/dashboard.php';
    exit();
}


$page = $_GET['page'];
switch ($page) {
    case 'tags':
        $sql = new Sql();
        $tags = $sql->getTag();
        require_once '../view/admin/tags.php';
        break;
    case 'add_tag':
        $sql = new Sql();
        $tags = $sql->getTag();
        require_once '../view/admin/add_tags.php';
        break;
    case 'edit_tag':
        $sql = new Sql();
        $tag = $sql->getTagById($_GET['id']);
        require_once '../view/admin/edit_tags.php';
        break;
    case 'tag_edited':
        $sql = new Sql();
        $tags = $sql->editTags($_GET['id']);
        break;
    case 'tag_added':
        $sql = new Sql();
        $tags = $sql->addTags();
        break;
    case 'tag_deleted':
        $sql = new Sql();
        $tags = $sql->deleteTag();
        break;
    case 'users':
        echo 'users page';
        break;
}

