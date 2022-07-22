<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\user;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function regiser(Request $request){
        $fields = $request->validate([
            "name"=>"required|string",
            "email"=>"required|unique:users,email",
            "password"=>"required|confirmed"
        ]);

        $user = User::create([
            "name"=>$fields['name'],
            "email"=>$fields['email'],
            "password"=>bcrypt($fields['password'])
        ]);

        $token = $user->createToken("userToken")->plainTextToken;
        $response = [
            "user"=>$user,
            "userToken"=>$token
        ];

        return response($response,201);


    }

    public function login(Request $request){
        $fields = $request->validate([
            "email"=>"required|string",
            "password"=>"required|string"
        ]);

        $user = User::where("email","=",$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->passwprd)) {
            return response([
                "messege"=>"Invalid Data",
            ],401);
        }

        $token = $user->createToken("userToken")->plainTextToken;
        $response = [
            "user"=>$user,
            "userToken"=>$token
        ];

        return response($response,201);


    }

        public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            "message"=>"Logout Done",
        ];
        }
}
