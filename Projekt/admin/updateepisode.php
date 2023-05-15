<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Episode;

$episodeObj = new Episode("localhost", 3306, "root", "", "sj-2023");

if(isset($_POST['submit'])) {
    $update = $episodeObj->updateEpisodeItem($_POST['id'], $_POST['code'], $_POST['title'], $_POST['name'], $_POST['img_path'], $_POST['description'],
        $_POST['length'], $_POST['serial']);
    if($update) {
        header('Location: episode.php');
    } else {
        echo "Error";
    }
} else {
    $episodeItem = $episodeObj->getEpisodeItem($_GET['id']);
    ?>

    <form action="updateepisode.php" method="post">
        Code:<br>
        <input type="text" name="code" value="<?php echo $episodeItem['code']; ?>" placeholder="Code"><br>
        Title:<br>
        <input type="text" name="title" value="<?php echo $episodeItem['title']; ?>" placeholder="Title"><br>
        Name:<br>
        <input type="text" name="name" value="<?php echo $episodeItem['name']; ?>" placeholder="Name"><br>
        Img Path:<br>
        <input type="text" name="img_path" value="<?php echo $episodeItem['img_path']; ?>" placeholder="Img Path"><br>
        Description:<br>
        <input type="text" name="description" value="<?php echo $episodeItem['description']; ?>" placeholder="Description"><br>
        Length:<br>
        <input type="text" name="length" value="<?php echo $episodeItem['length']; ?>" placeholder="Length"><br>
        Serial:<br>
        <input type="text" name="serial" value=<?php echo $episodeItem['serial']; ?>"" placeholder="Serial"><br>
        <input type="hidden" name="id" value="<?php echo $episodeItem['id']; ?>">
        <input type="submit" name="submit" value="Update">
    </form>

    <?php
}
?>