<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Pokemon;
use Carbon\Carbon;
use App\Http\Requests;

class CommentController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'comment' => 'required|min:3',
        ]);
    }

    public function insert (Request $request) {

        $validator = $this->validator($request->all());

            if ($validator->fails()) {
                $err= $validator->getMessageBag()->first();
                return response()->json(['err'=>$err]);
        }

        $id = $request->id;
        $comments = new Comment();
        $comments->user_id = Auth::user()->id;
        $comments->pokemon_id = $request->id;
        $comments->comment = $request->comment;
        $comments->save();

        $pokemons = Pokemon::find($id);
        $comments = Pokemon::join('comments', 'pokemons.id', '=', 'comments.pokemon_id')
            ->join('users', 'users.id', '=', 'comments.user_id')->select('comments.*', 'users.email')
            ->where('pokemons.id' , '=', $id)->get();
        $elements = Pokemon::join('elements', 'pokemons.element_id', '=', 'elements.id')->select('elements.*')->where('pokemons.id', '=', $id)->get();

        return view('pokemon-detail')->with(['pokemons' => $pokemons, 'comments' => $comments, 'elements' => $elements]);
    }
}
