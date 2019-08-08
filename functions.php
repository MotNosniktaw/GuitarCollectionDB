<?php
/**
 * creates an instance of PDO that access Guitars database
 *
 * @return PDO
 */
function getDB() {
    $database = new PDO(
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
function getAllFromDatabase(PDO $database):array {
    $query = $database->prepare(
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

    $query->execute();
    return $query->fetchAll();
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
    foreach ($guitarsArray as $guitar) {
        $x = array_search($guitar, $guitarsArray);
        if (isset($guitarsArray[$x]['id'])
            && isset($guitarsArray[$x]['fileLocation'])
            && isset($guitarsArray[$x]['brand'])
            && isset($guitarsArray[$x]['model'])
            && isset($guitarsArray[$x]['year'])
            && isset($guitarsArray[$x]['type'])
            && isset($guitarsArray[$x]['country'])
            && isset($guitarsArray[$x]['value'])
            && isset($guitarsArray[$x]['dateAcquired'])
        ) {
            $result .= '<div class="row item">';
            $result .= '<div class="item-detail number-column">' . $guitar['id'] . '</div>';
            $result .= '<div class="item-detail img-column"><img src="' . $guitar['fileLocation'] . '"></div>';
            $result .= '<div class="item-detail name-column">' . $guitar['brand'] . ' ' . $guitar['model'] . '</div>';
            $result .= '<div class="item-detail year-column">' . $guitar['year'] . '</div>';
            $result .= '<div class="item-detail type-column">' . $guitar['type'] . '</div>';
            $result .= '<div class="item-detail country-column">' . $guitar['country'] . '</div>';
            $result .= '<div class="item-detail value-column">£' . $guitar['value'] . '.00</div>';
            $result .= '<div class="item-detail date-acq-column">' . $guitar['dateAcquired'] . '</div>';
            $result .= '</div>';
        } else {
            return 'Cannot display required data. Please contact administrator';
        }
    }
    return $result;
    }

function addNewGuitar(array $database):string {

    $message = '<p>I want to add a new guitar for you!</p>';
    $brandInDB = checkBrands($database);
    $typeInDB = checkTypes($database);
    $countryInDB = checkCountries($database);

    if ($brandInDB === true && $typeInDB === true && $countryInDB === true) {
        $message .= '<p>I can do this because you have provided the appropriate values</p>';
    } else {
        $message .= '<p>You should add better information';
    }
    return $message;
}

function checkBrands(array $database): bool {
    $query = $database->prepare(
        'SELECT `brand` FROM `brands`'
    );

    $query->execute();
    $assocArray = $query->fetchAll();
    $tidyArray = [];
    foreach ($assocArray as $array) {
        array_push($tidyArray, $array['brand']);
    }

    return in_array($_GET['brand'], $tidyArray);
}

function checkTypes(array $database): bool {
    $query = $database->prepare(
        'SELECT `type` FROM `types`'
    );

    $query->execute();
    $assocArray = $query->fetchAll();
    $tidyArray = [];
    foreach ($assocArray as $array) {
        array_push($tidyArray, $array['type']);
    }

    return in_array($_GET['type'], $tidyArray);
}

function checkCountries(array $database):bool {
    $query = $database->prepare(
        'SELECT `country` FROM `countries`'
    );

    $query->execute();
    $assocArray = $query->fetchAll();
    $tidyArray = [];
    foreach ($assocArray as $array) {
        array_push($tidyArray, $array['country']);
    }

    return in_array($_GET['country'], $tidyArray);
}