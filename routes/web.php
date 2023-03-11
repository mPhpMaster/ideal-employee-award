<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DirectBossController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\TechnicalCommitteeController;
use App\Http\Controllers\SupervisorCommitteeController;

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
// Route::redirect('/', \route('nova.login'));

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/panel/email/verify/{id}/{hash}', function(EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(Nova::url(Nova::$initialPath));
})->middleware([ 'throttle:6,1', 'auth', 'signed' ])->name('verification.verify');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('applications', ApplicationController::class);
        Route::resource('awards', AwardController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('users', UserController::class);
        Route::resource('direct-bosses', DirectBossController::class);
        Route::resource('employees', EmployeeController::class);
        Route::resource(
            'supervisor-committees',
            SupervisorCommitteeController::class
        );
        Route::resource(
            'technical-committees',
            TechnicalCommitteeController::class
        );
    });
