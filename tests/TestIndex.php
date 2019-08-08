<?php

require_once '../functions.php';

use PHPUnit\Framework\TestCase;

class TestIndex extends TestCase
{
    public function testDisplayGuitars_singleItemInputSuccess()
    {
        $guitarInput = [['id' => 1, 'fileLocation' => './img/guitarPic1.jpg', 'brand' => 'Yamaha', 'model' => 'Guitar', 'year' => 1999,
            'type' => 'Electric', 'country' => 'Japan', 'value' => 25, 'dateAcquired' => '2000-01-01']];

        $expectedTableContents = '<div class="row item"><div class="item-detail number-column">1</div><div class="item-detail img-column"><img src="./img/guitarPic1.jpg"></div><div class="item-detail name-column">Yamaha Guitar</div><div class="item-detail year-column">1999</div><div class="item-detail type-column">Electric</div><div class="item-detail country-column">Japan</div><div class="item-detail value-column">£25.00</div><div class="item-detail date-acq-column">2000-01-01</div></div>';

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