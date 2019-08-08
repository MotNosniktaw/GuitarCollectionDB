<?php

require_once 'functions.php';

$db = getDB();

$message = '<p>I want to add a new guitar for you!</p>';
$brandInDB = checkBrands($db);
$typeInDB = checkTypes($db);
$countryInDB = checkCountries($db);

if ($brandInDB === true && $typeInDB === true && $countryInDB === true) {
     $message .= '<p>I can do this because you have provided values we can use</p>';
} else {
    $message .= '<p>You should add better information</p>';
}
echo $message;

//if (isset($_GET['newGuitar'])
//    && isset($_GET['brand'])
//    && isset($_GET['model'])
//    && isset($_GET['year'])
//    && isset($_GET['type'])
//    && isset($_GET['country'])
//    && isset($_GET['hand'])
//    && isset($_GET['value'])
//    && isset($_GET['date'])) {
//    ;
//}

$brand = getBrandID($db);
echo $brand . '<br><br>';
$type = getTypeID($db);
echo $type . '<br><br>';
$country = getCountryID($db);
echo $country . '<br><br>';
addNewGuitar($db, $brand, $type, $country);
addNewImage($db);

?>
<div>
    <form action="addNewGuitar.php" method="get">
        <div>Brand: <input type="text" name="brand" value="<?php echo $_GET['brand']?>" required></div>
        <div>Model: <input type="text" name="model" value="<?php echo $_GET['model']?>" required></div>
        <div>Year: <input type="text" name="year" value="<?php echo $_GET['year']?>" required></div>
        <div>Type: <input type="text" name="type" value="<?php echo $_GET['type']?>" required></div>
        <div>Country: <input type="text" name="country" value="<?php echo $_GET['country']?>" required></div>
        <div>LH or RH:
            <select name="hand" value="<?php echo $_GET['hand']?>" required>
                <option value="0">Please select LH or RH</option>
                <option value="LH">LH</option>
                <option value="RH">RH</option>
            </select></div>
        <div>Value: <input type="number" name="value" value="<?php echo $_GET['value']?>" required></div>
        <div>Serial Code: <input type="text" name="serial" value="<?php echo $_GET['serial']?>"></div>
        <div>Image: <input type="text" name="img" value="<?php echo $_GET['img']?>"></div>
        <div>Date Acquired: <input type="date" name="date" value="<?php echo $_GET['date']?>"></div>
        <div><input type="submit" name="newGuitar"></div>
    </form>
</div>
<a href="index.php">Go back to DB</a>
