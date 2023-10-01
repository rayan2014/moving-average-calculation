<?php

namespace App\Http\Controllers;

use App\Contracts\Services\MovingAverageCalculationServiceInterface;
use App\Contracts\Services\MovingAverageServiceInterface;
use App\DTO\BaseDTO;
use App\Exceptions\NotFoundColumnInGoogleSheetException;
use App\Helpers\ApiHelper\ApiResponseHelper;
use App\Helpers\ApiHelper\SuccessResult;
use App\Http\Requests\CalculateMovingAverageRequest;
use App\Infrasturcure\Gateway\GoogleSheet\Connector;
use App\Services\MovingAverageService;
use Google\Exception;
use Illuminate\Http\Request;

class MovingAverageCalculationController extends Controller
{


    public function __construct(private readonly MovingAverageServiceInterface $movingAverageService)
    {
    }


    public function __invoke(CalculateMovingAverageRequest $request)
    {
        $this->movingAverageService->calculate(BaseDTO::fromRequest($request->validated()));
        return ApiResponseHelper::sendSuccessResponse(new SuccessResult("Moving Average Generated Successfully"));
    }
}
