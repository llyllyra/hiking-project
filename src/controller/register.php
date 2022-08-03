<?php
require_once 'model/Register.php';
require_once 'model/Sql.php';

$sql = new Register();

$sql->register($_POST['email']);



