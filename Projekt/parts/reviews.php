<?php
include_once "functions.php";

use ukf\Review;

$reviewObj = new Review();

$review = $reviewObj->getReviewData("header");
?>

<section class="about-section section-padding" id="section_2">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-12 mx-auto">
                <div class="pb-5 mb-5">
                    <div class="section-title-wrap mb-4">
                        <h4 class="section-title">Quotes</h4>
                    </div>

                    <?php $reviewObj->printReview($review); ?>




                </div>
            </div>


        </div>
    </div>
</section>