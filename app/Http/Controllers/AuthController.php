<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends Controller
{
    private $key;

    public function __construct()
    {
        $this->key = env('JWT_SECRET');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => app('hash')->make($request->password),
            'is_admin' => false
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !app('hash')->check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $payload = [
            'iss' => "lumen-jwt",        // Issuer
            'sub' => $user->id,          // Subject (User ID)
            'iat' => time(),             // Issued at
            'exp' => time() + 60 * 60      // Expiration time (1 hour)
        ];

        $token = JWT::encode($payload, $this->key, 'HS256');

        return response()->json(['token' => $token]);
    }
}
