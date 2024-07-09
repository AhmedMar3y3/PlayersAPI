<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request){
        $request->validated($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);
        return $this->Success([
            'user' => $user,
            'token' => $user->createToken('Api token of '. $user->name)->plainTextToken
        ]);
    }
    public function login(LoginRequest $request){
        $request->validated($request->all());
        if(!Auth::attempt($request->only(['email','password']))){
            return $this->error('', 404, "Credintials do not match");
        }
        $user = User::where("email", $request->input('email'))->first();
        return $this->Success([
            'user' => $user,
            'token' => $user->createToken('Api token of '. $user->name)->plainTextToken
        ]
        );
    }
   
    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message'=> Auth::user()->name .' ,you have successfully logged out and your token has been deleted'
        ]);
    }
    
}


