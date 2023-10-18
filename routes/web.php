<?php
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

//Auth route
Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'login'])->name('login');
Route::get('/',[AuthController::class,'register_view'])->name('register');
Route::post('/',[AuthController::class,'register'])->name('register.data');


Route::middleware('auth')->group(function(){
  
  //Common route for authenticated user
  Route::get('/user/home',[AuthController::class,'home'])->name('home');
  Route::get('logout',[AuthController::class,'logout'])->name('logout');
  Route::get('get_profile',[ProfileController::class,'profileGet'])->name('profile.get');
  Route::post('update_profile',[ProfileController::class,'updateProfile'])->name('update.profile');

  //Route for user who have permission for create user and mange_role

  Route::middleware(['can:create_user,manage_role'])->group(function(){
     Route::get('user_role',[UserRoleController::class,'index'])->name('user.role');
     Route::post('role_assign',[UserRoleController::class,'roleAssign'])->name('role.assign');
     Route::get('remove_role/{role_id}/{user_id}',[UserRoleController::class,'removeRole'])->name('remove.role');

     Route::get('user_create_interface',[UserRoleController::class,'userCreate'])->name('user.create.interface');
     Route::post('user_create',[UserRoleController::class,'userDataCreate'])->name('user.create');
  });
});

