<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    //
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
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
}
