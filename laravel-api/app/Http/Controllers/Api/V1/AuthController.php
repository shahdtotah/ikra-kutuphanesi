<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Google_Client;

use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token,'id'=>\Auth::id()]);
    }

    public function user()
    {
        return response()->json(auth()->user());
    }
    public function loginWithGoogle(Request $request)
    {
    
        $googleToken = $request->input('token');
        if (!$googleToken) {

            return response()->json(['error' => 'Token is required'], 400);
        }

        try {
    
            $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
           
            $payload = $client->verifyIdToken($googleToken);

            if ($payload) {
                $email = $payload['email'];
                $name = $payload['name'];

                $user = User::firstOrCreate(
                    ['email' => $email],
                    ['name' => $name, 'password' => bcrypt(uniqid())]
                );

                $token = JWTAuth::fromUser($user);

                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    'user' => $user
                ], 200);
            } else {
                return response()->json(['error' => 'Invalid Google token'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong', 'details' => $e->getMessage()], 500);
        }
    }
}
