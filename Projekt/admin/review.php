<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Review;

?>
<a href="logout.php">Logout</a><br>
<a href="home.php">Home</a><br>
<a href="menu.php">Menu</a><br>
<a href="review.php">Review</a><br>
<a href="cast.php">Cast</a><br>

<?php
$reviewObj = new Review("localhost", 3306, "root", "", "sj-2023");
$review = $reviewObj->getReviewData('header');


if (isset($_POST['submit'])) {
    $insert = $reviewObj->insertReviewItem($_POST['username'], $_POST['nickname'], $_POST['text']);
    if ($insert) {
        header('Location: review.php');
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

    <form action="review.php" method="post">
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
