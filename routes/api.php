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
    AttachmentController,
    AuditLogsController,
    InvoiceController,
    PaymentController,
    ReviewController,
    ReportController,
    SubScriptionController,
    MessageController,
    PlanController,
    TenderQuestionController,
    
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
    // Route::apiResource('/attachments', AttachmentController::class);
    // Route::apiResource('/invoices', InvoiceController::class);
    // Route::apiResource('/payments', PaymentController::class);
    // Route::apiResource('/reviews', ReviewController::class);
    // Route::apiResource('/reports', ReportController::class);
    // Route::apiResource('/subscriptions', SubScriptionController::class);
    // Route::apiResource('/messages', MessageController::class);
    // Route::apiResource('/plans', PlanController::class);
    // Route::apiResource('/tender-questions', TenderQuestionController::class);
    // Route::apiResource('/audit-logs', AuditLogsController::class);

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

    Route::get('/tender-questions', [TenderQuestionController::class, 'index']);
    Route::post('/tender-questions', [TenderQuestionController::class, 'store']);
    Route::get('/tender-questions/{tenderQuestion}', [TenderQuestionController::class, 'show']);
    Route::put('/tender-questions/{tenderQuestion}', [TenderQuestionController::class, 'update']);
    Route::delete('/tender-questions/{tenderQuestion}', [TenderQuestionController::class, 'destroy']);

    Route::get('/attachments', [AttachmentController::class, 'index']);
    Route::post('/attachments', [AttachmentController::class, 'store']);
    Route::get('/attachments/{attachment}', [AttachmentController::class, 'show']);
    Route::put('/attachments/{attachment}', [AttachmentController::class, 'update']);
    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy']);

    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::post('/invoices', [InvoiceController::class, 'store']);
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show']);
    Route::put('/invoices/{invoice}', [InvoiceController::class, 'update']);
    Route::delete('/invoices/{invoice}', [InvoiceController::class, 'destroy']);

    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::get('/payments/{payment}', [PaymentController::class, 'show']);
    Route::put('/payments/{payment}', [PaymentController::class, 'update']);
    Route::delete('/payments/{payment}', [PaymentController::class, 'destroy']);

    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/reviews/{review}', [ReviewController::class, 'show']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);

    Route::get('/reports', [ReportController::class, 'index']);
    Route::post('/reports', [ReportController::class, 'store']);
    Route::get('/reports/{report}', [ReportController::class, 'show']);
    Route::put('/reports/{report}', [ReportController::class, 'update']);
    Route::delete('/reports/{report}', [ReportController::class, 'destroy']);

    Route::get('/sub-scriptions', [SubScriptionController::class, 'index']);
    Route::post('/sub-scriptions', [SubScriptionController::class, 'store']);
    Route::get('/sub-scriptions/{subScription}', [SubScriptionController::class, 'show']);
    Route::put('/sub-scriptions/{subScription}', [SubScriptionController::class, 'update']);
    Route::delete('/sub-scriptions/{subScription}', [SubScriptionController::class, 'destroy']);

    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/{message}', [MessageController::class, 'show']);
    Route::put('/messages/{message}', [MessageController::class, 'update']);
    Route::delete('/messages/{message}', [MessageController::class, 'destroy']);

    Route::get('/plans', [PlanController::class, 'index']);
    Route::post('/plans', [PlanController::class, 'store']);
    Route::get('/plans/{plan}', [PlanController::class, 'show']);
    Route::put('/plans/{plan}', [PlanController::class, 'update']);
    Route::delete('/plans/{plan}', [PlanController::class, 'destroy']);

    Route::get('/audit-logs', [AuditLogsController::class, 'index']);
    Route::post('/audit-logs', [AuditLogsController::class, 'store']);
    Route::get('/audit-logs/{auditLog}', [AuditLogsController::class, 'show']);
    Route::put('/audit-logs/{auditLog}', [AuditLogsController::class, 'update']);
    Route::delete('/audit-logs/{auditLog}', [AuditLogsController::class, 'destroy']);




})->middleware(['auth:api', RBAC::class]);

Route::apiResource('/application/users', UserController::class);










