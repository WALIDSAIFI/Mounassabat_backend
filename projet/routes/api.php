<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\userController;
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
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);

});
Route::get('/user/{id}', [UserController::class, 'indexUser']);
Route::get('/user', [UserController::class, 'indexToutUser']);
Route::post('/usersBLOK/{id}', [AdminController::class, 'blockUser']);
Route::get('/nombre/Sixjour',[AdminController::class, 'userCreationsLastSixDays']);
Route::get('/nombreBloker',[AdminController::class, 'countBlockedAndUnblockedUsers']);
Route::get('/unbolkerUser/{id}',[AdminController::class, 'unblockUser']);
Route::get('/nombreutilisateurBloker',[AdminController::class, 'nombreBolker']);
Route::get('/nombreutilisateurNomBloker',[AdminController::class, 'nombreNomBloker']);
Route::get('/userBloker',[AdminController::class, 'utilisateurBloker']);

