<?php
declare(strict_types = 1);

//Connection à la base de donnée
require_once '../model/dbconnect.php';

//Si _GET[page] n'existe pas => erreur  404
if(!isset($_GET['page'])) {
    require_once '../view/error.php';
    exit();
}

//En fonction de _GET[page] on récupère le model et la view
$page = $_GET['page'];
switch ($page) {
    case 'disconnect':
        require_once '../model/disconnect.php';
        require_once '../view/messages.php';     
        break;
    case 'login':
        require_once '../model/Login.php';
        require_once '../view/login.php';
        break;
    case 'Inscription':
        require_once '../model/Inscription.php';
        require_once '../view/register.php';
        break;

}