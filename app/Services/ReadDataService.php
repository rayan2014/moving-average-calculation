<?php

namespace App\Services;

use App\Contracts\GoogleSheet\ReadFromGoogleSheetInterface;
use App\Contracts\Services\ReadDataServiceInterface;
use App\DTO\BaseDTO;
use App\DTO\SheetRangeDTO;
use App\Exceptions\NotFoundColumnInGoogleSheetException;
use App\Infrasturcure\Repository\GoogleSheet\ReadingRepository;
use Google\Exception;

class ReadDataService implements ReadDataServiceInterface
{

    public function __construct(private readonly ReadFromGoogleSheetInterface $readingRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function readValues(BaseDTO $baseDTO, SheetRangeDTO $range): array
    {
        return $this->readingRepository->readRange($baseDTO->getDataSourceId(),
            $baseDTO->getSheet(),
            $range->getStart(),
            $range->getEnd());
    }

    /**
     * @throws Exception
     * @throws NotFoundColumnInGoogleSheetException
     */
    public function getColumnIndexes(BaseDTO $baseDTO, array $valueKeys, SheetRangeDTO $range): array
    {
        $valuesIndexes = [];
        $values = $this->readingRepository->readRange($baseDTO->getDataSourceId(),
            $baseDTO->getSheet(),
            $range->getStart(),
            $range->getEnd());
        foreach ($valueKeys as $valueKey) {
            $valueIndex = array_search($valueKey, $values[0]);
            if (!$valueIndex) {
                throw new NotFoundColumnInGoogleSheetException("Column " . $valueKey . " not found in the sheet");
            }
            $valuesIndexes[$valueKey] = $valueIndex + 1;
        }
        return $valuesIndexes;
    }

}
