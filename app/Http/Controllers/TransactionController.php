<?php

namespace App\Http\Controllers;

use App\Cart;
use App\DetailTransaction;
use App\HeaderTransaction;
use App\Pokemon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class TransactionController extends Controller
{
    protected function insert (Request $request) {
        $transaction = new HeaderTransaction();

        $transaction->user_id = Auth::user()->id;
        $transaction->purchase_date = Carbon::now();
        $transaction->status = "pending";

        $transaction->save();

        $carts = Cart::all();

        foreach ($carts as $cart) {
            $detail = new DetailTransaction();
            $detail->transaction_id = $transaction->id;
            $detail->pokemon_id = $cart->pokemon_id;
            $detail->qty = $cart->qty;
            $detail->save();
        }

        Cart::truncate();

        return redirect('pokemon');
       // return view('detail-transaction', ['transaction' => $detail]);

    }

    protected function index_update () {
        if(Auth::check()){
            if(Auth::User()->role =='admin') {
                $transactions = HeaderTransaction::join('users', 'users.id', '=', 'header_transactions.user_id')->select('header_transactions.*', 'users.email')->get();
                return view('update-transaction', ['transactions' => $transactions]);
            }
        }
        return view('home');
    }

    protected function index_delete () {
        if(Auth::check()){
            if(Auth::User()->role =='admin') {
                $transactions = HeaderTransaction::join('users', 'users.id', '=', 'header_transactions.user_id')->select('header_transactions.*', 'users.email')->get();
                return view('delete-transaction', ['transactions' => $transactions]);
            }
        }
        return view('home');
    }

    protected function update_status (Request $request) {
        $transaction = HeaderTransaction::find($request->id);

        if ($request->btnStatus == "accept") {
            $transaction->status = "accept";
        } else if ($request->btnStatus == "decline") {
            $transaction->status = "decline";
        } else if ($request->btnStatus == "detail") {
            $total_qty = 0;
            $total_price = 0;
            $details = DetailTransaction::where('transaction_id', $transaction->id)->get();

            foreach ($details as $detail){
                $total_qty += $detail->qty;
                $total_price = $total_price + ($detail->qty * $detail->pokemon->price);
            }

            return view('/detail-transaction', ['details' => $details, 'total_qty' => $total_qty, 'total_price' =>$total_price]);
        }

        $transaction->save();

        return redirect('/update-transaction');
    }

    protected function delete (Request $request) {
        $details = DetailTransaction::where('transaction_id', $request->transaction_id);

        $details->delete();

        $transactions = HeaderTransaction::find($request->transaction_id);
        $transactions->delete();

        return redirect('/delete-transaction');
    }


}
