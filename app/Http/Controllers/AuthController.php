<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;

class AuthController extends Controller
{
    //Register blade redirection
    public function register_view(){
        return view('auth.register');
    }

    //Login blade redirection
    public function index(){
        return view('auth.login');
    }


    //Craete user and login logic

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

        if(Auth::attempt($request->only('email','password')))
        {
            return redirect()->route('home');
        }else{
            return redirect()->route('register')->with('error','User registration fail');
        }
    }


    //Login logic for existing user

    public function login(Request $request){

    $request->validate([
            'email'=> 'required|email',
            'password'=>'required'
        ]);



    if(Auth::attempt($request->only('email','password')))
       {
        return redirect()->route('home');
       }else{
        return redirect()->route('login')->with('error','Login details are not valid');
       }
    }

    //Redirection to home blade after login

    public function home(){
        $users = User::all();
        return view('home',compact('users'));
    }

    //logout logic

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
