<?php

namespace ukf;

use PDO;


class Review
{

    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbName;

    private $connection;

    public function __construct(
        string $host = "localhost",
        int    $port = 3306,
        string $user = "root",
        string $password = "",
        string $dbName = "sj-2023"
    )
    {
        if (!empty($host)) {
            $this->host = $host;
        }

        if (!empty($port)) {
            $this->port = $port;
        }

        if (!empty($user)) {
            $this->username = $user;
        }

        if (isset($password)) {
            $this->password = $password;
        }

        if (!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ";port=" . $this->port,
                $this->username,
                $this->password
            );
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    public function getReviewData(string $type): array
    {
        $review = [];

        if ($this->validateReviewType($type)) {
            if ($type === "header") {
                try {

                    $sql = "SELECT * FROM reviews";
                    $query = $this->connection->query($sql);
                    $reviewData = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($reviewData as $reviewItem) {
                        $review[$reviewItem['username']] = [
                            'nickname' => $reviewItem['nickname'],
                            'text' => $reviewItem['text'],
                            'id' => $reviewItem['id']
                        ];
                    }
                } catch (\Exception $exception) {
                    //echo $exception->getMessage();
                }
            }
        }

        return $review;
    }

    function validateReviewType(string $type): bool
    {
        $reviewTypes = [
            'header',
            'footer'
        ];

        if (in_array($type, $reviewTypes)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertReviewItem(string $username, string $nickname, string $text): bool
    {
        $sql = "INSERT INTO reviews (username, nickname, text)
                VALUE ('" . $username . "', '" . $nickname . "', '" . $text . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function deleteReviewItem(int $id): bool
    {
        $sql = "DELETE FROM reviews WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $delete = $statement->execute();
            return $delete;
        } catch (\Exception $exception) {
            return false;
        }
    }

    function printReview(array $review)
    {
        foreach ($review as $reviewName => $reviewData) {
            echo '<b>' . $reviewData['nickname'] . ':</b> ' . $reviewData['text'] . '<br><hr>';
        }
    }

    public function getReviewItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM reviews WHERE id = " . $id;
            $query = $this->connection->query($sql);
            $reviewItem = $query->fetch(PDO::FETCH_ASSOC);

            return $reviewItem;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public function updateReviewItem(int $_id, string $_username, string $_nickname, string $_text): bool
    {
        $sql = "UPDATE reviews
                SET username = '" . $_username . "', nickname = '" . $_nickname . "', text = '" . $_text . "' 
                WHERE id = " . $_id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }
    }
}

class Menu
{

    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbName;

    private $connection;

    public function __construct(
        string $host = "localhost",
        int    $port = 3306,
        string $user = "root",
        string $password = "",
        string $dbName = "sj-2023"
    )
    {
        if (!empty($host)) {
            $this->host = $host;
        }

        if (!empty($port)) {
            $this->port = $port;
        }

        if (!empty($user)) {
            $this->username = $user;
        }

        if (isset($password)) {
            $this->password = $password;
        }

        if (!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ";port=" . $this->port,
                $this->username,
                $this->password
            );
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    public function getMenuData(string $type): array
    {
        $menu = [];

        if ($this->validateMenuType($type)) {
            if ($type === "header") {
                try {

                    $sql = "SELECT * FROM menu";
                    $query = $this->connection->query($sql);
                    $menuData = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($menuData as $menuItem) {
                        $menu[$menuItem['sys_name']] = [
                            'name' => $menuItem['user_name'],
                            'path' => $menuItem['path'],
                            'id' => $menuItem['id']
                        ];
                    }
                } catch (\Exception $exception) {
                    //echo $exception->getMessage();
                }
            }
        }

        return $menu;
    }

    function validateMenuType(string $type): bool
    {
        $menuTypes = [
            'header',
            'footer'
        ];

        if (in_array($type, $menuTypes)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertMenuItem(string $sysName, string $userName, string $path): bool
    {
        $sql = "INSERT INTO menu (sys_name, user_name, path) 
                VALUE ('" . $sysName . "', '" . $userName . "', '" . $path . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function deleteMenuItem(int $id): bool
    {
        $sql = "DELETE FROM menu WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $delete = $statement->execute();
            return $delete;
        } catch (\Exception $exception) {
            return false;
        }
    }

    function printMenu(array $menu)
    {
        foreach ($menu as $menuName => $menuData) {
            echo '<li><a class="nav-link" href="' . $menuData['path'] . '">' . $menuData['name'] . '</a></li>';
        }
    }

    public function getMenuItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM menu WHERE id = " . $id;
            $query = $this->connection->query($sql);
            $menuItem = $query->fetch(PDO::FETCH_ASSOC);

            return $menuItem;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public function updateMenuItem(int $id, string $sysName, string $userName, string $path): bool
    {
        $sql = "UPDATE menu 
                SET sys_name = '" . $sysName . "', user_name = '" . $userName . "', path = '" . $path . "' 
                WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }
    }
}


class Cast
{

    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbName;

    private $connection;

    public function __construct(
        string $host = "localhost",
        int    $port = 3306,
        string $user = "root",
        string $password = "",
        string $dbName = "sj-2023"
    )
    {
        if (!empty($host)) {
            $this->host = $host;
        }

        if (!empty($port)) {
            $this->port = $port;
        }

        if (!empty($user)) {
            $this->username = $user;
        }

        if (isset($password)) {
            $this->password = $password;
        }

        if (!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ";port=" . $this->port,
                $this->username,
                $this->password
            );
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    public function getCastData(string $type): array
    {
        $cast = [];

        if ($this->validateCastType($type)) {
            if ($type === "header") {
                try {

                    $sql = "SELECT * FROM cast";
                    $query = $this->connection->query($sql);
                    $castData = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($castData as $castItem) {
                        $cast[$castItem['tag']] = [
                            'name' => $castItem['name'],
                            'actor' => $castItem['actor'],
                            'img_path' => $castItem['img_path'],
                            'id' => $castItem['id']
                        ];
                    }
                } catch (\Exception $exception) {
                    //echo $exception->getMessage();
                }
            }
        }

        return $cast;
    }

    public function insertCastItem(string $tag, string $name, string $actor, string $img_path): bool
    {
        $sql = "INSERT INTO cast (tag, name, actor, img_path) 
                VALUE ('" . $tag . "','" . $name . "', '" . $actor . "', '" . $img_path . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function deleteCastItem(int $id): bool
    {
        $sql = "DELETE FROM cast WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $delete = $statement->execute();
            return $delete;
        } catch (\Exception $exception) {
            return false;
        }
    }

    function printCast(array $cast)
    {
        foreach ($cast as $castName => $castData) {
            echo '
        <div class="owl-carousel-info-wrap item">
            <img src="' . $castData['img_path'] . '"
                class="owl-carousel-image img-fluid" alt="">

            <div class="owl-carousel-info">
                <h6 class="mb-2">' . $castData['name'] . '</h6>

                Played by ' . $castData['actor'] . '
            </div>

        </div>
        ';
        }
    }

    function validateCastType(string $type): bool
    {
        $castTypes = [
            'header',
            'footer'
        ];

        if (in_array($type, $castTypes)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCastItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM cast WHERE id = " . $id;
            $query = $this->connection->query($sql);
            $castItem = $query->fetch(PDO::FETCH_ASSOC);

            return $castItem;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public function updateCastItem(int $id, string $tag, string $name, string $actor, string $img_path): bool
    {
        $sql = "UPDATE cast 
            SET tag = '" . $tag . "', name = '" . $name . "', actor = '" . $actor . "', img_path = '" . $img_path . "'
            WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }
    }

}




class Episode
{

    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbName;

    private $connection;

    public function __construct(
        string $host = "localhost",
        int    $port = 3306,
        string $user = "root",
        string $password = "",
        string $dbName = "sj-2023"
    )
    {
        if (!empty($host)) {
            $this->host = $host;
        }

        if (!empty($port)) {
            $this->port = $port;
        }

        if (!empty($user)) {
            $this->username = $user;
        }

        if (isset($password)) {
            $this->password = $password;
        }

        if (!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbName . ";port=" . $this->port,
                $this->username,
                $this->password
            );
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            die();
        }
    }

    public function getEpisodeData(string $type): array
    {
        $episode = [];

        if ($this->validateEpisodeType($type)) {
            if ($type === "header") {
                try {

                    $sql = "SELECT * FROM episode";
                    $query = $this->connection->query($sql);
                    $episodeData = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($episodeData as $episodeItem) {
                        $episode[$episodeItem['code']] = [
                            'title' => $episodeItem['title'],
                            'img_path' => $episodeItem['img_path'],
                            'name' => $episodeItem['name'],
                            'description' => $episodeItem['description'],
                            'length' => $episodeItem['length'],
                            'serial' => $episodeItem['serial'],
                            'id' => $episodeItem['id']
                        ];
                    }
                } catch (\Exception $exception) {
                    //echo $exception->getMessage();
                }
            }
        }

        return $episode;
    }

    public function insertEpisodeItem(string $code, string $title, string $name, string $img_path, string $description, int $length, string $serial): bool
    {
        $sql = "INSERT INTO episode (code, title, name, img_path, description, length, serial) 
                VALUE ('" . $code . "','" . $title . "', '" . $name . "', '" . $img_path . "', '" . $description . "', '" . $length . "', '" . $serial . "')";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute();
            return $insert;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function deleteEpisodeItem(int $id): bool
    {
        $sql = "DELETE FROM episode WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $delete = $statement->execute();
            return $delete;
        } catch (\Exception $exception) {
            return false;
        }
    }

    function printEpisode(array $episode)
    {
        foreach ($episode as $episodeName => $episodeData) {
            echo '
                <div class="owl-carousel-info-wrap item">
                    <div class="col-lg-12 col-12 mb-4 mb-lg-0">
                        <div class="custom-block custom-block-full">
                            <div class="custom-block-image-wrap">
                                <a href="gfa.php">
                                    <img src="' . $episodeData['img_path'] . '" class="custom-block-image img-fluid"
                                         alt="">
                                </a>
                            </div>

                            <div class="custom-block-info">
                                <h5 class="mb-2">
                                    <a href="gfa.php">
                                        ' . $episodeData['title'] . '
                                    </a>
                                </h5>

                                Directed by ' . $episodeData['name'] . '

                                <p class="mb-0">' . $episodeData['description'] . '</p>

                                <div class="custom-block-bottom d-flex justify-content-between mt-3">
                                    <div class="custom-block-top d-flex mb-1">
                                        <small class="me-4">
                                            <i class="bi-clock-fill custom-icon"></i>
                                            ' . $episodeData['length'] . ' Minutes
                                        </small>

                                        <small>' . $episodeData['serial'] . '</small>
                                    </div>
                                </div>
                            </div>

                            <div class="social-share d-flex flex-column ms-auto">
                                <a href="#" class="badge ms-auto">
                                    <i class="bi-heart"></i>
                                </a>

                                <a href="#" class="badge ms-auto">
                                    <i class="bi-bookmark"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

        ';
        }
    }

    function validateEpisodeType(string $type): bool
    {
        $episodeTypes = [
            'header',
            'footer'
        ];

        if (in_array($type, $episodeTypes)) {
            return true;
        } else {
            return false;
        }
    }

    public function getEpisodeItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM episode WHERE id = " . $id;
            $query = $this->connection->query($sql);
            $episodeItem = $query->fetch(PDO::FETCH_ASSOC);

            return $episodeItem;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public function updateEpisodeItem(int $id, string $code, string $title, string $name, string $img_path, string $description, int $length, string $serial): bool
    {
        $sql = "UPDATE episode 
            SET code = '" . $code . "', title = '" . $title . "', name = '" . $name . "', img_path = '" . $img_path . "', description = '" . $description . "'
            , length = '" . $length . "', serial = '" . $serial . "'
            WHERE id = " . $id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }
    }

}



?>