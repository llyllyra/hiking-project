<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/register' => '../view/Register.php',
        '/register_submit' => '../view/Register.php',
        '/login' => '../view/Login.php',
        '/dashboard' => '../view/dashboard.php',
    ],
    // Routes de la méthode POST
    'POST' => [
        '/register_submit' => '../view/Register.php',
        '/login_submit' => '../view/Login.php',
    ],
];