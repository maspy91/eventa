<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role_id' => 'required'
        ]);

        $user = User::create($validated);

        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken, 
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request){
        
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!Auth::attempt($validated)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken, 
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        
        return response()->json(['message' => 'Successfully logged out']);
    }
}
