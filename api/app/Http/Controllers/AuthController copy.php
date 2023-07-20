<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    final public function login(AuthRequest $request): JsonResponse
    {
        $user = (new User())->getUserByEmailOrPhone($request->all());
        if($user && Hash::check($request->input('password'), $user->password))
        {
            $user_data['token'] = $user->createToken($user->email)->plainTextToken;
            $user_data['name'] = $user->name;
            $user_data['phone'] = $user->phone;
            $user_data['photo'] = $user->photo;
            $user_data['email'] = $user->email;
            return response()->json($user_data);
        }
        throw ValidationException::withMessage([
            'email' => ['The provided credentials are incorrect']
        ]);
    }
}
