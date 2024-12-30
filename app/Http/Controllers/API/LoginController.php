<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Service\AuthLoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request, AuthLoginService $authLoginService)
    {
       return $authLoginService->logIn($request);
    }
}
