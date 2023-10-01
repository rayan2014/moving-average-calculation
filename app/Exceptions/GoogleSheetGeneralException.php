<?php

namespace App\Exceptions;

use App\Helpers\ApiHelper\ApiCode;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\ErrorResult;
use Exception;

class GoogleSheetGeneralException extends Exception
{
    public function render($request)
    {
        dd("sdf");
        return ApiResponseHelper::sendErrorResponse(new ErrorResult($this->getMessage(),
            false,
            ApiCode::NOTFOUND));
    }
}
