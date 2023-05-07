<?php

namespace ukf;

use PDO;


class Review{

    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbName;

    private $connection;

    public function __construct(
        string $host = "localhost",
        int $port = 3306,
        string $user = "root",
        string $password = "",
        string $dbName = "sj-2023"
    )
    {
        if(!empty($host)) {
            $this->host = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($user)) {
            $this->username = $user;
        }

        if(isset($password)) {
            $this->password = $password;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO(
                'mysql:host='.$this->host.';dbname='.$this->dbName.";port=".$this->port,
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

    public function insertReviewItem(string $username, string $nickname, string $text): bool
    {
        $sql = "INSERT INTO reviews (username, nickname, text)
                VALUE ('".$username."', '".$nickname."', '".$text."')";
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
        $sql = "DELETE FROM reviews WHERE id = ".$id;
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
            echo '<b>' . $reviewData['nickname'] . ':</b> ' . $reviewData['text'] . '<br><hr>' ;
        }
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

    public function getReviewItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM reviews WHERE id = ". $id;
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
                SET username = '".$_username."', nickname = '".$_nickname."', text = '".$_text."' 
                WHERE id = ".$_id;
        $statement = $this->connection->prepare($sql);
        try {
            $update = $statement->execute();
            return $update;
        } catch (\Exception $exception) {
            return false;
        }
    }
}

class Menu{

    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $dbName;

    private $connection;

    public function __construct(
        string $host = "localhost",
        int $port = 3306,
        string $user = "root",
        string $password = "",
        string $dbName = "sj-2023"
    )
    {
        if(!empty($host)) {
            $this->host = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($user)) {
            $this->username = $user;
        }

        if(isset($password)) {
            $this->password = $password;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {
            $this->connection = new PDO(
                'mysql:host='.$this->host.';dbname='.$this->dbName.";port=".$this->port,
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

    public function insertMenuItem(string $sysName, string $userName, string $path): bool
    {
        $sql = "INSERT INTO menu (sys_name, user_name, path) 
                VALUE ('".$sysName."', '".$userName."', '".$path."')";
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
        $sql = "DELETE FROM menu WHERE id = ".$id;
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

    public function getMenuItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM menu WHERE id = ". $id;
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
                SET sys_name = '".$sysName."', user_name = '".$userName."', path = '".$path."' 
                WHERE id = ".$id;
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