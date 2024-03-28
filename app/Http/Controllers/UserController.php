<?php

namespace App\Http\Controllers;

use Hash;
use App\Http\Requests\RegisterUser;
use App\Http\Requests\LoginUser;
use App\Models\User;

class UserController extends Controller
{
    public function register(RegisterUser $request)
    {
        try {
            $user = new User();
            $user->username = $request->username;
            $user->birthdate = $request->birthdate;
            $user->email = $request->email;
            $user->password = Hash::make($request->password, [
                'rounds' => 12
            ]);
            $user->role = 'normal';
            $user->save();
            return response()->json([
                'success' => true,
                'status_code' => 201,
                'message' => 'Utilisateur créé avec succès',
                'data' => $user,
            ], 201, [], JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'error' => true,
                'message' => 'Une erreur est survenue lors de l\'inscription',
                'error_message' => $e->getMessage(),
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function login(LoginUser $request)
    {
        if (auth()->attempt($request->only(['email', 'password']))) {
            $user = auth()->user();
            $token = $user->createToken('SecretPhrase_-Token')->plainTextToken;
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Connexion réussie',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'success' => false,
                'status_code' => 401,
                'error' => true,
                'message' => 'Identifiants incorrects',
            ], 401, [], JSON_UNESCAPED_UNICODE);
        }
    }

    public function logout()
    {
        if (auth()->user()) {
            auth()->user()->tokens()->delete();
            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'Déconnexion réussie',
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'success' => false,
                'status_code' => 401,
                'message' => 'Non authentifié',
            ], 401, [], JSON_UNESCAPED_UNICODE);

        }
    }
}
