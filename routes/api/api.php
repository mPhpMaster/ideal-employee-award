<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\AwardController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DirectBossController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\AwardApplicationsController;
use App\Http\Controllers\Api\PositionEmployeesController;
use App\Http\Controllers\Api\TechnicalCommitteeController;
use App\Http\Controllers\Api\DirectBossEmployeesController;
use App\Http\Controllers\Api\SupervisorCommitteeController;
use App\Http\Controllers\Api\PositionDirectBossesController;
use App\Http\Controllers\Api\DirectBossApplicationsController;
use App\Http\Controllers\Api\TechnicalCommitteeApplicationsController;
use App\Http\Controllers\Api\SupervisorCommitteeApplicationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('applications', ApplicationController::class);

        Route::apiResource('awards', AwardController::class);

        // Award Applications
        Route::get('/awards/{award}/applications', [
            AwardApplicationsController::class,
            'index',
        ])->name('awards.applications.index');
        Route::post('/awards/{award}/applications', [
            AwardApplicationsController::class,
            'store',
        ])->name('awards.applications.store');

        Route::apiResource('positions', PositionController::class);

        // Position Employees
        Route::get('/positions/{position}/employees', [
            PositionEmployeesController::class,
            'index',
        ])->name('positions.employees.index');
        Route::post('/positions/{position}/employees', [
            PositionEmployeesController::class,
            'store',
        ])->name('positions.employees.store');

        // Position Direct Bosses
        Route::get('/positions/{position}/direct-bosses', [
            PositionDirectBossesController::class,
            'index',
        ])->name('positions.direct-bosses.index');
        Route::post('/positions/{position}/direct-bosses', [
            PositionDirectBossesController::class,
            'store',
        ])->name('positions.direct-bosses.store');

        Route::apiResource('users', UserController::class);

        Route::apiResource('direct-bosses', DirectBossController::class);

        // DirectBoss Employees
        Route::get('/direct-bosses/{directBoss}/employees', [
            DirectBossEmployeesController::class,
            'index',
        ])->name('direct-bosses.employees.index');
        Route::post('/direct-bosses/{directBoss}/employees', [
            DirectBossEmployeesController::class,
            'store',
        ])->name('direct-bosses.employees.store');

        // DirectBoss Applications
        Route::get('/direct-bosses/{directBoss}/applications', [
            DirectBossApplicationsController::class,
            'index',
        ])->name('direct-bosses.applications.index');
        Route::post('/direct-bosses/{directBoss}/applications', [
            DirectBossApplicationsController::class,
            'store',
        ])->name('direct-bosses.applications.store');

        Route::apiResource('employees', EmployeeController::class);

        Route::apiResource(
            'supervisor-committees',
            SupervisorCommitteeController::class
        );

        // SupervisorCommittee Applications
        Route::get(
            '/supervisor-committees/{supervisorCommittee}/applications',
            [SupervisorCommitteeApplicationsController::class, 'index']
        )->name('supervisor-committees.applications.index');
        Route::post(
            '/supervisor-committees/{supervisorCommittee}/applications',
            [SupervisorCommitteeApplicationsController::class, 'store']
        )->name('supervisor-committees.applications.store');

        Route::apiResource(
            'technical-committees',
            TechnicalCommitteeController::class
        );

        // TechnicalCommittee Applications
        Route::get('/technical-committees/{technicalCommittee}/applications', [
            TechnicalCommitteeApplicationsController::class,
            'index',
        ])->name('technical-committees.applications.index');
        Route::post('/technical-committees/{technicalCommittee}/applications', [
            TechnicalCommitteeApplicationsController::class,
            'store',
        ])->name('technical-committees.applications.store');
    });
