<?php
include 'adatbazis.php';
$db = new Database();
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Próba</title>
        <link href="kozos/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="kozos/sajat.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <header class="container">
                <div class="row">
                    <div class="col-12">
                        <img class="w-100" src="img/fejlec.png"/>

                    </div>
                </div>
            </header>
            <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">Kiránduló helyek</a>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

                        <form class="d-flex ml-auto">
                            <input class="form-control me-2" type="search" placeholder="" aria-label="Search">
                            <button class="btn btn-outline-light ml-1" type="submit">Keresés</button>
                        </form>
                        <a class="btn btn-outline-light ml-1" href="#">Bejelentkezés </a>
                    </div>
                </div>
            </nav>

