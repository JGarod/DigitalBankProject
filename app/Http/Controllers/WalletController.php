<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

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
}
