<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/dashboard' => '../controller/admin.php',
        '/error' => '../view/error.php',
        '/about' => '../view/about.php',
        '/add_hike' => '../view/add_hike.php',
        '/my_hikes' => '../view/my_hikes.php',
        '/update_hike' => '../view/update_hike.php',
        '/delete_hike' => '../view/delete_hike.php',
        '/hike' => '../view/hike.php',
        '/user' => '../controller/user.php',
        '/test' => '../controller/test.php',

    ],
    // Routes de la méthode POST
    'POST' => [
        '/user' => '../controller/user.php',
        '/login_submit' => '../view/login.php',
        '/add_hike' => '../view/add_hike.php',
    ],
];