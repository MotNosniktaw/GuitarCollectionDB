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

?>

<a href="index.php">Go back to DB</a>
