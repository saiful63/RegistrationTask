<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class RegistrationController extends Controller
{
    //register view redirection

    public function register_view(){
        return view('register.register');
    }


    //register method for storing user information

    public function register(Request $request,User $user){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required'
        ]);

    $user_info = $user->create([
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'email'=>$request->email,
        'password'=> Hash::make($request->password)
    ]);

    if($user_info){
       return redirect()->route('register')->with('success','User registration successful');
    }
    }
}
