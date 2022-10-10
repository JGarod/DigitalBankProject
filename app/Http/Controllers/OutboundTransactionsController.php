<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutboundTransactionsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'receive_wallet_id'=>'required|integer',
                'send_wallet_id'=>'required|integer',
                'outbound_amount'=>'required|numeric'
            ]);
        
            $outbound = Outbound_Transactions::create([
                'receive_wallet_id'=>$request->receive_wallet_id,
                'send_wallet_id'=>$request->send_wallet_id,
                'outbound_amount'=>$request->outbound_amount
            ]);
        
            return response()->json([
                'outbound' => $outbound
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $e->getMessage()
            ],400);
        }
    }
}


