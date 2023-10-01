<?php

namespace App\Infrasturcure\Gateway\GoogleSheet;

use App\Exceptions\GoogleSheetApiServiceException;
use Google\Exception;
use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_BatchUpdateSpreadsheetRequest;
use Google_Service_Sheets_BatchUpdateValuesRequest;
use Google_Service_Sheets_ValueRange;

class Connector
{

    public function __construct(){}

    /**
     * @throws Exception
     */
    public function setup(): Google_Service_Sheets
    {
        // configure the Google Client
        try {
            $credentials = config('google_sheet_config.credentials');
            $client = new Google_Client();
            $client->setApplicationName('Google Sheets API');
            $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
            $client->setAccessType('offline');
            $client->setAuthConfig($credentials);
            // configure the Sheets Service
            return new Google_Service_Sheets($client);
        }catch (\Throwable $exception){
            throw new Exception($exception->getMessage());
        }

    }

}
