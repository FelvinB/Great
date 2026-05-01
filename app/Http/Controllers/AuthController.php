<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'string'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            if (! Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid Credentials',
                ]);
            }

            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Logged In Successfully',
                'token' => $token,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function register(Request $request)
    {
        try {
            info('test');
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return response()->json([
                'message' => 'User created Successfully',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ]);
        }

    }
}