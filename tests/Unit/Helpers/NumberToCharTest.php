<?php

namespace Helpers;

use App\Helpers\NumberToChar;
use PHPUnit\Framework\TestCase;

class NumberToCharTest extends TestCase
{

    /**
     * @throws \Exception
     */
    public function testMapNumberToUpperCaseLetterInRange()
    {
        // Arrange
        $number = 1; // Change to the input value you want to test
        $expectedResult = 'A'; // Expected result for input 1

        // Act
        $result = NumberToChar::mapNumberToUpperCaseLetter($number);

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    public function testMapNumberToUpperCaseLetterOutOfRange()
    {
        // Arrange
        $number = 0; // Change to an out-of-range input value
        $this->expectException(\Exception::class);

        // Act
        NumberToChar::mapNumberToUpperCaseLetter($number);
    }
}
