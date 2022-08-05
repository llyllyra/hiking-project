<?php
require_once 'model/Register.php';

$sql = new Register();

$sql->registers($_POST['email']);

