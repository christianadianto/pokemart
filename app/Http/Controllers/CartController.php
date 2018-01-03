<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Pokemon;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests;

class CartController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'qty' => 'required|numeric|min:1',
        ]);
    }

    public function add_cart (Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $this->create($request->all());

        return redirect('pokemon');
    }

    public function index () {
        $user_id = Auth::id();

        $carts = Cart::where('user_id','like',$user_id)->get();

        $total_qty = 0;
        $total_price = 0;
        foreach ($carts as $cart){
            $total_qty += $cart->qty;
            $total_price = $total_price + ($cart->qty * $cart ->pokemon_price);
        }

        $carts = Cart::join('pokemons', 'pokemons.id', '=', 'carts.pokemon_id')
            ->join('users', 'users.id', '=', 'carts.user_id')
            ->select('carts.*', 'pokemons.image', 'pokemons.name')
            ->where('user_id','like',$user_id)->get();


        return view('cart', [
            'carts'  => $carts, 'total_qty' => $total_qty, 'total_price' =>$total_price]);

    }

    protected function create(array $data)
    {
        return Cart::create([
            'pokemon_id' => $data['id'],
            'user_id' => Auth::id(),
            'qty' => $data['qty'],
            'pokemon_price' => $data['price']
        ]);
    }

    protected function delete (Request $request) {
        $cart = Cart::find($request->id);
        $cart->delete();

        return redirect()->back();
    }

    protected function delete_all () {
        $carts = Cart::all();

        $carts->delete();

        return view('home');
    }
}
