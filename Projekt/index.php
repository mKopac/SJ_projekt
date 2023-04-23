<!doctype html>
<html lang="en">
<?php
include_once "parts/header.php"
?>

<body>
<?php
include_once "parts/nav.php";
?>
<main>


    <section class="hero-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">
                    <div class="text-center mb-5 pb-2">
                        <h1 class="text-white">Listen to Pod Talk</h1>

                        <p class="text-white">Listen it everywhere. Explore your fav podcasts.</p>

                        <a href="#section_2" class="btn custom-btn smoothscroll mt-3">Start listening</a>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <?php
    include_once "parts/latest_episodes.php";
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
