<?php

namespace App\Exceptions;

use App\Helpers\ApiHelper\ApiCode;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\ErrorResult;
use Exception;
use Illuminate\Http\Client\Request;

class GoogleSheetApiServiceException extends Exception
{
    public function render($request)
    {

        $errorJson = json_decode($this->getMessage());
        $errorMsg = $errorJson?->error?->message ?? $this->getMessage() ?? "";
        $errorCode = $errorJson?->error?->code ?? ApiCode::NOTFOUND;
        return ApiResponseHelper::sendErrorResponse(new ErrorResult($errorMsg,
            false,
            $errorCode
        ));
    }
}
