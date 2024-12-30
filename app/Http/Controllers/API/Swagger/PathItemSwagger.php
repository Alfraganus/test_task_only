<?php
namespace App\Http\Controllers\API\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Car Rental API",
 *     version="1.0.0",
 *     description="This API allows users to search for available cars based on booking dates and filters like car model and comfort category."
 * )
 * @OA\PathItem(
 *     path="/api/available-cars",
 *     summary="Get available cars for the user",
 *     description="Fetch the list of cars available for the logged-in user based on the provided date range and optional filters."
 * )
 */
class PathItemSwagger
{

}
