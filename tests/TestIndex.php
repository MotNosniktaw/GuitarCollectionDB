<?php

require_once '../functions.php';

use PHPUnit\Framework\TestCase;

class TestIndex extends TestCase
{
    public function testDisplayGuitars_singleItemInputSuccess()
    {
        $guitarInput = [['id' => 1, 'fileLocation' => './img/guitarPic1.jpg', 'brand' => 'Yamaha', 'model' => 'Guitar', 'year' => 1999,
            'type' => 'Electric', 'country' => 'Japan', 'value' => 25, 'dateAcquired' => '2000-01-01']];

        $expectedTableContents = '<div class="row item"><div class="item-detail column1">1</div><div class="item-detail column2"><img src="./img/guitarPic1.jpg"></div><div class="item-detail column3">Yamaha Guitar</div><div class="item-detail column4">1999</div><div class="item-detail column5">Electric</div><div class="item-detail column6">Japan</div><div class="item-detail column7">25</div><div class="item-detail column8">2000-01-01</div></div>';

        $tableContents = displayGuitars($guitarInput);

        $this->assertEquals($expectedTableContents, $tableContents);
    }

    public function testDisplayGuitars_badKeysFailure()
    {
        $notGuitarInput = [['cheese' => 1, 'rayGun' => './img/guitarPic1.jpg', 'sword' => 'Yamaha', 'grandma' => 'Guitar', 'potato' => 1999,
            'shark' => 'Electric', 'description' => 'Japan', 'cable' => 25, 'yes' => '2000-01-01']];

        $expectedOutput = 'Cannot display required data. Please contact administrator';

        $output = displayGuitars($notGuitarInput);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testDisplayGuitars_1DArrayInputFailure()
{
    $singleDimensionArrayInput = ['id' => 1, 'fileLocation' => './img/guitarPic1.jpg', 'brand' => 'Yamaha', 'model' => 'Guitar', 'year' => 1999,
        'type' => 'Electric', 'country' => 'Japan', 'value' => 25, 'dateAcquired' => '2000-01-01'];

    $expectedOutput = 'Cannot display required data. Please contact administrator';

    $output = displayGuitars($singleDimensionArrayInput);

    $this->assertEquals($expectedOutput, $output);
}

    public function testDisplayGuitars_stringInputMalformed()
    {
        $stringInput = 'potato';

        $this->expectException(TypeError::class);

        displayGuitars($stringInput);
    }
}