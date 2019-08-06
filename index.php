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
    <h1>Guitar Colleciton</h1>
    <p>There are the things in my collection</p>
</div>
<div>
        <?php
        $db = getDB();
        $allGuitars = getAllFromDatabase($db);
        buildTable($allGuitars);
        //code to create <tr></tr> elements and fill them with <td> and <th> elements containing item information and column headings
        ?>
</div>
<?php

var_dump($allGuitars);
?>

</body>
</html>
