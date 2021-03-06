<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectBeneficiaryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScopeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AgeCheck;
use App\Mail\UserWelcomeEmail;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('cms/admin', function () {
  return view('cms.parent');
});

Route::prefix('cms/')->middleware('guest:admin,user')->group(function () {

  Route::get('{guard}/login', [AuthController::class, 'showLoginView'])->name('cms.login');
  Route::post('login', [AuthController::class, 'login']);

  Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
  Route::post('forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
  Route::get('reset-password/{token}',[ResetPasswordController::class,'showResetPasswordView'])->name('password.reset');
  Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

});


Route::prefix('cms/admin')->middleware(['auth:admin,user','verified'])->group(function () {
 
  Route::view('/', 'cms.temp')->name('cms.dashboard');

  Route::resource('donors', DonorController::class);
  Route::resource('scopes', ScopeController::class);
  Route::resource('categories', CategoryController::class);
  Route::resource('beneficiaries', BeneficiaryController::class);
  Route::resource('users', UserController::class);
  Route::resource('projects', ProjectController::class);
  Route::resource('project-Beneficiary', ProjectBeneficiaryController::class);
  Route::resource('admins', AdminController::class);
  Route::resource('roles', RoleController::class);
  Route::resource('permissions', PermissionController::class);
  Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

  
});

Route::prefix('cms/admin')->middleware(['auth:admin,user','verified'])->group(function () {
 
  
  Route::get('roles/{role}/permissions/edit', [RoleController::class, 'editRolePermissions'])->name('roles.edit-permissions');
  Route::put('roles/{role}/permissions/edit', [RoleController::class, 'updateRolePermissions']);
  
  Route::get('users/{user}/permissions/edit', [UserController::class, 'editUserPermissions'])->name('user.edit-permissions');
  Route::put('users/{user}/permissions/edit', [UserController::class, 'updateUserPermissions']);

  Route::get('edit-password',[AuthController::class, 'editpassword'])->name('password.edit');
  Route::put('update-password',[AuthController::class, 'updatepassword']);
});
  

 
Route::prefix('cms/admin')->middleware(['auth:admin,user'])->group(function () {
  Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
  Route::get('send-verification',[EmailVerificationController::class, 'send'])->middleware('throttle:3,1')->name('verification.send');
  Route::get('verify/{id}/{hash}',[EmailVerificationController::class,'verify'])->middleware('signed')->name('verification.verify');

});


    //Route::get('news', function (){
   //  echo 'News Content Will appear here!';
   // dd(111);
  //  })->middleware('ageCheck');


 // Route::get('news', function (){
   //     echo 'News Content Will appear here!';
     //    dd(111);
       //  })->middleware(AgeCheck::class);


     //  Route::middleware('ageCheck:18,19,29')->group(function(){
       //    Route::get('new1',function(){
         //      echo 'News (1) content';
           //});
          // Route::get('new2',function(){
           // echo 'News (2) content';
        //})->withoutMiddleware('ageCheck');

       //});

       
Route::get('test-email', function () {
  return new UserWelcomeEmail(User::first());
});

