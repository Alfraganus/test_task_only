<?php

namespace App\Http\Service;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\PositionComfortCategory;
use App\DTO\CarSearchCriteria;
use App\Models\UserProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ApiCarSearchService
{
    public function getAvailableCars(CarSearchCriteria $criteria)
    {
        $filteredCars = $this->getFilteredCars($criteria);

        $bookedCarIds = $this->getBookedCarIds($criteria);

        return $this->filterAvailableCars($filteredCars, $bookedCarIds);
    }

    protected function getFilteredCars(CarSearchCriteria $criteria): Collection
    {
        $userPositionId = UserProfile::where('user_id',Auth::id())->value('position_id');

         return Car::query()
             ->when($criteria->carModelId, function ($query, $carModelId) {
                 $query->where('id', $carModelId);
             })
             ->when($criteria->comfortCategoryId, function ($query, $comfortCategoryId) {
                 $query->where('comfort_category_id', $comfortCategoryId);
             })
             ->when($userPositionId, function ($query, $userPositionId) {
                 $positionComfortCategoryIds = PositionComfortCategory::where('position_id', $userPositionId)
                     ->pluck('comfort_category_id');

                 $query->whereIn('comfort_category_id', $positionComfortCategoryIds);
             })
             ->get();
    }

    protected function getBookedCarIds(CarSearchCriteria $criteria): Collection
    {
        return CarBooking::where(function ($query) use ($criteria) {
            $query->whereBetween('start_time', [$criteria->startDate, $criteria->endDate])
                ->orWhereBetween('end_time', [$criteria->startDate, $criteria->endDate])
                ->orWhere(function ($query) use ($criteria) {
                    $query->where('start_time', '<=', $criteria->startDate)
                        ->where('end_time', '>=', $criteria->endDate);
                });
        })->pluck('car_id');
    }

    protected function filterAvailableCars(Collection $filteredCars, Collection $bookedCarIds): array
    {
        return $filteredCars->whereNotIn('id', $bookedCarIds)->all();
    }
}
