<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::Create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $token = $user->createToken('PoojaLandageToken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response, 201);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response(['message'=>'LogOut Succesfully']);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            
            'email' => 'required|email|max:191',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password))
        {
            return response(['message'=>'Invalid Credentials'], 401); 
        }
        else
        {
            $token = $user->createToken('PoojaLandageToken')->plainTextToken;

            $response = [
                'user'=>$user,
                'token'=>$token,
            ];
    
            return response($response, 200);
        }
    }
}
