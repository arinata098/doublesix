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
Route::get('/wo/request', [App\Http\Controllers\WorkOrderController::class, 'request'])->name('wo.request');
Route::get('/wo/my_request', [App\Http\Controllers\WorkOrderController::class, 'my_request'])->name('wo.my_request');
Route::post('/wo/store', [App\Http\Controllers\WorkOrderController::class, 'store'])->name('wo.store');
Route::get('/wo/received', [App\Http\Controllers\WorkOrderController::class, 'received'])->name('wo.received');
Route::get('/wo_edit/{id}', [App\Http\Controllers\WorkOrderController::class, 'edit'])->name('wo.edit');
Route::post('/wo_update/{id}', [App\Http\Controllers\WorkOrderController::class, 'update'])->name('wo.update');
Route::get('/wo_detail/{id}', [App\Http\Controllers\WorkOrderController::class, 'detail'])->name('wo.detail');


Route::middleware('is_admin')->group(function () {
    // dashboard
    Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/wo/report', [App\Http\Controllers\WorkOrderController::class, 'report'])->name('wo.report');

    // master department
    Route::get('/admin/user', [App\Http\Controllers\UserController::class, 'index'])->name('master.user');
    Route::get('/admin/user_create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/admin/user_store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/user_edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('/admin/user_update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::delete('/admin/user_estroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');



    // master department
    Route::get('/admin/department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('master.department');
    Route::get('/admin/dep_create', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.create');
    Route::post('/admin/dep_store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
    Route::get('/dep_edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/admin/dep_update/{id}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/admin/dep_destroy/{id}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department.destroy');
    
    // master position
    Route::get('/admin/position', [App\Http\Controllers\PositionController::class, 'index'])->name('master.position');
    Route::get('/admin/pos_create', [App\Http\Controllers\PositionController::class, 'create'])->name('position.create');
    Route::post('/admin/pos_store', [App\Http\Controllers\PositionController::class, 'store'])->name('position.store');
    Route::get('/pos_edit/{id}', [App\Http\Controllers\PositionController::class, 'edit'])->name('position.edit');
    Route::post('/admin/pos_update/{id}', [App\Http\Controllers\PositionController::class, 'update'])->name('position.update');
    Route::delete('/admin/pos_destroy/{id}', [App\Http\Controllers\PositionController::class, 'destroy'])->name('position.destroy');

    // master location
    Route::get('/admin/location', [App\Http\Controllers\LocationController::class, 'index'])->name('master.location');
    Route::get('/admin/loc_create', [App\Http\Controllers\LocationController::class, 'create'])->name('location.create');
    Route::post('/admin/loc_store', [App\Http\Controllers\LocationController::class, 'store'])->name('location.store');
    Route::get('/loc_edit/{id}', [App\Http\Controllers\LocationController::class, 'edit'])->name('location.edit');
    Route::post('/admin/loc_update/{id}', [App\Http\Controllers\LocationController::class, 'update'])->name('location.update');
    Route::delete('/admin/loc_destroy/{id}', [App\Http\Controllers\LocationController::class, 'destroy'])->name('location.destroy');

    // work category
    Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('work.category');
    Route::get('/admin/cate_create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
    Route::post('/admin/cate_store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/cate_edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/admin/cate_update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/admin/cate_destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.destroy');


});
