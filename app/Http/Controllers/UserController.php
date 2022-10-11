<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
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

}
