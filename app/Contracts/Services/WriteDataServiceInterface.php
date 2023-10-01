<?php

namespace App\Contracts\Services;

use App\DTO\BaseDTO;

interface WriteDataServiceInterface
{
    public function writeValues(BaseDTO $baseDTO, array $values, string $column,string $row): void;

}
