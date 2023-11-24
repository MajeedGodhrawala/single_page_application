<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthContoller extends Controller
{
    public function createUser(UserFormRequest $request) :JsonResponse
    {
        User::create($request->requestedField());
        return response()->json(['success' => 'Record '.$request->first_name.' '.$request->last_name.' Is Added In Data']);
    }

    public function loginUser(LoginFormRequest $request) :JsonResponse
    {
        $credentials = [];
        if(Str::contains($request->email_phonenumber, '@')){
            $credentials = $request->requestedFieldEmail();
        } else if(Str::contains($request->email_phonenumber,['0','1','2','3','4','5','6','7','8','9'])) {
            $credentials = $request->requestedFieldPhoneNumber();
        } else {
            return response()->json([
                'login_error' => $request->email_phonenumber.' Not Found !!'
            ]);
        } 
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user){
               $token['token'] = $user->createToken($user->email)->plainTextToken;
            // $token['token'] = $user->createToken($user->email)->accessToken;
                return response()->json([
                    'success' => $user->first_name.' '.$user->last_name,
                    'token' => $token
                ]);
            }
        } else {
            return response()->json([
                'login_error' => 'Email Or Password Is Not Found !!'
            ]);
        }
    }
}
