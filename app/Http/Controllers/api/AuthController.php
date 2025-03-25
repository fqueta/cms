<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * 1|vohDWlfJFrs2l0mXJFX3SKxcBVcDZDhkkOqjfgtr3aab67aclad
 *
 */
class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email','password'))){
            return  response()->json(['message'=>'Authorized','status'=>200,'data'=>[
                        'token'=> $request->user()->createToken('developer')->plainTextToken
                    ],
            ]);
        }else{
            return  response()->json(['message'=>'Not Authorized','status'=>403]);

        }
    }
}
