<?php

require_once 'functions.php';

$db = getDB();
$allGuitars = getAllFromDatabase($db);

if (isset($_GET['newGuitar'])) {
    addNewGuitar();
}

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
    <div>
        <form action="index.php" method="get">
            <div>Brand:    <input type="text" name="brand" value="<?php echo $_GET['brand']?>"></div>
            <div>Model:    <input type="text" name="model" value="<?php echo $_GET['model']?>"></div>
            <div>Type:     <input type="text" name="type" value="<?php echo $_GET['type']?>"></div>
            <div>Country:  <input type="text" name="country" value="<?php echo $_GET['country']?>"></div>
            <div>Year:     <input type="text" name="year" value="<?php echo $_GET['year']?>"></div>
            <div>Value:    <input type="text" name="value" value="<?php echo $_GET['value']?>"></div>
            <div>Serial Code: <input type="text" name="serial" value="<?php echo $_GET['serial']?>"></div>
            <div>Image:    <input type="text" name="img" value="<?php echo $_GET['img']?>"></div>
            <div><input type="submit" name="newGuitar"></div>
        </form>
    </div>
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
