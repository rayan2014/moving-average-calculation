<?php

namespace App\Infrasturcure\Repository\GoogleSheet;

use App\DTO\BaseDTO;
use App\Exceptions\GoogleSheetApiServiceException;
use App\Exceptions\GoogleSheetGeneralException;
use App\Helpers\Enums\Constants;
use App\Infrasturcure\Gateway\GoogleSheet\Connector;
use Google\Exception;
use Google_Service_Exception;

class ReadingRepository implements \App\Contracts\GoogleSheet\ReadFromGoogleSheetInterface
{

    public function __construct()
    {
    }

    /**
     * @throws \Exception
     */
    public function readAll(string $sourceId, string $sheet): array
    {
        $connector = app(Connector::class);
        $service = $connector->setup();
        try {
            $range = $sheet; // here we use the name of the Sheet to get all the rows
            $response = $service->spreadsheets_values->get($sourceId, $range);
            $values = $response->getValues();

        } catch (\Exception $exception) {
            throw new $exception;
        }
        return $values;

    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function readRange(string $sourceId, string $sheet, string $min = '', string $max = ''): array
    {
        $connector = app(Connector::class);
        $service = $connector->setup();
        try {

            $range = $this->getRangeAsString($sheet,$min,$max); // here we use the name of the Sheet to get all the rows
            $response = $service->spreadsheets_values->get($sourceId, $range);
            $values = $response->getValues();

            if(empty($values)) throw new GoogleSheetGeneralException("sheet data error");

        } catch (\Throwable $exception) {
            throw new GoogleSheetApiServiceException($exception->getMessage());
        }
        return $values;
    }

    public function findCell(string $sourceId, string $sheet, string $valueOfCell): array
    {
        // TODO: Implement findCell() method.
    }

    private function getRangeAsString($sheetName, $min='', $max=''): string
    {
        $range = $sheetName;

        if (!empty($min)) $range .= '!' . $min;
        if (!empty($max) && !empty($min)) $range .= ':' . $max;

        return $range;
    }
}
