<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DivisionsController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestLeavesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TypeController;
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

Route::get('/', function () {
    return view('pages.home.index');
});

Route::get('/login', [LoginController::class, 'loginPage'])->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/calendar', [DashboardController::class, 'calendar'])->name('calendar');

    
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
    Route::get('/fetchManager', [UsersController::class, 'fetchAtasan'])->name('user.getManagers');
    Route::get('/get-position-level', [UsersController::class, 'getPositionLevel'])->name('user.getPositionLevel');    
    Route::get('/user/get-coo-id', [UsersController::class, 'getCooId'])->name('user.getCooId');

    // Route::get('/getManagers', [UsersController::class, 'getManagers'])->name('user.manager');
    // Route::get('/user/topManagers', [UsersController::class, 'getTopManagers'])->name('user.topManagers');
    // Route::get('/user/coo', [UsersController::class, 'getCOO'])->name('user.coo');
    // Route::get('/user/managersByDivisionAndLevel1', [UsersController::class, 'getManagersByDivisionAndLevel1'])->name('user.managersByDivisionAndLevel1');

    Route::resource('types', TypeController::class);
    Route::get('/detail/types/{id}', [TypeController::class, 'show'])->name('detail.types.show');
    Route::post('/type/restore/{id}', [TypeController::class, 'restore'])->name('type.restore');
    Route::delete('/type/force-delete/{id}', [TypeController::class, 'forceDelete'])->name('type.forceDelete');
    Route::get('/type/trashed', [TypeController::class, 'trashed'])->name('type.trashed');

    Route::resource('leaves', LeaveController::class);
    Route::get('/detail/leaves/{slug}', [LeaveController::class, 'show'])->name('detail.leaves.show');
    Route::post('/leave/restore/{slug}', [LeaveController::class, 'restore'])->name('leave.restore');
    Route::delete('/leave/force-delete/{slug}', [LeaveController::class, 'forceDelete'])->name('leave.forceDelete');
    Route::get('/leave/trashed', [LeaveController::class, 'trashed'])->name('leave.trashed');
    Route::get('/get-max-duration/{slug}', [LeaveController::class, 'getDuration'])->name('leave.duration');
    Route::post('/leave/validate', [LeaveController::class, 'validateLeave'])->name('leave.validate');
    Route::get('/export-pdf/{slug}', [LeaveController::class, 'exportPDF'])->name('export.pdf');
    Route::get('/get-leaves', [LeaveController::class, 'getLeaves'])->name('get-leaves');


    Route::resource('request-leave', RequestLeavesController::class);

    Route::middleware('check.manager.status')->group(function () {
        Route::get('request-leave/{request_leave}/edit', [RequestLeavesController::class, 'edit'])->name('request-leave.edit');
        Route::put('request-leave/{request_leave}', [RequestLeavesController::class, 'update'])->name('request-leave.update');
    });
        // Route::post('request-leave/{id}', [RequestLeavesController::class, 'update'])->name('request-leave.update');

    // Route::get('/detail/leaves/{id}', [LeaveController::class, 'show'])->name('detail.leaves.show');
    // Route::post('/leave/restore/{id}', [LeaveController::class, 'restore'])->name('leave.restore');
    // Route::delete('/leave/force-delete/{id}', [LeaveController::class, 'forceDelete'])->name('leave.forceDelete');
    // Route::get('/leave/trashed', [LeaveController::class, 'trashed'])->name('leave.trashed');
    // Route::get('/get-max-duration/{id}', [LeaveController::class, 'getDuration'])->name('leave.duration');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

