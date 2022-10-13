<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboundTransactionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\OutboundTransactionsController;

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

Route::post('/User/create',[UserController::class, 'create']);

Route::group([
    'prefix' => 'auth',
], function() {
    Route::group([
        'middleware' => 'auth:api',
    ], function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('logout', [AuthController::class, 'logout']);

    });
    
    Route::group([
    ], function() {
        Route::post('login', [AuthController::class, 'login']);
    });
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/User/index', 'index');
        // Route::post('/User/create', 'create');
        Route::post('/User/authentication', 'authentication');
    });
    //Route Users
    // Route::get('/User/index',[UserController::class, 'index']); //listo
    // Route::post('/User/create',[UserController::class, 'create']); //listo
    // Route::post('/User/authentication',[UserController::class, 'authentication']); //REVISAR DESPUES DE CREAR LA WALLET
    
    //Route Wallet
    Route::controller(WalletController::class)->group(function () {
        Route::get('/Wallet/index', 'index');
        Route::post('/Wallet/create', 'create');
        Route::get('/Wallet/show/{id}', 'show');
    });
    // Route::get('/Wallet/index',[WalletController::class, 'index']); //LISTO
    // Route::post('/Wallet/create',[WalletController::class, 'create']); //LISTO
    // Route::get('/Wallet/show/{id}',[WalletController::class, 'show']); //LISTO
    
    //Route Outbound 
    Route::put('/Outbound_Transactions/updateSend',
    [OutboundTransactionsController::class, 'updateSend']);
    
    Route::get('/Outbound_Transactions/show/{id}',
    [OutboundTransactionsController::class, 'show']); //LISTO
     
    //INBOUND TRANSACTION UPDATE
    Route::get('/InboundTransactions/inbound', [InboundTransactionsController::class, 'inbound']);
       
});