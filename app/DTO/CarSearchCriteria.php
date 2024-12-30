<?php

namespace App\DTO;

class CarSearchCriteria
{
    public $userId;
    public $startDate;
    public $endDate;
    public ?int $carModelId;
    public ?int $comfortCategoryId;

    public function __construct($userId, $startDate, $endDate, ?int $carModelId = null, ?int $comfortCategoryId = null)
    {
        $this->userId = $userId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->carModelId = $carModelId;
        $this->comfortCategoryId = $comfortCategoryId;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->user()->id,
            $request->start_date,
            $request->end_date,
            $request->car_model_id,
            $request->comfort_category_id
        );
    }
}
