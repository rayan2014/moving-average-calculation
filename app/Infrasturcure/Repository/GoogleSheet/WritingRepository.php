<?php

namespace App\Infrasturcure\Repository\GoogleSheet;

use App\DTO\BaseDTO;
use App\DTO\WriteDataDTO;
use App\Exceptions\GoogleSheetApiServiceException;
use App\Exceptions\GoogleSheetGeneralException;
use App\Helpers\NumberToChar;
use App\Infrasturcure\Gateway\GoogleSheet\Connector;
use Google_Service_Sheets_ValueRange;

class WritingRepository implements \App\Contracts\GoogleSheet\WriteToGoogleSheetInterface
{

    public function __construct()
    {
    }

    /**
     * @throws GoogleSheetApiServiceException
     */
    public function writeToPosition(BaseDTO $baseDTO,WriteDataDTO $writeDataDTO): void
    {
        $connector = app(Connector::class);
        $service = $connector->setup();
        try {
            $position = NumberToChar::mapNumberToUpperCaseLetter($writeDataDTO->getColumn());
            $startRow = $writeDataDTO->getRow();
            $range = $baseDTO->getSheet() . '!' . $position . $startRow.':'.$position . count($writeDataDTO->getData())+1;

            $values = new Google_Service_Sheets_ValueRange([
                'values' => $writeDataDTO->getData()
            ]);

            $params = [
                'valueInputOption' => 'RAW'
            ];
            $service->spreadsheets_values->update($baseDTO->getDataSourceId(), $range, $values, $params);

        } catch (\Throwable $exception) {
            throw new GoogleSheetApiServiceException($exception->getMessage());
        }

    }
}
