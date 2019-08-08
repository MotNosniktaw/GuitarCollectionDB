<?php

require_once 'functions.php';

$db = getDB();

$message = '<p>I want to add a new guitar for you!</p>';

if (isset($_GET['newGuitar'])
    && isset($_GET['brand']) && $_GET['brand'] !== null && $_GET['brand'] !== ''
    && isset($_GET['model']) && $_GET['model'] !== null && $_GET['model'] !== ''
    && isset($_GET['year']) && $_GET['year'] !== null && $_GET['year'] !== ''
    && isset($_GET['type']) && $_GET['type'] !== null && $_GET['type'] !== ''
    && isset($_GET['country']) && $_GET['country'] !== null && $_GET['country'] !== ''
    && isset($_GET['hand']) && $_GET['hand'] !== null && $_GET['hand'] !== ''
    && isset($_GET['value']) && $_GET['value'] !== null && $_GET['value'] !== ''
    && isset($_GET['date']) && $_GET['date'] !== null && $_GET['date'] !== ''
) {
    $brandInDB = checkBrands($db);
    $typeInDB = checkTypes($db);
    $countryInDB = checkCountries($db);

    $brand = getBrandID($db);
    $type = getTypeID($db);
    $country = getCountryID($db);

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
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitar Collection - Add</title>
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran&display=swap">
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize-8-0-1.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
</head>
<body>
<div class="container">
<?php echo $message; ?>
    <form action="addNewGuitar.php" method="get" class="form-container">
        <div class="form-item">Brand: <input type="text" name="brand" required></div>
        <div class="form-item">Model: <input type="text" name="model" required></div>
        <div class="form-item">Year: <input type="number" name="year" required></div>
        <div class="form-item">Type: <input type="text" name="type" required></div>
        <div class="form-item">Country: <input type="text" name="country" required></div>
        <div class="form-item">LH or RH:
            <select name="hand" required>
                <option value="LH">LH</option>
                <option value="RH">RH</option>
            </select></div>
        <div class="form-item">Value: <input type="number" name="value" required></div>
        <div class="form-item">Serial Code: <input type="text" name="serial"></div>
        <div class="form-item">Image: <input type="text" name="img"?></div>
        <div class="form-item">Date Acquired: <input type="date" name="date" required></div>
        <div class="form-item add-button"><input type="submit" name="newGuitar"></div>
    </form>

    <p><a href="index.php">Go back to DB to see items that have acquired</a></p>
</div>
</body>
</html>

