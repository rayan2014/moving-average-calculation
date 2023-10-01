<?php

namespace App\Services;

use App\Contracts\GoogleSheet\WriteToGoogleSheetInterface;
use App\DTO\BaseDTO;
use App\DTO\WriteDataDTO;
use App\Exceptions\GoogleSheetApiServiceException;
use App\Infrasturcure\Repository\GoogleSheet\WritingRepository;

class WriteDataService implements \App\Contracts\Services\WriteDataServiceInterface
{

    public function __construct(private readonly WriteToGoogleSheetInterface $writingRepository){}


    public function writeValues(BaseDTO $baseDTO, array $values, string $column,string $row): void
    {
        $writingDTO = new WriteDataDTO($values,$row,$column);
        $this->writingRepository->writeToPosition($baseDTO,$writingDTO);
    }
}
