<?php


namespace App\Helpers\ApiHelper;


class ApiResponseHelper
{

    public static function sendResponse(Result $response)
    {
        return \Response::json([
            'success' => $response->isOk,
            'error_code' => null,
            'message' => $response->message,
            'data' => $response->result ?? null
        ], ApiResponseCodes::SUCCESS);
    }

    public static function sendSuccessResponse(SuccessResult $response)
    {
        return \Response::json([
            'success' => $response->isOk,
            'error_code' => null,
            'message' => $response->message,
            'data' => null
        ], ApiResponseCodes::SUCCESS);
    }

    public static function sendErrorResponse(ErrorResult $response)
    {
        return \Response::json([
            'success' => $response->isOk,
            'error_code' => $response->code,
            'message' => $response->message,
            'data' => null
        ], $response->code);
    }

}
