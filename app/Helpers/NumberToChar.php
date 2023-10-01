<?php

namespace App\Helpers;

class NumberToChar
{
    /**
     * @throws \Exception
     */
    public static function mapNumberToUpperCaseLetter($number): string
    {
        if ($number >= 1 && $number <= 26) {
            // Map numbers 1 to 26 to uppercase A to Z
            return chr($number + 64);
        } else {
            // Handle out-of-range numbers
            throw new \Exception("out of range number");
        }

    }

}
