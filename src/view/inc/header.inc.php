<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.min.css">

    <title>Hiking APP</title>
</head>
<body>


<header>
    <div>
        <h1>Hiking APP</h1>
    </div>
    <nav class="navbar" style="background-color: #e3f2fd;">
    <ul>
        <li><a href="/home" alt="home">HOME</a></li>
        <li><a href="/about" alt="about">ABOUT</a></li>
        <?php if (!isset($_SESSION['user_id'])) { ?>
        <li><a href="/register" alt="register">REGISTER</a></li>
        <li><a href="/login" alt="login">LOGIN</a></li>
        <?php }
        else { ?>
        <li><a href="/my_hikes">MY HIKES</a></li>
        <li><a href="/add_hike">ADD HIKE</a></li>
        <li><a href="/add_hike">MY ACCOUNT</a></li>
        <li><a href="/disconnect">DISCONNECT</a></li>
        <?php } ?>
    </ul>
    </nav>
</header>
