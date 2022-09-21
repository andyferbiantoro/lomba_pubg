<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [GlobalController::class, 'home']);

Route::middleware('auth')->group(function () {
    Route::get('tournament/follow', [TournamentController::class, 'follow']);

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    });

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/profile');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Link verifikasi sudah terkirim! Cek email anda.');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::get('profile', [ProfileController::class, 'show']);
    Route::put('profile/update-general', [ProfileController::class, 'updateGeneral']);
    Route::put('profile/update-foto', [ProfileController::class, 'updateFoto']);
    Route::put('profile/update-password', [ProfileController::class, 'updatePassword']);

    // tournament
    Route::get('tournament/add', [TournamentController::class, 'add']);
    Route::post('tournament/add', [TournamentController::class, 'store']);
    Route::get('tournament/edit/{slug}', [TournamentController::class, 'edit']);
    Route::put('tournament/edit/{slug}', [TournamentController::class, 'update']);
    Route::delete('tournament/detail/delete/{id}', [TournamentController::class, 'delete']);

    // daftar tournament
    Route::post('tournament/detail/{slug}', [TournamentController::class, 'daftar']);

    Route::get('transaksi', [TransactionController::class, 'index']);
    Route::get('transaksi/list', [TransactionController::class, 'list'])->name('transaksi.list');
    Route::get('transaksi/detail/{id}', [TransactionController::class, 'detail']);
    Route::put('transaksi/detail/{id}/upload-bukti', [TransactionController::class, 'uploadBukti']);
    
    
    
    Route::middleware('admin')->group(function() {
        // news
        Route::get('news/add', [NewsController::class, 'add']);
        Route::post('news/add', [NewsController::class, 'store']);
        Route::get('news/edit/{slug}', [NewsController::class, 'edit']);
        Route::put('news/edit/{slug}', [NewsController::class, 'update']);
        Route::delete('news/detail/delete/{id}', [NewsController::class, 'delete']);

         // pemenang
        Route::get('pemenang/edit/{slug}', [WinnerController::class, 'edit']);
        Route::put('pemenang/edit/{slug}', [WinnerController::class, 'update']);
        Route::delete('pemenang/detail/delete/{id}', [WinnerController::class, 'delete']);

        // user
        Route::get('user', [UserController::class, 'index']);
        Route::get('user/list', [UserController::class, 'list']);
        Route::get('user/detail/{id}', [UserController::class, 'show']);
        Route::delete('user/delete/{id}', [UserController::class, 'delete']);
        Route::post('user/edit-max-post/{id}', [UserController::class, 'editMaxPost']);
        Route::post('user/status-penyelenggara/{id}', [UserController::class, 'statusPenyelenggara']);

        // request penyelenggara
        Route::get('request-penyelenggara', [UserController::class, 'reqPenyelenggara']);
        Route::get('request-penyelenggara/list', [UserController::class, 'listReqPenyelenggara']);
        Route::put('request-penyelenggara/validasi/{id}', [UserController::class, 'validasiReqPenyelenggara']);
        Route::put('request-penyelenggara/reject/{id}', [UserController::class, 'rejectReqPenyelenggara']);


        Route::get('transaksi_admin', [TransactionController::class, 'transaksi_admin']);
        Route::post('tournament/update_link/{slug}', [TournamentController::class, 'update_link']);

        Route::put('transaksi/detail/{id}/reject', [TransactionController::class, 'reject']);
        Route::put('transaksi/detail/{id}/valid', [TransactionController::class, 'valid']);
    });
});

// news
Route::get('news', [NewsController::class, 'index']);
Route::get('news/search', [NewsController::class, 'search']);
Route::get('news/detail/{slug}', [NewsController::class, 'detail']);

// tournament
Route::get('tournament', [TournamentController::class, 'index']);
Route::get('tournament/detail/{slug}', [TournamentController::class, 'detail']);
Route::get('tournament/detail/{slug}/add-winner', [TournamentController::class, 'addWinner']);

// winner
Route::get('pemenang', [WinnerController::class, 'index']);
Route::get('pemenang/detail/{slug}', [WinnerController::class, 'detail']);
Route::get('pemenang/add/{slug}', [WinnerController::class, 'add']);
Route::post('pemenang/add', [WinnerController::class, 'store']);

Route::get('storage/images/tournament/thumbnail//{thumbnail}', 'HomeController@displayImage');
