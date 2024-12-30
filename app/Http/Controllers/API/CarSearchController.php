<?php

namespace App\Http\Controllers\API;

use App\DTO\CarSearchCriteria;
use App\Http\Service\ApiCarSearchService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CarSearchController extends BaseController
{
    protected $carSearchService;

    public function __construct(ApiCarSearchService $carSearchService)
    {
        $this->carSearchService = $carSearchService;
    }
    public function getAvailableCars(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'car_model_id' => 'nullable|integer',
            'comfort_category_id' => 'nullable|exists:comfort_categories,id',
        ]);

        $criteria = CarSearchCriteria::fromRequest($request);
        $availableCars = $this->carSearchService->getAvailableCars($criteria);

        return response()->json([
            'available_cars' => $availableCars
        ]);
    }
}
