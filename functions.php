<?php

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

function populateRow(array $item):string {
    return '<div>
                    <div>' . $item['id'] . '</div>
                    <div><img src="' . $item['fileLocation'] . '"</div>
                    <div>' . $item['brand'] . ' '. $item['model'] . '</div>
                    <div>' . $item['year'] . '</div>
                    <div>' . $item['type'] . '</div>
                    <div>' . $item['country'] . '</div>
                    <div>' . $item['value'] . '</div>
                    <div>' . $item['dateAcquired'] . '</div>
              </div>';
}

function buildTable(array $guitarsArray):string {
    echo '<div>
            <div>#</div>
            <div>Image</div>
            <div>Guitar</div>
            <div>Year</div>
            <div>Type</div>
            <div>Country</div>
            <div>Value</div>
            <div>Date Acquired</div>
         </div>';
    foreach ($guitarsArray as $guitar) {
        echo populateRow($guitar);
    }
}