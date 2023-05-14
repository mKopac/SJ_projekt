<?php
include_once "functions.php";

use ukf\Cast;

$castObj = new Cast();

$cast = $castObj->getCastData("header");

?>



<div class="col-lg-12 col-12">
    <div class="section-title-wrap mb-5">
        <h4 class="section-title">Characters and cast</h4>
    </div>
</div>

<div class="owl-carousel owl-theme">

    <?php $castObj->printCast($cast); ?>

</div>