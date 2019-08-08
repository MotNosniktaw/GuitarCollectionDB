<?php

require_once 'functions.php';

$db = getDB();
$allGuitars = getAllFromDatabase($db);

//if (isset($_GET['newGuitar'])
//    && isset($_GET['brand'])
//    && isset($_GET['model'])
//    && isset($_GET['year'])
//    && isset($_GET['type'])
//    && isset($_GET['country'])
//    && isset($_GET['hand'])
//    && isset($_GET['value'])
//    && isset($_GET['date'])) {
//    $returnMessage = addNewGuitar($db);
//}

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
        <?php
        echo $returnMessage;
        ?>
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
