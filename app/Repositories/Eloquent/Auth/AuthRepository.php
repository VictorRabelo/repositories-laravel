<?php

namespace App\Repositories\Eloquent\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{

    public function logar($credentials){
        
        if (auth()->attempt($credentials)) {
                
            $user = auth()->user();
            $userRole = $user->role()->first();
            $user->role = $userRole->role;
            $token = $user->createToken(env('AUTH_TOKEN'), [$userRole->role]);
            $user->token = $token->accessToken;
                    
            return [
                'token' => $token, 
                'user' => $user
            ];
        }

        return false;
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token()->revoke();

        return true;
    }

    public function me()
    {
        $user = auth()->user();
        
        if(!$user) {
            return false;    
        }
        
        $user->role;

        return $user;
    }

    public function alterSenha(Request $request)
    {
        $params = $request->all();
        $user = auth()->user();

        $resp = User::where('id', $user->id)->first();
        
        if(empty($resp)){
            return false;
        }

        $resp->update(['password' =>  Hash::make($params['password'])]);
        $resp->save();
        
        return response()->json('Senha Atualizada', 201);
    }
}