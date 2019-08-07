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
</head>
<body>
<div>
    <h1>Guitar Collection</h1>
    <p>These are the things in my collection</p>
</div>
<div>
    <div class="row header">
        <div class="item-detail">#</div>
        <div class="item-detail">Image</div>
        <div class="item-detail">Guitar</div>
        <div class="item-detail">Year</div>
        <div class="item-detail">Type</div>
        <div class="item-detail">Country</div>
        <div class="item-detail">Value</div>
        <div class="item-detail">Date Acquired</div>
    </div>
    <?php
    $db = getDB();
    $allGuitars = getAllFromDatabase($db);
    echo displayGuitars($allGuitars);
    ?>
</div>

</body>
</html>
