<?php

namespace App\Contracts\Services;

use App\DTO\BaseDTO;
use App\DTO\SheetRangeDTO;

interface ReadDataServiceInterface
{

    public function readValues(BaseDTO $baseDTO, SheetRangeDTO $range): array;

    public function getColumnIndexes(BaseDTO $baseDTO, array $valueKeys, SheetRangeDTO $range): array;

}
