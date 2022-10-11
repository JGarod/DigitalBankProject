<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\VarDumper\VarDumper;

class UserController extends Controller

{
    function index(){
        try{
            $user = User::all();
            if(!$user){
                return 'no hay usuarios';
            }else{
                return response()->json($user);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }

    }

    function create(Request $request){
        try{
            $request->validate([
                'NIT'=>'required|numeric',
                'email'=>'required|string',
                'password'=>'required|string',
                'name'=>'required|string',
                'phone'=>'required|string'
            ]);

            $user = User::create([

                'NIT'=> $request -> NIT,
                'email'=> $request -> email,
                'password'=> $request -> password,
                
                'name'=> $request -> name ,
                'phone'=> $request -> phone

            ]);

            return response()->json($user);
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e-> getMessage()
            ],404);
        }

        
    }

    public function authentication(Request $request){
        
        $request->validate([
            'email' => 'required|string',
            'password' => 'required'
        ]);
        
        
        $email = User::where('email',$request -> email)->first();
        $pass = User::where('password',$request -> password)->first();
        
        if($email){
             if($pass){

                // $user = User::find($email->id);
            
                // $wallet = Wallet::where('id_user',$user->id)->firts();
            
                // $users = DB::table('wallets')
                // ->where( 'id_user', $user->id)
                
                // ->select('current_amount')
                
                // ->first();
                
                $user = User::with('wallet')->first();

                
                
                return response()->json([
                    "message" => "Te has logeado Exitosamente!",
                    "name" =>$user->name,
                    "email" =>$user->email,
                    "NIT" => $user->NIT,
                    "Wallet Amount" => $user->wallet->current_amount
                    //$wallet->current_amount
                    ]);

             }else{
                return response()->json([
                    
                    "message" => "Error Contraseña erronea!"
                    ]);
             }
           

            
            
        }else{
            return response()->json([
                "status" => 400,
                "message" => "Error al logearse!"
                ]);
        }



    }
}