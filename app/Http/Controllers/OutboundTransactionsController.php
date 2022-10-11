<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outbound_Transactions;
use App\Models\Wallet;
use App\Models\User;


class OutboundTransactionsController extends Controller
{
    public function updateSend(Request $request)
    {
        try {
            $wallet1=$request->validate([
                'receive_wallet_id'=>'required|integer',
                'send_wallet_id'=>'required|integer',
                'outbound_amount'=>'required|numeric'
            ]);
            $descuento = $wallet1['outbound_amount'];
            $cartera1 = Wallet::find($wallet1['receive_wallet_id']);//Este valor pertenece a la persona que recibe el dinero
            $cartera2 = Wallet::find($wallet1['send_wallet_id']);//Este valor pertenece a la persona que envia el dinero. Los tqm naifer <3 
            //Operaciones de la cartera1 que recibe.
            $valorCartera1 = $cartera1 -> current_amount;
            $aumentoCartera1 = $valorCartera1 + $descuento;
            //$updateWallet1 = Wallet::findOrFail($wallet1['receive_wallet_id']);
            $cartera1 -> current_amount = $aumentoCartera1;
            $cartera1 -> save();
            //Operaciones de la cartera2 que envia.
            $valorCartera2 = $cartera2 -> current_amount;
            $aumentoCartera2 = $valorCartera2 - $descuento;
            //$updateWallet2 = Wallet::findOrFail($wallet1['receive_wallet_id']);
            $cartera2 -> current_amount = $aumentoCartera2;
            $cartera2 -> save();
            //return $cartera1 -> current_amount;
            $prueba = Wallet::all();
            if(!$prueba){
            return response()->json(
                [
                    'message' => 'No wallet found'
                ], 404
                );
            }

            $outbound = Outbound_Transactions::create([
                'receive_wallet_id'=>$cartera1->id_user,
                'send_wallet_id'=>$cartera2->id_user,
                'outbound_amount'=>$descuento


            ]);
        
            return response()->json([
                $outbound
            ]);


            // return response()->json($prueba, 200);
       } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
       }
    }
}
