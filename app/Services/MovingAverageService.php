<?php

namespace App\Services;


use App\Contracts\Services\MovingAverageServiceInterface;
use App\Contracts\Services\ReadDataServiceInterface;
use App\Contracts\Services\WriteDataServiceInterface;
use App\DTO\BaseDTO;
use App\DTO\SheetRangeDTO;
use App\Exceptions\GoogleSheetApiServiceException;
use App\Exceptions\NotFoundColumnInGoogleSheetException;
use App\Helpers\Enums\General;
use App\Helpers\NumberToChar;
use App\Infrasturcure\Gateway\GoogleSheet\Connector;
use App\Infrasturcure\Repository\GoogleSheet\ReadingRepository;
use App\Infrasturcure\Repository\GoogleSheet\WritingRepository;
use Google\Exception;

class MovingAverageService implements MovingAverageServiceInterface
{
    public function __construct(private readonly ReadDataServiceInterface $readDataService,
    private readonly WriteDataServiceInterface $writeDataService)
    {
    }

    /**
     * Calculate the moving average of visitors' data from a Google Sheet.
     *
     * This function reads data from a Google Sheet using a provided BaseDTO and calculates
     * the moving average of the specified column.
     *
     * @param BaseDTO $baseDTO The data transfer object containing configuration and sheet information.
     *
     * @throws \Exception If there are any errors during the calculation or writing process.
     *
     * @return void
     */
    public function calculate(BaseDTO $baseDTO): void
    {
        // Try to find if the file contains Date and Visitors columns and return their positions.
        // Using 1:1 to get the first row only.
        $dateColumnName = config("google_sheet_config.date_column_name");
        $visitorsColumnName = config("google_sheet_config.visitors_column_name");

        // find each column index to get data later
        $indexes = $this->readDataService->getColumnIndexes($baseDTO, [$dateColumnName, $visitorsColumnName], new SheetRangeDTO(1, 1));

        // get char A to Z according to position number to match google sheet format
        $secondColumnIndex = NumberToChar::mapNumberToUpperCaseLetter($indexes[$visitorsColumnName]);

        // get values of visitors
        $secondDataValues = $this->readDataService->readValues($baseDTO, new SheetRangeDTO($secondColumnIndex, $secondColumnIndex));


        // Remove the first one that contains headers.
        $secondDataValuesArray = array_map(fn($item) => $item[0], $secondDataValues);
        array_shift($secondDataValuesArray);

        // Calculate the moving average.
        $movingAverageArray = $this->calculateMovingAverage($secondDataValuesArray,$baseDTO->getWindow());

        // Get the column index to write the result.
        $resultColumnName = config("google_sheet_config.moving_average_column_name");
        $columnResultIndex = $this->getResultColumnIndex($baseDTO,$resultColumnName);

        // Write the moving average values to the Google Sheet.
        $this->writeDataService->writeValues($baseDTO, $movingAverageArray, $columnResultIndex, 2);
    }
    /**
     * Get the column index for the specified result column name.
     *
     * This function determines the column index in the Google Sheet for the specified
     * result column name. If the column does not exist, it will be added.
     *
     * @param BaseDTO $baseDTO The data transfer object containing configuration and sheet information.
     * @param string $columnName The name of the result column.
     *
     * @return int The column index of the specified result column.
     *@throws \Exception If there are any errors during the process.
     *
     */
    private function getResultColumnIndex(BaseDTO $baseDTO, string $columnName): int
    {
//        $resultColumnName = array($columnName);
        // Get first row values which are headers
        $firstRowValues = $this->readDataService->readValues($baseDTO, new SheetRangeDTO(1, 1));

        // Check if the specified column name exists in the first row.
        $columnExisted = in_array($columnName, $firstRowValues[0]);

        $columnPosition = count($firstRowValues[0]);

        if (!$columnExisted) {
            $columnPosition = count($firstRowValues[0]) + 1;

            // Add the specified result column to the Google Sheet.
            $this->writeDataService->writeValues($baseDTO, array([$columnName]), $columnPosition, 1);
        }

        return $columnPosition;
    }

    /**
     * Calculate the moving average of a given array of values.
     *
     * This function calculates the moving average of an array of values using a specified
     * window size. It returns an array of calculated moving averages.
     *
     * @param array $values An array of numeric values for which the moving average will be calculated.
     * @param int $windowSize The size of the moving average window.
     *
     * @return array An array of calculated moving averages.
     */
    private function calculateMovingAverage(array $values, int $windowSize): array
    {
        $movingAverages = [];

        for ($i = 0; $i < count($values); $i++) {
            if ($i < $windowSize - 1) {
                $movingAverages[] = [$values[$i]];
            } else {
                $sum = 0;
                for ($j = $i - $windowSize + 1; $j <= $i; $j++) {
                    $sum += $values[$j];
                }
                $movingAverages[] = [number_format($sum / $windowSize, 4)];
            }
        }

        return $movingAverages;
    }
}
