<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        // $items = Person::all();
        $hasItems = Person::has('boards')->get();
        $noItems = Person::doesntHave('boards')->get();
        $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
        return view('person.index', $param);
    }

    public function find(Request $request)
    {
        return view('person.find', ['input' => '']);
    }

    public function search(Request $request)
    {
        $input = $request->input;
        $min = $request->input * 1;
        $max = $min + 10;
        // プライマリキー検索
        // $item = Person::find($input);
        // 条件検索
        // $item = Person::nameEqual($input)->first();
        $item = Person::ageGreaterThan($min)->ageLessThan($max)->first();
        $param = ['input' => $input, 'item' => $item];
        return view('person.find', $param);
    }

    public function add(Request $request)
    {
        return view('person.add');
    }

    public function create(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }

    public function edit(Request $request)
    {
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }
    public function delete(Request $request)
    {
        $person = Person::find($request->id);
        return view('person.del', ['form' => $person]);
    }

    public function remove(Request $request)
    {
        $person = Person::find($request->id)->delete();
        return redirect('/person');
    }
}
