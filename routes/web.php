<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('home',[HomeController::class,'index'])->name('home')->middleware('auth');
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard')->middleware('auth');
Route::get('test',[TestController::class,'index']);


Route::get('patients', [PatientController::class,'index'])->name('patients.index')->middleware('auth');
Route::get('patients/form', [PatientController::class,'form'])->name('patients.form')->middleware('auth');
Route::post('getCaregivers', [PatientController::class,'getCaregivers']);
Route::post('getPatients', [PatientController::class,'getPatients']);
Route::post('checkPersonalId', [PatientController::class,'checkPersonalId']);
// Route::post('patients/store', [PatientController::class,'store'])->name('patients.store')->middleware('auth');
Route::resource('patients', PatientController::class)->only(['show','store','edit','update'])->middleware('auth');

Route::get('caregivers', [CaregiverController::class,'index'])->name('caregivers.index')->middleware('auth');
Route::get('caregivers/form', [CaregiverController::class,'form'])->name('caregivers.form')->middleware('auth');
Route::resource('caregivers', CaregiverController::class)->only(['store','edit','update'])->middleware('auth');
Route::post('checkPersonalId', [CaregiverController::class,'checkPersonalId']);

Route::get('users', [UserController::class,'index'])->name('users.index')->middleware('auth');
Route::get('users/form', [UserController::class,'form'])->name('users.form')->middleware('auth');
Route::resource('users', UserController::class)->only(['show']);
Route::resource('users', UserController::class)->only(['store','edit','update'])->middleware('auth');

Route::get('services', [ServiceController::class,'index'])->name('services.index')->middleware('auth');
Route::get('services/{id}/form/', [ServiceController::class,'form'])->name('services.form')->middleware('auth');
Route::resource('services', ServiceController::class)->only(['store','edit','update'])->middleware('auth');




Route::get('reports', [ReportController::class,'index'])->name('reports.index')->middleware('auth');



Route::get('convertBirthday',[TestController::class,'convertBirthday']);

Route::get('saraban', function () {
    return view('saraban');
})->name('saraban');

