<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.min.css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">

    <title>DEV Randonneur</title>
</head>
<body>
<header>
    <div>
        <a href="home">
            <h1>< DEV > Randonneur</h1>
        </a>
    </div>
    <nav>
        <ul class="navbar-item">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
                <li><a href="/admin" alt="admin">ADMIN</a></li>
            <?php } ?>
            <li><a href="/home" alt="home">HOME</a></li>
            <?php if (!isset($_SESSION['user_id'])) { ?>
                <li><a href="/register" alt="register">REGISTER</a></li>
                <li><a href="/login" alt="login">LOGIN</a></li>
            <?php }
            else { ?>
                <li><a href="/my_hikes">MY HIKES</a></li>
                <li><a href="/add_hike">ADD HIKE</a></li>
                <li><a href="/account">MY ACCOUNT</a></li>
                <li><a href="/disconnect">DISCONNECT</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
    <div id="search_bar">
      <div>Marche ou code !</div>
      <div id="search">
        <form method="POST" id="search" action="search">
            <input type="text" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" />
            <button type="submit" class="btn btn-outline-primary" name="submit">search</button>
        </form>
      </div>
    </div>
<main>
    <?php

    
