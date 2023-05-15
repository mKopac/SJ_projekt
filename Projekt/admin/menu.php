<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Menu;

?>
    <a href="../index.php">Back</a><br>
    <a href="logout.php">Logout</a><br>
    <a href="home.php">Home</a><br>
    <a href="menu.php">Menu</a><br>
    <a href="review.php">Reviews</a><br>
    <a href="cast.php">Cast</a><br>
    <a href="episode.php">Episodes</a><br>

<?php
$menuObj = new Menu("localhost", 3306, "root", "", "sj-2023");
$menu = $menuObj->getMenuData('header');


if (isset($_POST['submit'])) {
    $insert = $menuObj->insertMenuItem($_POST['sys_name'], $_POST['user_name'], $_POST['path']);
    if ($insert) {
        header('Location: menu.php');
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

    <form action="menu.php" method="post">
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
?>