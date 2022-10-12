<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InboundTransactionsController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(UserController::class)->group(function () {
    Route::get('/User/index', 'index');
    Route::post('/User/create', 'create');
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
[OutboundTransactionsController::class, 'updateSend']); //LISTO


//INBOUND TRANSACTION UPDATE
Route::get('/InboundTransactions/inbound', [InboundTransactionsController::class, 'inbound']);

