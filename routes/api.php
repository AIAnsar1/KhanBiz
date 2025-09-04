<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\{CanRolePermissions, RBAC};

use App\Http\Controllers\{
    EmailVerificationController,
    UserController,
    CompaniesController,
    CategoryController,
    TendersController,
    TenderBidsController,
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
    // Route::apiResource('/categories', CategoryController::class);
    // Route::apiResource('/tenders', TendersController::class);
    // Route::apiResource('/tender-bids', TenderBidsController::class);

    Route::get('/companies', [CompaniesController::class, 'index']);
    Route::post('/companies', [CompaniesController::class, 'store']);
    Route::get('/companies/{company}', [CompaniesController::class, 'show']);
    Route::put('/companies/{company}', [CompaniesController::class, 'update']);
    Route::delete('/companies/{company}', [CompaniesController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::get('/tenders', [TendersController::class, 'index']);
    Route::post('/tenders', [TendersController::class, 'store']);
    Route::get('/tenders/{tender}', [TendersController::class, 'show']);
    Route::put('/tenders/{tender}', [TendersController::class, 'update']);
    Route::delete('/tenders/{tender}', [TendersController::class, 'destroy']);

    Route::get('/tender-bids', [TenderBidsController::class, 'index']);
    Route::post('/tender-bids', [TenderBidsController::class, 'store']);
    Route::get('/tender-bids/{tenderBid}', [TenderBidsController::class, 'show']);
    Route::put('/tender-bids/{tenderBid}', [TenderBidsController::class, 'update']);
    Route::delete('/tender-bids/{tenderBid}', [TenderBidsController::class, 'destroy']);

    

})->middleware(['auth:api', RBAC::class]);

Route::apiResource('/application/users', UserController::class);










