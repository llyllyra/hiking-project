<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/dashboard' => '../controller/admin/admin.php',
        '/error' => '../view/error.php',
        '/about' => '../view/about.php',
        '/about' => '../view/about.php',
        '/add_hike' => '../view/admin/add_hike.php',
        '/my_hikes' => '../view/admin/my_hikes.php',
        '/update_hike' => '../view/update_hike.php',
        '/delete_hike' => '../view/admin/delete_hike.php',
        '/hike' => '../view/hike.php',
        '/test' => '../controller/test.php',
        '/user' => '../controller/user.php',
        '/deleteOneHike' => '../controller/admin/deleteHike.php',
        '/disconnect' => '../view/admin/logout.php',
        '/login' => '../view/admin/login.php',
        '/account' => '../view/admin/account.php'
    ],
    // Routes de la méthode POST
    'POST' => [
        '/user' => '../controller/user.php',
        '/login_submit' => '../view/admin/login.php',
        '/add_hike' => '../controller/admin/addHikes.php',
        
    ],
];