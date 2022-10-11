<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
//Route Users
Route::get('/User/index',[UserController::class, 'index']);
Route::post('/User/create',[UserController::class, 'create']);
Route::post('/User/authentication',[UserController::class, 'authentication']);

//Route Wallet

Route::get('/Wallet/index',[WalletController::class, 'index']);
Route::post('/Wallet/create',[WalletController::class, 'create']);
Route::get('/Wallet/show/{id}',[WalletController::class, 'show']);

//Route Outbound 
Route::put('/Outbound_Transactions/updateSend',
[OutboundTransactionsController::class, 'updateSend']);

// Route::put('/Outbound_Transactions/updateR/{send_wallet_id}',
// [OutboundTransactionsController::class, 'update']);
