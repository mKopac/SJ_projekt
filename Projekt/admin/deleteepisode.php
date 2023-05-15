<?php
include_once "../functions.php";

use ukf\Episode;

$episodeObj = new Episode("localhost", 3306, "root", "", "sj-2023");

if(isset($_GET['id'])) {
    $delete = $episodeObj->deleteEpisodeItem($_GET['id']);
    if($delete) {
        header('Location: episode.php?status=1');
    } else {
        echo "Error";
    }
} else {
    header('Location: episode.php');
}