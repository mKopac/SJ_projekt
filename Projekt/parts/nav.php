<?php
include_once "functions.php";

use ukf\Menu;

$menuObj = new Menu();

$menu = $menuObj->getMenuData("header");
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand me-lg-5 me-0" href="<?php echo $menu['home']['path']; ?>">
            <!--<a class="navbar-brand me-lg-5 me-0" href="index.php">-->
            <img src="/images/others/logo.jpg" class="logo-image img-fluid" alt="NAZOV">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-lg-auto">
                <?php $menuObj->printMenu($menu); ?>
            </ul>


        </div>
    </div>
</nav>