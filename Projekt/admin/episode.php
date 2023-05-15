<?php
include_once "auth_check.php";
include_once "../functions.php";

use ukf\Episode;

?>
<a href="../index.php">Back</a><br>
<a href="logout.php">Logout</a><br>
<a href="home.php">Home</a><br>
<a href="menu.php">Menu</a><br>
<a href="review.php">Reviews</a><br>
<a href="cast.php">Cast</a><br>
<a href="episodephp">Episodes</a><br>

<?php
$episodeObj = new Episode("localhost", 3306, "root", "", "sj-2023");
$episode = $episodeObj->getEpisodeData('header');


if (isset($_POST['submit'])) {
    $insert = $episodeObj->insertEpisodeItem($_POST['code'], $_POST['title'], $_POST['name'], $_POST['img_path'], $_POST['description'], $_POST['length']
    , $_POST['serial']);
    if ($insert) {
        header('Location: episode.php');
    } else {
        echo "Error";
    }
} else {

    if (isset($_GET['status']) && $_GET['status'] == 1) {
        echo "<strong>Deleted correctly</strong>";
    }

    echo "<br><br><ul>";
    echo "EPISODES";

    foreach ($episode as $code => $episodeItem) {
        echo "<li>
            tag: " . $code . ", 
            title: " . $episodeItem['title'] . ", 
            name: " . $episodeItem['name'] . ", 
            img_path: " . $episodeItem['img_path'] . ", 
            description: " . $episodeItem['description'] . ", 
            length: " . $episodeItem['length'] . ", 
            serial: " . $episodeItem['serial'] . "
            <a href='deleteepisode.php?id=" . $episodeItem['id'] . "'>Delete</a>
            <a href='updateepisode.php?id=" . $episodeItem['id'] . "'>Update</a>
            </li>";
    }

    echo "</ul>";
    ?>

    <form action="episode.php" method="post">
        Code:<br>
        <input type="text" name="code" value="" placeholder="Code"><br>
        Title:<br>
        <input type="text" name="title" value="" placeholder="Title"><br>
        Name:<br>
        <input type="text" name="name" value="" placeholder="Name"><br>
        Img Path:<br>
        <input type="text" name="img_path" value="" placeholder="Img Path"><br>
        Description:<br>
        <input type="text" name="description" value="" placeholder="Description"><br>
        Length:<br>
        <input type="text" name="length" value="" placeholder="Length"><br>
        Serial:<br>
        <input type="text" name="serial" value="" placeholder="Serial"><br>
        <input type="submit" name="submit" value="Insert">
    </form>
    <?php
}
?>
