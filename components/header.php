<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");

    $message = new Message($BASE_URL);
    $flassMessage = $message->getMessage();
    if(!empty($flassMessage["msg"])){
        $message->clearMessage();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoovieStar</title>
    <link rel="shortcut icon" href="<?= $BASE_URL ?>img/moviestar.ico" type="image/x-icon">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.js" integrity="sha512-lsA4IzLaXH0A+uH6JQTuz6DbhqxmVygrWv1CpC/s5vGyMqlnP0y+RYt65vKxbaVq+H6OzbbRtxzf+Zbj20alGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.css" integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg" id="main-navbar">
            <a href="<?= $BASE_URL ?>" class="navbar-brand">
                <img src="<?= $BASE_URL ?>img/logo.svg" class="logo" alt="">
                <span class="moviestar-title">MoovieStar</span>
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" type="button">
                <i class="fas fa-bars"></i>
            </button>
            <form action="" method="get" class="d-flex my-2 my-lg-0" id="search-form">
                <input type="text" name="q" id="search" class="form-control me-sm-2" placeholder="Buscar filmes" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Entrar / Cadastrar</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php if(!empty($flassMessage["msg"])) : ?>
        <div class="msg-container">
            <p class="msg <?= $flassMessage["type"]?>"><?= $flassMessage["msg"]?></p>
        </div>
    <?php endif ?>