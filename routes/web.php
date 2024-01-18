<?php

use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', function (){
    return view('pages.admin.dashboard');
});

Route::resource('divisions', DivisionsController::class);
Route::get('/detail/divisions/{id}', [DivisionsController::class, 'show'])->name('detail.divisions.show');
Route::post('/division/restore/{id}', [DivisionsController::class, 'restore'])->name('division.restore');
Route::delete('/division/force-delete/{id}', [DivisionsController::class, 'forceDelete'])->name('division.forceDelete');
Route::get('/division/trashed', [DivisionsController::class, 'trashed'])->name('division.trashed');

Route::resource('positions', PositionsController::class);
Route::get('/detail/positions/{id}', [PositionsController::class, 'show'])->name('detail.positions.show');
Route::post('/position/restore/{id}', [PositionsController::class, 'restore'])->name('position.restore');
Route::delete('/position/force-delete/{id}', [PositionsController::class, 'forceDelete'])->name('position.forceDelete');
Route::get('/position/trashed', [PositionsController::class, 'trashed'])->name('position.trashed');

Route::resource('roles', RolesController::class);
Route::get('/detail/roles/{id}', [RolesController::class, 'show'])->name('detail.roles.show');
Route::post('/role/restore/{id}', [RolesController::class, 'restore'])->name('role.restore');
Route::delete('/role/force-delete/{id}', [RolesController::class, 'forceDelete'])->name('role.forceDelete');
Route::get('/role/trashed', [RolesController::class, 'trashed'])->name('role.trashed');

Route::resource('users', UsersController::class);
Route::get('/detail/users/{id}', [UsersController::class, 'show'])->name('detail.users.show');
Route::post('/user/restore/{id}', [UsersController::class, 'restore'])->name('user.restore');
Route::delete('/user/force-delete/{id}', [UsersController::class, 'forceDelete'])->name('user.forceDelete');
Route::get('/user/trashed', [UsersController::class, 'trashed'])->name('user.trashed');
Route::get('/getManagers', [UsersController::class, 'getManagers'])->name('user.manager');
Route::get('/user/topManagers', [UsersController::class, 'getTopManagers'])->name('user.topManagers');

