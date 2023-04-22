<?php
function getMenuData(string $type): array
{
    $menu = [];

    if(validateMenuType($type)) {
        if($type === "header") {
            $menu = [
                'home' => [
                    'name' => 'Home',
                    'path' => 'index.php',
                ],
                'about' => [
                    'name' => 'About',
                    'path' => 'about.php',
                ],
                'watch' => [
                    'name' => 'Watch',
                    'path' => 'watch.php',
                ],
                'quotes' => [
                    'name' => 'Quotes',
                    'path' => 'quotes.php',
                ]
            ];
        }
    }

    return $menu;
}

function printMenu(array $menu)
{
    foreach ($menu as $menuName => $menuData) {
        echo '<li><a href="'.$menuData['path'].'">'.$menuData['name'].'</a></li>';
    }
}

function validateMenuType(string $type): bool
{
    $menuTypes = [
        'header',
        'footer'
    ];

    if(in_array($type, $menuTypes)) {
        return true;
    } else {
        return false;
    }
}

function preparePortfolio(int $numberOfRows = 2, int $numberOfCols = 4): array
{
    $portfolio = [];
    $colIndex = 1;

    for ($i = 1; $i <= $numberOfRows; $i++) {
        for($j = 1; $j <= $numberOfCols; $j++) {
            $portfolio[$i][] = $colIndex;
            $colIndex++;
        }
    }

    return $portfolio;
}

?>