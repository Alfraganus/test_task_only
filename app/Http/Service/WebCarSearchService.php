<?php

namespace App\Http\Service;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\PositionComfortCategory;
use App\DTO\CarSearchCriteria;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class WebCarSearchService
{
    public function filter(CarSearchCriteria $criteria)
    {
        $filteredCars = $this->getFilteredCars($criteria);
        $bookedCarIds = $this->getBookedCarIds($criteria);

        return $this->getAvailableCars($filteredCars, $bookedCarIds);
    }

    protected function getFilteredCars(CarSearchCriteria $criteria): Collection
    {
        $userPositionIds = PositionComfortCategory::where('position_id', $criteria->userId)
            ->pluck('comfort_category_id');

        return Car::whereIn('comfort_category_id', $userPositionIds)->get();
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


    protected function getAvailableCars(Collection $filteredCars, Collection $bookedCarIds): array
    {
        return $filteredCars->whereNotIn('id', $bookedCarIds)->all();
    }
}
