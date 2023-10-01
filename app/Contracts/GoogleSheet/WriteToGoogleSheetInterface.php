<?php

namespace App\Contracts\GoogleSheet;

use App\DTO\BaseDTO;
use App\DTO\WriteDataDTO;

interface WriteToGoogleSheetInterface
{
    public function writeToPosition(BaseDTO $baseDTO,WriteDataDTO $writeDataDTO);

}
