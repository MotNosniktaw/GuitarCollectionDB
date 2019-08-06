<?php

$db = new PDO
(
    'mysql:host=192.168.20.20; dbname=Guitars',
    'root',
    ''
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/**
 *
 * Returns all desired item values for all items.
 * Where many images are stored for an item, only the first added (MAIN image) is returned
 *
 * @param $database - this is a PDO established connection to the 'Guitars' database
 * @return array - this contains all information for all guitars in an associative array
 */
function getAllFromDatabase($database):array
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

function populateRow($item) {
    return '<tr>
                    <td>' . $item['id'] . '</td>
                    <td><img src="' . $item['fileLocation'] . '"</td>
                    <td>' . $item['brand'] . ' '. $item['model'] . '</td>
                    <td>' . $item['year'] . '</td>
                    <td>' . $item['type'] . '</td>
                    <td>' . $item['country'] . '</td>
                    <td>' . $item['value'] . '</td>
                    <td>' . $item['dateAcquired'] . '</td>
              </tr>';
}

function buildTable($guitarsArray) {
    echo '<tr><th>#</th><th>Image</th><th>Guitar</th><th>Year</th><th>Type</th><th>Country</th><th>Value</th><th>Date Acquired</th>';
    foreach ($guitarsArray as $guitar) {
        echo populateRow($guitar);
    }
}
?>
<html lang=en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitar Collection</title>
    <link rel="stylesheet" type="text/css" href="normalize-8-0-1 copy.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div>
    <h1>
        Guitar Colleciton
    </h1>
    <p>
        There are the things in my collection
    </p>
</div>
<div>
    <table>
        <?php
        $allGuitars = getAllFromDatabase($db);
        buildTable($allGuitars);
        //code to create <tr></tr> elements and fill them with <td> and <th> elements containing item information and column headings
        ?>
    </table>
</div>
<?php

var_dump($allGuitars);
?>

</body>
</html>
