<?php

require_once 'functions.php';

$db = getDB();
$allGuitars = getAllFromDatabase($db);

?>
<html lang=en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitar Collection</title>
    <link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize-8-0-1.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
</head>
<body>
<div class="container">
    <div>
        <h1>Guitar Collection</h1>
        <p>These are the things in my collection:</p>
    </div>
    <div><p><a href="addNewGuitar.php">Add a new item</a></p></div>
    <div class="guitars-container">
        <div class="row header">
            <div class="item-detail number-column">#</div>
            <div class="item-detail img-column">Image</div>
            <div class="item-detail name-column">Guitar</div>
            <div class="item-detail year-column">Year</div>
            <div class="item-detail type-column">Type</div>
            <div class="item-detail country-column">Country</div>
            <div class="item-detail value-column">Value</div>
            <div class="item-detail date-acq-column">Date Acquired</div>
        </div>
        <?php
        echo displayGuitars($allGuitars);
        ?>
    </div>
</div>

</body>
</html>
