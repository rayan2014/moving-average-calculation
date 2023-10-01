<?php

namespace App\Contracts\Services;

use App\DTO\BaseDTO;
use App\Helpers\Enums\General;

interface MovingAverageServiceInterface
{
    public function calculate(BaseDTO $baseDTO): void;

}
