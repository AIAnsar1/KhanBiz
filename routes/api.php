<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\{CanRolePermissions, RBAC};

use App\Http\Controllers\{
    EmailVerificationController,
    UserController,
    CompaniesController,
};




Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::prefix('/auth')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    Route::post('/check-user-token', [AuthController::class, 'checkUserToken']);
    Route::post('/update-your-self', [AuthController::class, 'updateYourself']);
})->middleware(['auth:api', RBAC::class]);


Route::post('/email-verification', [EmailVerificationController::class, 'sendEmailVerification']);
Route::post('/check-email-verification', [EmailVerificationController::class, 'checkEmailVerification']);


Route::prefix('/application')->group( function (): void {
    // Route::apiResource('/companies', CompaniesController::class);

    Route::get('/companies', [CompaniesController::class, 'index']);
    Route::post('/companies', [CompaniesController::class, 'store']);
    Route::get('/companies/{company}', [CompaniesController::class, 'show']);
    Route::put('/companies/{company}', [CompaniesController::class, 'update']);
    Route::delete('/companies/{company}', [CompaniesController::class, 'destroy']);
})->middleware(['auth:api', RBAC::class]);

Route::apiResource('/application/users', UserController::class);










