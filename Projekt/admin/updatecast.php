<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Cast;

$castObj = new Cast("localhost", 3306, "root", "", "sj-2023");

if(isset($_POST['submit'])) {
    $update = $castObj->updateCastItem($_POST['id'], $_POST['tag'], $_POST['name'], $_POST['actor'], $_POST['img_path']);
    if($update) {
        header('Location: cast.php');
    } else {
        echo "Error";
    }
} else {
    $castItem = $castObj->getCastItem($_GET['id']);
    ?>

    <form action="updatecast.php" method="post">
        Tag:<br>
        <input type="text" name="tag" value="<?php echo $castItem['tag']; ?>" placeholder="Tag"><br>
        Name:<br>
        <input type="text" name="name" value="<?php echo $castItem['name']; ?>" placeholder="Name"><br>
        Actor:<br>
        <input type="text" name="actor" value="<?php echo $castItem['actor']; ?>" placeholder="Actor"><br>
        Img path:<br>
        <input type="text" name="img_path" value="<?php echo $castItem['img_path']; ?>" placeholder="Img path"><br>
        <input type="hidden" name="id" value="<?php echo $castItem['id']; ?>">
        <input type="submit" name="submit" value="Update">
    </form>

    <?php
}
?>