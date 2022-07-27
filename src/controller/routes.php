<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/register' => '../view/Register.php',
        '/login' => '../view/Login.php',
        '/lost_password' => '../view/lost_password.php',
        '/add_hike' => '../view/add_hike.php',
        '/update_hike' => '../view/update_hike.php',
    ],
    // Routes de la méthode POST
    'POST' => [
        '/register_submit' => '../view/Register.php',
        '/login_submit' => '../view/Login.php',
    ],
];