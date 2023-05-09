<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Review;

$reviewObj = new Review("localhost", 3306, "root", "", "sj-2023");

if(isset($_POST['submit'])) {
    $update = $reviewObj->updateReviewItem($_POST['id'], $_POST['username'], $_POST['nickname'], $_POST['text']);
    if($update) {
        header('Location: review.php');
    } else {
        echo "Error";
    }
} else {
    $reviewItem = $reviewObj->getReviewItem($_GET['id']);
    ?>

    <form action="updatereview.php" method="post">
        Username:<br>
        <input type="text" name="username" value="<?php echo $reviewItem['username']; ?>" placeholder="Username"><br>
        Nickname:<br>
        <input type="text" name="nickname" value="<?php echo $reviewItem['nickname']; ?>" placeholder="Nickname"><br>
        Path:<br>
        <input type="text" name="text" value="<?php echo $reviewItem['text']; ?>" placeholder="URL"><br>
        <input type="hidden" name="id" value="<?php echo $reviewItem['id']; ?>">
        <input type="submit" name="submit" value="Update">
    </form>

    <?php
}
?>