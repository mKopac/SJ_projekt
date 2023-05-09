<!doctype html>
<html lang="en">
<?php
include_once "parts/header.php"
?>

<body>


<?php
include_once "parts/nav.php";
?>


<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center">

                <h2 class="mb-0">Detail Page</h2>
            </div>

        </div>
    </div>
</header>


<section class="latest-podcast-section section-padding pb-0" id="section_2">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-10 col-12">


                <div class="row">
                    <div class="col-lg-3 col-12">
                        <div class="custom-block-icon-wrap">
                            <div class="custom-block-image-wrap custom-block-image-detail-page">
                                <img src="images/episodes/gfa.JPG" class="custom-block-image img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-12">
                        <div class="custom-block-info">
                            <div class="custom-block-top d-flex mb-1">
                                <small class="me-4">
                                    <a href="#">
                                        <i class="bi-play"></i>
                                        Play now
                                    </a>
                                </small>

                                <small>
                                    <i class="bi-clock-fill custom-icon"></i>
                                    119 Minutes
                                </small>


                                <small class="ms-auto">S11E16
                            </div>

                            <p>
                                Directed by Alan Alda
                                <br>
                                Written by: Alan Alda, Burt Metcalfe, John Rappaport
                            </p>

                            <h2 class="mb-2">Goodbye, Farewell and Amen</h2>

                            <p>
                                In the closing days of the Korean War, the staff of the 4077 MASH Unit find
                                themselves facing irrevocable changes in their lives. Hawkeye has been
                                temporarily institutionalized due to a nervous breakdown, Winchester has
                                finally found people who share his taste in classical music and Father
                                Mulcahy has been permanently deafened in a mortar attack. At last, the
                                ceasefire is declared and the staff must come to grips with the fact that
                                this time in their lives is over.
                            </p>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include_once "parts/reviews.php";
?>

<?php
include_once "parts/trending_episodes.php";
?>
</main>


<?php
include_once "parts/footer.php";
?>


<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
