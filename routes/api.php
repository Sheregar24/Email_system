<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgetPasswordController;
use Illuminate\Support\Facades\Password;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [ApiController::class, 'authenticate']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/forgotpassword', [ForgetPasswordController::class,'forgotPassword'])->name('Password.email');
Route::post('/reset-password', [ForgetPasswordController::class, 'reset'])->name('Password.reset');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/logout', [ApiController::class, 'logout']);
    Route::get('/get_user', [ApiController::class, 'get_user']);
    Route::get('/verify-email/{id}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
    Route::get('/email/verification-notification', [EmailVerificationController::class, 'resend'])->name('verification.resend');


});

