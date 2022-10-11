<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;

class WalletController extends Controller
{
    function index(){

        try{

            $wallet = Wallet::all();

            if(!$wallet){
                return 'no hay cartera';
            }else{
                return response()->json($wallet);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }       
    }

    function validateCash($id, Request $request){     
        try{
            $send_wallet = Wallet::find($id);

            // dd($send_wallet);

            if($send_wallet == null || $send_wallet->current_amount<=$request->outbound_amount){
                return response()->json([
                    'error'=>'Saldo Insuficiente'
                ],404);
            }
            return true;
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }
    }


    function create(Request $request ){
        try{
            $request -> validate([
                'current_amount'=>'required|numeric',
                'id_user'=>'required|integer'

            ]);
            $wallet = Wallet::create([

                'current_amount'=> $request->current_amount,
                'id_user'=> $request->id_user

            ]);

            return response()->json($wallet);
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ], 404);
        }
    }


    function show($id){
        try{
            $wallet = Wallet::find($id);

            if(!$wallet){
              
                return 'No existe la cartera';
            }else{
                $wallet = Wallet::with(['user'])->find($id);
                return response()->json($wallet,200);
            };
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e -> getMessage()
            ], 404);
        }
        
    }

}
