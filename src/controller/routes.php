<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/register' => '../view/register.php',
        '/register_submit' => '../view/register.php',
        '/login' => '../view/login.php',
        '/dashboard' => '../controller/admin.php',
        '/error' => '../view/error.php',
        '/about' => '../view/about.php',
        '/disconnect' => '../view/logout.php',
        '/add_hike' => '../view/add_hike.php',
        '/my_hikes' => '../view/my_hikes.php',
        '/my_account' => '../view/account.php',
        '/update_hike' => '../view/update_hike.php',
        '/delete_hike' => '../view/delete_hike.php',
        '/hike' => '../view/hike.php',
        '/user' => '../controller/user.php',

    ],
    // Routes de la méthode POST
    'POST' => [
        '/register_submit' => '../view/register.php',
        '/login_submit' => '../view/login.php',
        '/add_hike' => '../view/add_hike.php',
    ],
];