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

?>