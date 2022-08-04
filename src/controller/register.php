<?php
require_once 'model/Register.php';

$sql = new Register();

$sql->register($_POST['email']);

