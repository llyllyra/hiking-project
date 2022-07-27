<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/register' => '../view/register.php',
        '/register_submit' => '../view/register.php',
        '/login' => '../view/login.php',
        '/dashboard' => '../view/admin/dashboard.php',
        '/error' => '../view/error.php',
        '/about' => '../view/about.php',
        '/disconnect' => '../view/logout.php',
        '/add_hike' => '../view/add_hike.php',
        '/my_hikes' => '../view/my_hikes.php',
        '/my_account' => '../view/account.php',

    ],
    // Routes de la méthode POST
    'POST' => [
        '/register_submit' => '../view/register.php',
        '/login_submit' => '../view/login.php',
    ],
];