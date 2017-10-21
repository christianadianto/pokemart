<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        $date = new Carbon();
        $min_date = $date->subYears(10)->format('Y-m-d');

        $messages = array(
            'date_of_birth.before' => 'you must be older than 10 to register!',
        );

        return Validator::make($data, [
            'email' => 'required|email|unique:users',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png',
            'gender' => 'required',
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:'.$min_date,
            'address' => 'required|min:10',
        ],$messages);
    }

    public function index () {
        $users = User::all();

        return view('search-user', [
            'users'  => $users]);
    }

    public function getUser(array $data){
        $users = User::find($data);
        $user = $users[0];
        return $user;
    }

    public function getUpdateUser(Request $request){
        $user = $this->getUser($request->all());
        return view('update-user',['user' => $user]);
    }

    public function getDeleteUser(Request $request){
//        $user = $this->getUser($request->all());
//        return view('delete-user',['user' => $user]);
        $users = User::all();

        return view('delete-user', [
            'users'  => $users]);
    }

    public function updateUser(Request $request){
        $validator = $this->validator($request->all());
        $request->user;
        if ($validator->fails()) {
            $err= $validator->getMessageBag()->first();
            return response()->json(['err'=>$err]);
        }

        $user = User::where('id',$request->id)->first();

        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->address = $request->address;

        $imageName = $request->file('profile_picture')->getClientOriginalName();

        $request->file('profile_picture')->move(
            base_path() . '/public/assets/profiles/', $imageName
        );

        $user->profile_picture = 'assets/profiles/'.$imageName;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        return redirect()->back();
    }

    public function updateProfile(Request $request){
        $user = Auth::User();
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->address = $request->address;

        $imageName = $request->file('profile_picture')->getClientOriginalName();

        $request->file('profile_picture')->move(
            base_path() . '/public/assets/profiles/', $imageName
        );

        $user->profile_picture = 'assets/profiles/'.$imageName;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();
        return redirect('profile');
    }

    public function deleteUser(Request $request){
        $user = User::find($request->user);
        $user->delete();

        return redirect()->back();
    }


}
