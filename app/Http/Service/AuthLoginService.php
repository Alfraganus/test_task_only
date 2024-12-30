<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthLoginService
{
    public function logIn(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            if (!$user->hasRole('employee')) {
                return response()->json(['message' => 'Access denied. User is not an employee.'], 403);
            }

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'error' => false,
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage(),
            ],400);
        }
    }
}
