<?php
$routes = [
    // Routes de la méthode GET (typiquement afficher une page)
    'GET' => [
        '/' => '../view/homepage.php',
        '/home' => '../view/homepage.php',
        '/error' => '../view/error.php',
        '/about' => '../view/about.php',
        '/add_hike' => '../view/admin/add_hike.php',
        '/my_hikes' => '../view/admin/my_hikes.php',
        '/update_hike' => '../view/admin/update_hike.php',
        '/delete_hike' => '../view/admin/delete_hike.php',
        '/hike' => '../view/hike.php',
        '/test' => '../controller/test.php',
        '/user' => '../controller/user.php',
        '/deleteOneHike' => '../controller/admin/deleteHike.php',
        '/disconnect' => '../view/admin/logout.php',
        '/login' => '../view/admin/login.php',
        '/account' => '../view/admin/account.php',
        '/admin' => '../controller/admin/admin.php',
        '/mail' => '../controller/email.php'
    ],
    // Routes de la méthode POST
    'POST' => [
        '/user' => '../controller/user.php',
        '/login_submit' => '../view/admin/login.php',
        '/add_hike' => '../controller/admin/addHikes.php',
        '/admin' => '../controller/admin/admin.php',
        '/update' => '../controller/admin/updateHikes.php',
        '/connexion' => '../controller/admin/connexion.php'
        
    ],
];