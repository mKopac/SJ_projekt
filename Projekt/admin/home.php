<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Menu;
use ukf\Review;


?>
    <a href="logout.php">Logout</a>
    <a href=""
<?php


$menuObj = new Menu("localhost", 3306, "root", "", "sj-2023");
$menu = $menuObj->getMenuData('header');


if (isset($_POST['submit'])) {
    $insert = $menuObj->insertMenuItem($_POST['sys_name'], $_POST['user_name'], $_POST['path']);
    if ($insert) {
        header('Location: home.php');
    } else {
        echo "Error";
    }
} else {

    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<strong>Deleted correctly</strong>";
    }

    echo "<br><br><ul>";
    echo "MENU";

    foreach ($menu as $sysName => $menuItem) {
        echo "<li>
            Sys name: " . $sysName . ", 
            User name: " . $menuItem['name'] . ", 
            URL: " . $menuItem['path'] . "
            <a href='deletemenu.php?id=" . $menuItem['id'] . "'>Delete</a>
            <a href='updatemenu.php?id=" . $menuItem['id'] . "'>Update</a>
            </li>";
    }

    echo "</ul>";
    ?>

    <form action="home.php" method="post">
        System name:<br>
        <input type="text" name="sys_name" value="" placeholder="System name"><br>
        User name:<br>
        <input type="text" name="user_name" value="" placeholder="User name"><br>
        Path:<br>
        <input type="text" name="path" value="" placeholder="URL"><br>
        <input type="submit" name="submit" value="Insert">
    </form>
    <hr>
    <?php
}

$reviewObj = new Review("localhost", 3306, "root", "", "sj-2023");
$review = $reviewObj->getReviewData('header');


if (isset($_POST['submit'])) {
    $insert = $reviewObj->insertReviewItem($_POST['username'], $_POST['nickname'], $_POST['text']);
    if ($insert) {
        header('Location: home.php');
    } else {
        echo "Error";
    }
} else {

    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<strong>Deleted correctly</strong>";
    }

    echo "<br><br><ul>";
    echo "REVIEWS";

    foreach ($review as $username => $reviewItem) {
        echo "<li>
            username: " . $username . ", 
            nickname: " . $reviewItem['nickname'] . ", 
            body: " . $reviewItem['text'] . "
            <a href='deletereview.php?id=" . $reviewItem['id'] . "'>Delete</a>
            <a href='updatereview.php?id=" . $reviewItem['id'] . "'>Update</a>
            </li>";
    }

    echo "</ul>";
    ?>

    <form action="home.php" method="post">
        Username:<br>
        <input type="text" name="username" value="" placeholder="Username"><br>
        Nickname:<br>
        <input type="text" name="nickname" value="" placeholder="Nickname"><br>
        Body:<br>
        <input type="text" name="text" value="" placeholder="Body"><br>
        <input type="submit" name="submit" value="Insert">
    </form>
    <?php
}
?>
