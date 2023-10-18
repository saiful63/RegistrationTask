<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Session;
use Hash;

class UserRoleController extends Controller
{
    //user role interface

    public function index(){
        $users = User::select('id','first_name')->where('first_name','<>','Admin')->get();
        $roles = DB::table('roles')->select('id','name')->get();
        $assigned_users_get_role = Role::all();
        return view('user_role',compact('users','roles','assigned_users_get_role'));
    }

    //Assign role to user

    public function roleAssign(Request $request){
       $user = User::findOrFail($request->user_id);
       $role = Role::findOrFail($request->role_id);
       if($user && $role){
           $user->syncRoles($role);

       }else{
           $user->assignRole($role);
       }
       return redirect()->route('user.role')->with('success','Role assigned successfully');
    }

    //Remove role from a particular user

    public function removeRole($role_id,$user_id){
       $role = Role::findById($role_id);
       $user = User::find($user_id);

       $removeRole = $user->removeRole($role);
       if($removeRole){
         return redirect()->route('user.role')->with('role_remove','Role removed from user Successfully');
       }
    }

    //User creation interface by admin

    public function userCreate(){
        $roles = DB::table('roles')->select('id','name')->get();
        return view('user_create_interface',compact('roles'));
    }

    //User creation by admin logic

    public function userDataCreate(Request $request,User $user){


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
          $lastUser = $user->latest()->first();
          $role_id = $request->role_id;
          $lastUser_id = $lastUser->id;
          $user = $user->findOrFail($lastUser_id);
          $role = Role::findOrFail($role_id);

          $user->assignRole($role);

          return redirect()->route('user.create.interface')->with('user_create','New user with role created Successfully');
        }
    }


}
