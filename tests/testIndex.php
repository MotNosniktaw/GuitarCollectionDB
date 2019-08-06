<?php

require_once '../index.php';

use PHPUnit\Framework\TestCase;

class testIndex extends TestCase
{
    public function testPopulateRows_standardInput()
    {
        $guitarInput = ['id' => 1, 'fileLocation' => './img/guitarPic1.jpg', 'brand' => 'Yamaha', 'model' => 'Guitar', 'year' => 1999,
            'type' => 'Electric', 'country' => 'Japan', 'value' => 25, 'dateAcquired' => '2000-01-01'];

        $expectedRowContents = '<tr>
                    <td>1</td>
                    <td><img src="./img/guitarPic1.jpg"</td>
                    <td>Yamaha Guitar</td>
                    <td>1999</td>
                    <td>Electric</td>
                    <td>Japan</td>
                    <td>25</td>
                    <td>2000-01-01</td>
              </tr>';

        $rowContents = populateRow($guitarInput);

        $this->assertEquals($expectedRowContents, $rowContents);
    }
}