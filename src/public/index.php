<?php
session_start();
// On importe les différents fichiers requis
require_once 'core/request.php';
require_once 'core/router.php';
require_once 'controller/routes.php';

// On utilise les méthodes statiques de la classe Request (pas besoin de l'instancier)
$uri = Request::uri();
$method = Request::method();

// On instancie l'object $router
$router = new Router();

// On utilise la méthode Inscription() pour stocker les routes du fichier routes.php dans
// la propriété $routes du routeur.
$router->register($routes);

// On fait le routing en tant que tel : sur base de l'uri et de la méthode, on va
// require le bon fichier.
$router->direct($uri, $method);