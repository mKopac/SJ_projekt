<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Cast;

?>
<a href="logout.php">Logout</a><br>
<a href="home.php">Home</a><br>
<a href="menu.php">Menu</a><br>
<a href="review.php">Review</a><br>
<a href="cast.php">Cast</a><br>

<?php
$castObj = new Cast("localhost", 3306, "root", "", "sj-2023");
$cast = $castObj->getCastData('header');


if (isset($_POST['submit'])) {
    $insert = $castObj->insertCastItem($_POST['tag'], $_POST['name'], $_POST['actor'], $_POST['img_path']);
    if ($insert) {
        header('Location: cast.php');
    } else {
        echo "Error";
    }
} else {

    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<strong>Deleted correctly</strong>";
    }

    echo "<br><br><ul>";
    echo "CAST";

    foreach ($cast as $tag => $castItem) {
        echo "<li>
            tag: " . $tag . ", 
            name: " . $castItem['name'] . ", 
            actor: " . $castItem['actor'] . ", 
            img: " . $castItem['img_path'] . "
            <a href='deletecast.php?id=" . $castItem['id'] . "'>Delete</a>
            <a href='updatecast.php?id=" . $castItem['id'] . "'>Update</a>
            </li>";
    }

    echo "</ul>";
    ?>

    <form action="cast.php" method="post">
        Tag:<br>
        <input type="text" name="tag" value="" placeholder="Tag"><br>
        Name:<br>
        <input type="text" name="name" value="" placeholder="Name"><br>
        Actor:<br>
        <input type="text" name="actor" value="" placeholder="Actor"><br>
        Image Path:<br>
        <input type="text" name="img_path" value="" placeholder="Image Path"><br>
        <input type="submit" name="submit" value="Insert">
    </form>
    <?php
}
?>
