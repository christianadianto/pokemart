<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $date = new Carbon();
        $min_date = $date->subYears(10)->format('Y-m-d');

        $messages = array(
            'date_of_birth.before' => 'you must be older than 10 to register!',
            'password.alpha_num' => 'The password must contain letters and numbers',
        );

        return Validator::make($data, [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|alpha_num|confirmed',
            'profile_picture' => 'required|image|mimes:jpeg,jpg,png',
            'gender' => 'required',
            'date_of_birth' => 'required|date|date_format:Y-m-d|before:'.$min_date,
            'address' => 'required|min:10',
        ],$messages);
    }

    //register user
    public function regis(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
//            $this->throwValidationException(
//                $request, $validator
//            );
//            $err= $validator->getMessageBag()->first();
//            return response()->json(['err'=>$err]);
            return redirect()->back()->withErrors($validator);
        }

        //Auth::guard($this->getGuard())->login($this->create($request->all()));

        $imageName = $request->file('profile_picture')->getClientOriginalName();

        $request->file('profile_picture')->move(
            base_path() . '/public/assets/profiles/', $imageName
        );

        $this->create($request->all(),$imageName);
        
        return redirect('/login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data, $imageName)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'profile_picture' => 'assets/profiles/'.$imageName,
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'],
            'address' => $data['address'],
            'role' => 'member',
        ]);
    }
}
