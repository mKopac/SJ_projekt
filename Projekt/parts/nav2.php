<?php
include_once "functions.php";

$menu = getMenuData("header");
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand me-lg-5 me-0" href="index.html">
            <img src="" class="logo-image img-fluid" alt="templatemo pod talk">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto">
                <!--<li class="nav-item">
                    <a class="nav-link active" href="index.html">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>-->

                <?php printMenu($menu); ?>
            </ul>


        </div>
    </div>
</nav>