<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbound_Transactions;
use App\Models\Wallet;

class InboundTransactionsController extends Controller
{
    public function inbound(Request $request){
        try {
            $wallet1=$request->validate([
                'receive_wallet_id'=>'required|integer',
                'inbound_amount'=>'required|numeric'
            ]);

            $inbound=Inbound_Transactions::create([
                'inbound_amount'=>$wallet1['inbound_amount'],
                'receive_wallet_id'=>$wallet1['receive_wallet_id']

            ]);
            $carteraTodo = Wallet::all();
            $cartera1 = $carteraTodo->find($wallet1['receive_wallet_id']); //cartera es iguil a los datos de la wallet
            $valorCartera1 = $cartera1 -> current_amount; //valorcartera1 es igual al current_amount de la wallet
            $aumentoCartera1 = $valorCartera1 + $wallet1['inbound_amount']; //sumamos al amount el valor que introducio el usuario
            $cartera1 -> current_amount = $aumentoCartera1; //en cartera1 que es la walle tlo que hacemos es asignarle el nuevo valor
            $cartera1 -> save(); //guardamos en la base de datos,.
            return $cartera1;
            if(!$inbound){
            return response()->json(
                [
                    'message' => 'This transaction is invalid'
                ], 404
                );
            }
            return response()->json($inbound, 200);
       } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
       }  
    }
}
