<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Service\WebCarSearchService;
use App\DTO\CarSearchCriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class AvailableCarController extends BaseController
{
    protected $carSearchService;

    public function __construct(WebCarSearchService $carSearchService)
    {
        $this->carSearchService = $carSearchService;
    }

    public function filter(Request $request)
    {
        $users = User::all();

        $criteria = CarSearchCriteria::fromRequest($request);

        $availableCars = $this->carSearchService->filter($criteria);

        return view('admin.filter', compact('users', 'availableCars'));
    }
}
