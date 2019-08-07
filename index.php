<?php

require_once 'functions.php';

?>
<html lang=en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guitar Collection</title>
    <link rel="stylesheet" type="text/css" href="normalize-8-0-1.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap"
          rel="stylesheet">
</head>
<body>
<div class="container">
<div>
    <h1>Guitar Collection</h1>
    <p>These are the things in my collection:</p>
</div>
<div class="guitarsContainer">
    <div class="row header">
        <div class="item-detail column1">#</div>
        <div class="item-detail column2">Image</div>
        <div class="item-detail column3">Guitar</div>
        <div class="item-detail column4">Year</div>
        <div class="item-detail column5">Type</div>
        <div class="item-detail column6">Country</div>
        <div class="item-detail column7">Value</div>
        <div class="item-detail column8">Date Acquired</div>
    </div>
    <?php
    $db = getDB();
    $allGuitars = getAllFromDatabase($db);
    echo displayGuitars($allGuitars);
    ?>
</div>
</div>

</body>
</html>
