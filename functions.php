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

function checkBrands(\PDO $database):bool {
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

function checkTypes(\PDO $database):bool {
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

function checkCountries(\PDO $database):bool {
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

function getBrandID(\PDO $database):int {
    $query = $database->prepare(
        'SELECT `brand` FROM `brands`'
    );

    $query->execute();
    $assocArray = $query->fetchAll();
    $tidyArray = [];
    foreach ($assocArray as $array) {
        array_push($tidyArray, $array['brand']);
    }

    return array_search($_GET['brand'], $tidyArray) + 1;
}

function getTypeID(\PDO $database):int {
    $query = $database->prepare(
        'SELECT `type` FROM `types`'
    );

    $query->execute();
    $assocArray = $query->fetchAll();
    $tidyArray = [];
    foreach ($assocArray as $array) {
        array_push($tidyArray, $array['type']);
    }

    return array_search($_GET['type'], $tidyArray) + 1;
}

function getCountryID(\PDO $database):int {
    $query = $database->prepare(
        'SELECT `country` FROM `countries`'
    );

    $query->execute();
    $assocArray = $query->fetchAll();
    $tidyArray = [];
    foreach ($assocArray as $array) {
        array_push($tidyArray, $array['country']);
    }

    return array_search($_GET['country'], $tidyArray) + 1;
}

function addNewImage($database) {
    if (isset($_GET['img']) && $_GET['img'] !== '') {
        $filePath = './img/' . $_GET['img'];
        $query = $database->prepare('INSERT INTO `images`(`guitarID`, `fileLocation`) VALUES ((SELECT `id` FROM `guitars` ORDER BY `id` DESC LIMIT 1), :filePath)');
        $query->bindParam('filePath',$filePath, PDO::PARAM_STR);
    } else {
        $query = $database->prepare('INSERT INTO `images`(`guitarID`) VALUES ((SELECT `id` FROM `guitars` ORDER BY `id` DESC LIMIT 1))');
    }

    $query->execute();
}

function addNewGuitar($database, $brandID, $typeID, $countryID) {

    $query = $database->prepare(
        'INSERT INTO `guitars`(`brandID`, `model`, `year`, `typeID`, `countryID`, `LH or RH`, `value`, `serialCode`, `dateAcquired`)
        VALUES (:brand, :model, :year, :type, :country, :hand, :value, :serialCode, :date )');
    $query->bindParam('brand', $brandID, PDO::PARAM_INT);
    $query->bindParam('model', $_GET['model'], PDO::PARAM_STR);
    $query->bindParam('year', $_GET['year'], PDO::PARAM_INT);
    $query->bindParam('type', $typeID, PDO::PARAM_INT);
    $query->bindParam('country',$countryID, PDO::PARAM_INT);
    $query->bindParam('hand', $_GET['hand'], PDO::PARAM_STR);
    $query->bindParam('value', $_GET['value'], PDO::PARAM_INT);
    $query->bindParam('serialCode', $_GET['serial'], PDO::PARAM_STR);
    $query->bindParam('date', $_GET['date'], PDO::PARAM_STR);

    $query->execute();
}

