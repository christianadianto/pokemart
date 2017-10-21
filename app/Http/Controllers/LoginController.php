<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    private function validator(array $data){
        return Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
    }

    public function checkUser(){
        if(Auth::check()){
            $user = Auth::user();
            return response()->json(['check'=>true,'user'=>$user]);
        }
        return response()->json(['check'=>false]);

    }



    protected function validateLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
//            $this->throwValidationException(
//                $request, $validator
//            );
            $err= $validator->getMessageBag()->first();
            return response()->json(['err'=>$err]);
        }

        if(!$user) {
            $err = 'user not found';
            return response()->json(['err' => $err]);
        }

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password]))
        {
            return redirect('/');
        }
        $err = 'Wrong username/password combination';
        return response()->json(['err' => $err]);

    }

}
