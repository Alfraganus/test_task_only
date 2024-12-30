<?php
namespace App\Http\Controllers\API\Swagger;

/**
 * @OA\Get(
 *     path="/api/available-cars",
 *     tags={"Task"},
 *     summary="Get available cars for the user based on the given criteria",
 *     description="Fetch the list of cars available for the logged-in user for a specified time range, with optional filters for model and comfort category.",
 *     operationId="getAvailableCars",
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Bearer token for accessing protected endpoints. Format: Bearer {token}",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         ),
 *         example="Bearer 7|5xhwKbIvbm0ZoVQ6lqwOYoOkSeawniYiVEsVyNSnb79c5ece"
 *     ),
 *     @OA\Parameter(
 *         name="start_date",
 *         in="query",
 *         description="The start date of the booking (must be in the format YYYY-MM-DD)",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format="date"
 *         ),
 *      example="2025-01-03"
 *     ),
 *     @OA\Parameter(
 *         name="end_date",
 *         in="query",
 *         description="The end date of the booking (must be in the format YYYY-MM-DD)",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             format="date"
 *         ),
 *      example="2025-01-05"
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successfully retrieved the list of available cars",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="available_cars",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="model", type="string"),
 *                     @OA\Property(property="comfort_category_id", type="integer"),
 *                     @OA\Property(property="license_plate", type="string")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Unauthenticated.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Bad Request. Validation errors for the query parameters.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="error", type="string")
 *         )
 *     )
 * )
 */
class AvailableCarsSwagger {}
