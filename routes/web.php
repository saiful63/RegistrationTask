<?php
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;


//Route to get register view and storing user information

Route::get('/',[RegistrationController::class,'register_view'])->name('register');
Route::post('/user/register',[RegistrationController::class,'register'])->name('register.data');


