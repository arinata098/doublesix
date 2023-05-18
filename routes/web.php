<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('is_admin');

Route::middleware('is_admin')->group(function () {
    // dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard');

    // master department
    Route::get('/admin/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('master.department');
    Route::get('/admin/dep_create', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.create');
    Route::post('/admin/dep_store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
    Route::get('/dep_edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/admin/dep_update/{id}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/admin/dep_destroy/{id}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department.destroy');

    // master location
    Route::get('/admin/location', [App\Http\Controllers\LocationController::class, 'index'])->name('master.location');
    Route::get('/admin/loc_create', [App\Http\Controllers\LocationController::class, 'create'])->name('location.create');
    Route::post('/admin/loc_store', [App\Http\Controllers\LocationController::class, 'store'])->name('location.store');
    Route::get('/loc_edit/{id}', [App\Http\Controllers\LocationController::class, 'edit'])->name('location.edit');
    Route::post('/admin/loc_update/{id}', [App\Http\Controllers\LocationController::class, 'update'])->name('location.update');
    Route::delete('/admin/loc_destroy/{id}', [App\Http\Controllers\LocationController::class, 'destroy'])->name('location.destroy');


});
