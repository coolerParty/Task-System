<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\User\UserDashboardComponent;

use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserProfileEditComponent;

use App\Http\Livewire\User\UserTaskComponent;
use App\Http\Livewire\User\UserTaskAddComponent;
use App\Http\Livewire\User\UserTaskEditComponent;
use App\Http\Livewire\User\UserTaskViewComponent;

use App\Http\Livewire\Admin\AdminDashboardComponent;

use App\Http\Livewire\Admin\AdminCountryComponent;
use App\Http\Livewire\Admin\AdminCountryAddComponent;
use App\Http\Livewire\Admin\AdminCountryEditComponent;

use App\Http\Livewire\Admin\AdminProvinceComponent;
use App\Http\Livewire\Admin\AdminProvinceAddComponent;
use App\Http\Livewire\Admin\AdminProvinceEditComponent;

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

  Route::get('/', function () {
      // auth()->user()->assignRole('admin');  // to assign role admin in model_has_roles must be deleted after setting roles.
            return view('welcome');
  });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard'); 

// user
Route::group(['middleware'=> ['auth:sanctum','verified']], function(){

    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard'); 
    
    Route::get('/user/profile', UserProfileComponent::class)->name('user.profile'); 
    Route::get('/user/profile/edit', UserProfileEditComponent::class)->name('user.editprofile'); 

    Route::get('/user/task', UserTaskComponent::class)->name('user.task'); 
    Route::get('/user/task/add', UserTaskAddComponent::class)->name('user.addtask'); 
    Route::get('/user/task/edit/{task_id}', UserTaskEditComponent::class)->name('user.edittask'); 
    Route::get('/user/task/{task_slug}', UserTaskViewComponent::class)->name('user.viewtask'); 

});

// admin
Route::group(['middleware'=> ['auth:sanctum','role:admin']], function(){  

    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');

    Route::get('/admin/country', AdminCountryComponent::class)->name('admin.country'); 
    Route::get('/admin/country/add', AdminCountryAddComponent::class)->name('admin.addcountry'); 
    Route::get('/admin/country/edit/{country_id}', AdminCountryEditComponent::class)->name('admin.editcountry'); 

    Route::get('/admin/province', AdminProvinceComponent::class)->name('admin.province'); 
    Route::get('/admin/province/add', AdminProvinceAddComponent::class)->name('admin.addprovince'); 
    Route::get('/admin/province/edit/{province_id}', AdminProvinceEditComponent::class)->name('admin.editprovince'); 

});




