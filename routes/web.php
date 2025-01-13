<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function () {
    return redirect()->route('candidates.index');
});

Route::middleware('guest:web')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'postLogin'])->name('login.post');
});

Route::middleware('auth:web')->group(function () {
    // candidates
    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
    Route::post('/candidates/update-stage', [CandidateController::class, 'updateStage'])->name('candidates.update.stage');
    Route::get('/candidates/{id}', [CandidateController::class, 'show'])->name('candidates.show');
    
    // email
    Route::post('/send-email/{candidateId}', [EmailController::class, 'sendEmail'])->name('send.email');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/application-form', [CandidateController::class, 'create']);
Route::post('/application-form', [CandidateController::class, 'store']);
