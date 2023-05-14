<?php
include_once "../functions.php";

use ukf\Menu;

$menuObj = new Menu("localhost", 3306, "root", "", "sj-2023");

if(isset($_GET['id'])) {
    $delete = $menuObj->deleteMenuItem($_GET['id']);
    if($delete) {
        header('Location: menu.php?status=1');
    } else {
        echo "Error";
    }
} else {
    header('Location: menu.php');
}