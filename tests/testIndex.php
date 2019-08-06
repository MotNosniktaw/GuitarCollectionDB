<?php

require_once '../functions.php';

use PHPUnit\Framework\TestCase;

class testIndex extends TestCase
{
    public function testBuildTable_singleItemInput()
    {
        $guitarInput = [['id' => 1, 'fileLocation' => './img/guitarPic1.jpg', 'brand' => 'Yamaha', 'model' => 'Guitar', 'year' => 1999,
            'type' => 'Electric', 'country' => 'Japan', 'value' => 25, 'dateAcquired' => '2000-01-01']];

        $expectedTableContents = '<div class="row item"><div class="item-detail">1</div><div class="item-detail"><img src="./img/guitarPic1.jpg"></div><div class="item-detail">Yamaha Guitar</div><div class="item-detail">1999</div><div class="item-detail">Electric</div><div class="item-detail">Japan</div><div class="item-detail">25</div><div class="item-detail">2000-01-01</div></div>';

        $tableContents = buildTable($guitarInput);

        $this->assertEquals($expectedTableContents, $tableContents);
    }

    public function testBuildTable_badKeys()
    {
        $notGuitarInput = [['cheese' => 1, 'rayGun' => './img/guitarPic1.jpg', 'sword' => 'Yamaha', 'grandma' => 'Guitar', 'potato' => 1999,
            'shark' => 'Electric', 'description' => 'Japan', 'cable' => 25, 'yes' => '2000-01-01']];

        $expectedOutput = 'Database is not returning valid keys. Please contact administrator';

        $output = buildTable($notGuitarInput);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testBuildTable_1DArrayInput()
{
    $singleDimensionArrayInput = ['id' => 1, 'fileLocation' => './img/guitarPic1.jpg', 'brand' => 'Yamaha', 'model' => 'Guitar', 'year' => 1999,
        'type' => 'Electric', 'country' => 'Japan', 'value' => 25, 'dateAcquired' => '2000-01-01'];

    $expectedOutput = 'Database is not returning valid keys. Please contact administrator';

    $output = buildTable($singleDimensionArrayInput);

    $this->assertEquals($expectedOutput, $output);
}

    public function testBuildTable_stringInput()
    {
        $stringInput = 'potato';

        $this->expectException(TypeError::class);

        buildTable($stringInput);
    }
}