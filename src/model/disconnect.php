<?php 
//Suppression de la session utilisateur
session_unset();
session_destroy();
//Redirection vers home après 2 secondes
header ("Refresh: 2;URL=home");
exit();
?>