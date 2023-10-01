<?php

namespace App\Exceptions;

use App\Helpers\ApiHelper\ApiCode;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\ErrorResult;
use Exception;
use Illuminate\Http\Client\Request;

class NotFoundColumnInGoogleSheetException extends Exception
{
    public function render($request)
    {
        return ApiResponseHelper::sendErrorResponse(new ErrorResult($this->getMessage(),
            false,
            ApiCode::NOTFOUND));
    }
}
