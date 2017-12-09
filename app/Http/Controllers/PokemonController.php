<?php

namespace App\Http\Controllers;

use App\Element;
use App\Pokemon;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PokemonController extends Controller
{

    public function index () {
        if(Auth::Check()){
            $pokemons = Pokemon::paginate(24);
            return view('pokemon')->with('pokemons', $pokemons);
        }
        return view('home');
    }

    public function list_update(){
        $pokemons = Pokemon::paginate(24);

        return view('list-update-pokemon')->with('pokemons', $pokemons);

    }

    public function search(Request $requests){
        if($requests->searchBy == "name"){
            $results = Pokemon::where('name','like','%'.$requests->txtSearch.'%')->paginate(24);
        }else{
            $results = Pokemon::join('elements', 'pokemons.element_id','=', 'elements.id')
                ->where('elements.name', 'like', '%'.$requests->txtSearch.'%')
                ->select('pokemons.*')
                ->paginate(24);
        }
        return view('pokemon')->with('pokemons', $results);
    }

    public function index_detail_pokemon ($id) {
        if(Auth::Check()) {
            $pokemons = Pokemon::find($id);

            $comments = Pokemon::join('comments', 'pokemons.id', '=', 'comments.pokemon_id')
                ->join('users', 'users.id', '=', 'comments.user_id')->select('comments.*', 'users.email')
                ->where('pokemons.id', '=', $id)->get();

            $elements = Pokemon::join('elements', 'pokemons.element_id', '=', 'elements.id')->select('elements.*')->where('pokemons.id', '=', $id)->get();

            return view('pokemon-detail')->with(['pokemons' => $pokemons, 'comments'=> $comments, 'elements' => $elements]);
        }

        return view('home');
    }

    public function index_detail_update_pokemon($id){
        if(Auth::Check()) {
            $pokemons = Pokemon::find($id);

            $comments = Pokemon::join('comments', 'pokemons.id', '=', 'comments.pokemon_id')
                ->join('users', 'users.id', '=', 'comments.user_id')->select('comments.*', 'users.email')
                ->where('pokemons.id', '=', $id)->get();

//            $elements = Pokemon::join('elements', 'pokemons.element_id', '=', 'elements.id')->select('elements.*')->where('pokemons.id', '=', $id)->get();
            $elements = Element::all();
            return view('update-pokemon')->with(['pokemons' => $pokemons, 'comments'=> $comments, 'elements' => $elements]);
        }

        return view('home');
    }

    public function index_insert_pokemon () {
        $elements = Element::all();

        return view('insert-pokemon', [
            'elements'  => $elements]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|alpha|min:3',
            'element' => 'not_in:0',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'gender' => 'required',
            'description' => 'required|alpha',
            'price' => 'required|numeric|min:1000',
        ]);
    }

    public function insert(Request $request){

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $err= $validator->getMessageBag()->first();
            return response()->json(['err'=>$err]);
        }
        $imageName = $request->file('image')->getClientOriginalName();

        $request->file('image')->move(
            base_path() . 'public/assets/pokemon_list/', $imageName
        );

        $this->create($request->all(),$imageName);

        return redirect('insert-pokemon');
    }

    protected function create(array $data,$imageName)
    {
        return Pokemon::create([
            'name' => $data['name'],
            'element' => $data['element'],
            'image' => $imageName,
            'gender' => $data['gender'],
            'description' => $data['description'],
            'price' => $data['price'],
        ]);
    }

    public function delete(Request $request){
        $pokemon = Pokemon::find($request->id);
        $pokemon->delete();

        return redirect()->back();
    }

    public function list_delete(){
        if(Auth::Check()){
            if(Auth::user()->role == 'admin') {
                $pokemons = Pokemon::paginate(24);
                return view('delete-pokemon')->with('pokemons', $pokemons);
            }
        }
        return view('home');
    }

    public function update(Request $request){
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $err= $validator->getMessageBag()->first();
            return response()->json(['err'=>$err]);
        }
        $imageName = $request->file('image')->getClientOriginalName();

        $request->file('image')->move(
            base_path() . 'public/assets/pokemon_list/', $imageName
        );


        $pokemon = Pokemon::find($request->id);
        $pokemon->name = $request['pokemon-name'];
        $pokemon->element_id = $request->element_id;
        $pokemon->gender = $request->gender;
        $pokemon->description = $request->description;
        $pokemon->price = $request->price;
        $pokemon->save();

        return redirect()->back();
    }


}
