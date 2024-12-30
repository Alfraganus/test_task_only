<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Service\WebCarSearchService;
use App\DTO\CarSearchCriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

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
        $availableCars = [];

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $criteria = CarSearchCriteria::fromRequest($request);
            $availableCars = $this->carSearchService->filter($criteria);
        }

        return view('admin.filter', compact('users', 'availableCars'));
    }
}
