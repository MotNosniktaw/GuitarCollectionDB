<?php
/**
 * creates an instance of PDO that access Guitars database
 *
 * @return PDO
 */
function getDB()
{
    $database = new PDO
    (
        'mysql:host=192.168.20.20; dbname=Guitars',
        'root',
        ''
    );
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $database;
}

/**
 *
 * Returns all desired item values for all items.
 * Where many images are stored for an item, only the first added (MAIN image) is returned
 *
 * @param $database - this is a PDO established connection to the 'Guitars' database
 * @return array - this contains all information for all guitars in an associative array
 */
function getAllFromDatabase(PDO $database):array
{
    $sqlGetAll = $database->prepare(
        'SELECT `guitars`.`id`, `images`.`fileLocation`, `brands`.`brand`, `guitars`.`model`, `guitars`.`year`, `types`.`type`,
                    `countries`.`country`, `guitars`.`value`, `guitars`.`dateAcquired` FROM `guitars`
            LEFT JOIN `images`
                ON `images`.`guitarID` = `guitars`.`id`
            LEFT JOIN `brands`
                ON `brands`.`id` = `guitars`.`brandID`
            LEFT JOIN `types`
                ON `types`.`id` = `guitars`.`typeID`
            LEFT JOIN `countries`
                ON `countries`.`id` = `guitars`.`countryID`
            GROUP BY `guitars`.`id`;'
    );

    $sqlGetAll->execute();
    return $sqlGetAll->fetchAll();
}

/**
 * Takes multidimensional array to be output as a string
 * Outputs string containing Guitar Item values separated into separate divs and "row" container divs for respective Guitar Items
 *
 * @param array $guitarsArray
 * @return string
 */
function displayGuitars(array $guitarsArray):string {
    $result = '';
    if (isset($guitarsArray[0]['id'])
        && isset($guitarsArray[0]['fileLocation'])
        && isset($guitarsArray[0]['brand']) && isset($guitarsArray[0]['model'])
        && isset($guitarsArray[0]['year']) && isset($guitarsArray[0]['type'])
        && isset($guitarsArray[0]['country']) && isset($guitarsArray[0]['value'])
        && isset($guitarsArray[0]['dateAcquired'])) {
        foreach ($guitarsArray as $guitar) {
            $result .= '<div class="row item">';
            $result .= '<div class="item-detail column1">' . $guitar['id'] . '</div>';
            $result .= '<div class="item-detail column2"><img src="' . $guitar['fileLocation'] . '"></div>';
            $result .= '<div class="item-detail column3">' . $guitar['brand'] . ' ' . $guitar['model'] . '</div>';
            $result .= '<div class="item-detail column4">' . $guitar['year'] . '</div>';
            $result .= '<div class="item-detail column5">' . $guitar['type'] . '</div>';
            $result .= '<div class="item-detail column6">' . $guitar['country'] . '</div>';
            $result .= '<div class="item-detail column7">' . $guitar['value'] . '</div>';
            $result .= '<div class="item-detail column8">' . $guitar['dateAcquired'] . '</div>';
            $result .= '</div>';
        }
        return $result;
    } else {
        return 'Cannot display required data. Please contact administrator';
    }
}
?>