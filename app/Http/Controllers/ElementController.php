<?php

namespace App\Http\Controllers;

use App\Element;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class ElementController extends Controller
{
    public function index () {
        $elements = Element::all();

        return view('search-element', [
            'elements'  => $elements]);
    }

    public function index_update($id){
        return view('update-element')->with(['id'=>$id]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:elements',
        ]);
    }

    public function insert (Request $request) {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $this->create($request->all());

        return redirect('/search-element');
    }

    protected function create(array $data)
    {
        return Element::create([
            'name' => $data['name']
        ]);
    }

    protected function update (Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $element = Element::find($request->id);

        $element->name = $request["element-name"];

        $element->save();

        return redirect('/search-element');
    }

    public function redirect_to_update(Request $request){
        if($request->id != 0){
            return redirect()->route('search-element',['id'=>$request->id]);
        }

        return redirect()->back()->withErrors(['err' => 'Element name must be selected']);
    }


}
