<?php
include_once "../functions.php";

use ukf\Cast;

$castObj = new Cast("localhost", 3306, "root", "", "sj-2023");

if(isset($_GET['id'])) {
    $delete = $castObj->deleteCastItem($_GET['id']);
    if($delete) {
        header('Location: cast.php?status=1');
    } else {
        echo "Error";
    }
} else {
    header('Location: cast.php');
}