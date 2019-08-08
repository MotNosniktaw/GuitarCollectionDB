<?php

require_once 'functions.php';

$db = getDB();

$message = '<p>I want to add a new guitar for you!</p>';
$brandInDB = checkBrands($db);
$typeInDB = checkTypes($db);
$countryInDB = checkCountries($db);

$brand = getBrandID($db);
$type = getTypeID($db);
$country = getCountryID($db);

if (isset($_GET['newGuitar'])
    && isset($_GET['brand'])
    && isset($_GET['model'])
    && isset($_GET['year'])
    && isset($_GET['type'])
    && isset($_GET['country'])
    && isset($_GET['hand'])
    && isset($_GET['value'])
    && isset($_GET['date'])
) {
    if ($brandInDB === true && $typeInDB === true && $countryInDB === true) {
        $message .= '<p>I can do this because you have provided values we can use</p>';
        $brand = getBrandID($db);
        $type = getTypeID($db);
        $country = getCountryID($db);

        addNewGuitar($db, $brand, $type, $country);
        addNewImage($db);
    } else {
        $message .= '<p>You should add better information</p>';
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitar Collection - Add</title>
    <link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize-8-0-1.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
</head>
<body>
<div class="container">
<?php
    echo $message;
    ?>
    <form action="addNewGuitar.php" method="get">
        <div>Brand: <input type="text" name="brand" required></div>
        <div>Model: <input type="text" name="model" required></div>
        <div>Year: <input type="number" name="year" required></div>
        <div>Type: <input type="text" name="type" required></div>
        <div>Country: <input type="text" name="country" required></div>
        <div>LH or RH:
            <select name="hand" required>
                <option value="LH">LH</option>
                <option value="RH">RH</option>
            </select></div>
        <div>Value: <input type="number" name="value" required></div>
        <div>Serial Code: <input type="text" name="serial"></div>
        <div>Image: <input type="text" name="img"?></div>
        <div>Date Acquired: <input type="date" name="date" required></div>
        <div><input type="submit" name="newGuitar"></div>
    </form>

    <a href="index.php">Go back to DB to see items that have acquired</a>
</div>
</body>
</html>

