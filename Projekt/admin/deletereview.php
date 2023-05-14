<?php
include_once "../functions.php";

use ukf\Review;

$reviewObj = new Review("localhost", 3306, "root", "", "sj-2023");

if(isset($_GET['id'])) {
    $delete = $reviewObj->deleteReviewItem($_GET['id']);
    if($delete) {
        header('Location: review.php?status=1');
    } else {
        echo "Error";
    }
} else {
    header('Location: review.php');
}