<?php

namespace App\Contracts\GoogleSheet;

use App\DTO\BaseDTO;

interface ReadFromGoogleSheetInterface
{
    public function readAll(string $sourceId, string $sheet): array;

    public function readRange(string $sourceId, string $sheet, string $min = '', string $max = ''): array;

    public function findCell(string $sourceId, string $sheet, string $valueOfCell): array;

}
