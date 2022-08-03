<?php
require_once 'model/Sql.php';

$sql = new Sql();
$sql->connexion();    //il faut une verification si le compte est actif ou pas     ici ou dans le sql