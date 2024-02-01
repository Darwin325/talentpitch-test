<?php

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProgramChallengeController;
use App\Http\Controllers\ProgramCompanyController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);
Route::apiResource('challenges', ChallengeController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('programs', ProgramController::class);

Route::apiResource('programs.companies', ProgramCompanyController::class)
    ->only(['index', 'store']);

Route::apiResource('programs.challenges', ProgramChallengeController::class)
    ->only(['index', 'store']);

Route::apiResource('programs.users', ProgramUserController::class)
    ->only(['index', 'store']);
