<?php
include_once "functions.php";

use ukf\Episode;

$episodeObj = new Episode();

$episode = $episodeObj->getEpisodeData("header");

?>


<section class="trending-podcast-section section-padding pt-0">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12">
                <div class="section-title-wrap mb-5">
                    <h4 class="section-title">Trending episodes</h4>
                </div>
            </div>



            <div class="owl-carousel owl-theme">
                <?php $episodeObj->printEpisode($episode); ?>
            </div>









        </div>
    </div>
</section>
