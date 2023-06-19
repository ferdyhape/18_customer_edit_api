<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Autentikasi
Route::get('/login', [ViewController::class, 'login'])->name('login')->middleware('have-token');
Route::get('/register', [ViewController::class, 'register'])->name('register')->middleware('have-token');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// END Autentikasi

Route::middleware('auth-jwt')->group(function ($router) {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/', [ViewController::class, 'home'])->name('home');
    Route::get('/mitra', [ViewController::class, 'mitra'])->name('mitra');
    Route::get('/proses', [ViewController::class, 'proses'])->name('proses');
    Route::get('/riwayat', [ViewController::class, 'riwayat'])->name('riwayat');
    Route::get('/viewmitra/{id}', [ViewController::class, 'viewmitra'])->name('viewmitra');
    Route::get('/editprofile', [ViewController::class, 'editprofile'])->name('editprofile');
    Route::get('/ubahpassword', [ViewController::class, 'ubahpassword'])->name('ubahpassword');
    Route::get('/statusmitra', [PartnerController::class, 'mypartner'])->name('statusmitra');

    Route::get('/gabungmitra', [ViewController::class, 'gabungmitra'])->name('gabungmitra')->middleware('auth-jwt');
    Route::get('/editProfile', [ViewController::class, 'editProfile'])->name('editProfile')->middleware('auth-jwt');
    Route::post('/editProfile', [AuthController::class, 'editProfile']);
    Route::get('/avatar', [AuthController::class, 'getAvatar']);

    Route::post('updatePassword', [AuthController::class, 'updatePassword']);

    Route::post('/gabungmitra', [PartnerController::class, 'store'])->name('gabungmitra')->middleware('auth-jwt');
    Route::post('/call/{id}', [CallController::class, 'callNow'])->name('callNow');
    // PARTNER CMS
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/table', [DashboardController::class, 'table'])->name('tabledashboard');
        Route::get('/utilities-color', [DashboardController::class, 'utilities_color']);
        Route::get('/utilities-border', [DashboardController::class, 'utilities_border']);
        Route::get('/utilities-animation', [DashboardController::class, 'utilities_animation']);
        Route::get('/utilities-other', [DashboardController::class, 'utilities_other']);
        Route::get('/buttons', [DashboardController::class, 'buttons']);
        Route::get('/cards', [DashboardController::class, 'cards']);
        Route::get('/charts', [DashboardController::class, 'charts']);
        Route::get('/blank', [DashboardController::class, 'blank'])->name('blank');
        Route::get('/404', [DashboardController::class, 'error_404'])->name('404');
        Route::get('/login', [DashboardController::class, 'login'])->name('dashboardlogin');
        Route::get('/register', [DashboardController::class, 'register'])->name('dashboardregister');
        Route::get('/forgot-password', [DashboardController::class, 'forgot_password'])->name('dashboardforgorpassword');

        // Route::get('partner', function () {
        //     return view('dashboard.partner.index');
        // })->name('partner.index');

        Route::get('/order',    [DashboardController::class, 'orderList'])->name('dashboard.order.index');
        Route::post('/updateProgres/{id}',    [CallController::class, 'updateProgres']);
        Route::get('/order/cancel/{id}',    [CallController::class, 'orderCancel']);
        Route::post('editProfilePartner/{id}', [PartnerController::class, 'updateMitra']);
        Route::get('/transaction',    [ViewController::class, 'transactionList'])->name('dashboard.transaction.index');
        Route::post('/transaction/update/{id}',    [TransactionController::class, 'updateTransaction']);
        Route::view('/review',     'mitra.dashboard.review.index')->name('dashboard.review.index');
        Route::view('/history',   'mitrwa.dashboard.history.index')->name('dashboard.history.index');
        Route::get('/activation', [DashboardController::class, 'activation'])->name('dashboard.activation.index');
        Route::get('/profile',   [DashboardController::class, 'profile'])->name('dashboard.profile.index');
        Route::post('/profile/update_operational_status',   [PartnerController::class, 'OperationalStatusUpdate'])->name('dashboard.profile.index');
    });
    // END PARTNER CMS
});

Route::get('/tes', [ViewController::class, 'tes']);
