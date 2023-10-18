<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profileGet(User $user){
        $user_profile = $user->where('id',Auth::user()->id)->first();
        return view('profile_get',compact('user_profile'));
    }

    public function updateProfile(Request $request,User $user){

        $user_info = $user->where('id',$request->user_id)->update([
            'first_name'=>$request->fn,
            'last_name'=>$request->ln,
            'email'=>$request->em
        ]);

        if($user_info){
            return redirect()->route('profile.get')->with('success','User data updated successfully');
        }


    }
}
