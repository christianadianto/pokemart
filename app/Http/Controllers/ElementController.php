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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|unique:elements',
        ]);
    }

    public function insert (Request $request) {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $err= $validator->getMessageBag()->first();
            return response()->json(['err'=>$err]);
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

    protected function update (Request $request, $id) {
        $element = Element::find($id);

        $element->name = $request->element-name;

        $element->save();

        return redirect('/search-element');

    }
}
