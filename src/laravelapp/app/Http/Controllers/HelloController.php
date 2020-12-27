<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;
use Illuminate\Support\Facades\DB;

global $head, $style, $body, $end;
$head = '<head></head>';
$style = <<<EOF
<style>
body {font-size:16pt; color:#999}
h1 {font-size:100pt; text-align:right; color:#eee; margin:-40px 0px -50px 0px;}
</style>
EOF;
$body = '</head><body>';
$end = '</body></html>';

function tag($tag, $txt) {
    return "<{$tag}>" . $txt . "</{$tag}>";
}


class HelloController extends Controller
{
    public function index(Request $request)
    {
        // if (isset($request->id))
        // {
        //     $param = ['id' => $request->id];
        //     $items = DB::select('select * from people where id = :id', $param);
        // } else {
        //     $items = DB::select('select * from people');
        // }
        if ($request->hasCookie('msg'))
        {
            $msg = 'Cookie:' . $request->cookie('msg');
        } else {
            $msg = 'Not Cookie';
        }

        // クエリビルダ
        // $items = DB::table('people')->get(['id','name']); // カラム指定
        $items = DB::table('people')->get();
        return view('hello.index', ['msg'=> $msg, 'items'=>$items]);
    }

    public function request(Request $request, Response $response)
    {
        global $head, $style, $body, $end;

        $html = $head . tag('title', 'Hello/Index'). $style . $body
                . tag('h1', 'Index')
                . tag('h3', 'Request')
                . tag('pre', $request)
                . tag('h3', 'Response')
                . tag('pre', $response)
                . $end;
        return $response->setContent($html);
    }

    public function other()
    {
        global $head, $style, $body, $end;

        $html = $head . tag('title', 'Hello/Other'). $style . $body
        . tag('h1', 'Other')
        . tag('p', 'This is Other page')
        . $end;
        return $html;
    }

    public function post(Request $request)
    {
        $items = DB::select('select * from people');
        return view('hello.index', ['item' => $items]);
    }

    public function add(Request $request)
    {
        return view('hello.add');
    }

    public function create(Request $request)
    {
        $param = [
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    public function edit(Request $request)
    {
        $param = ['id' => $request->id];
        // $items = DB::select('select * from people where id = :id', $param);
        $items = DB::table('people')->where('id', $request->id)->first();

        return view('hello.edit', ['form' => $items]);
    }

    public function update(Request $request)
    {
        $param = [
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
        ];

        // DB::update('update people set name = :name, mail = :mail, age = :age where id = :id', $param);
        DB::table('people')->where('id', $request->id)->update($param);
        return redirect('/hello');
    }
    public function del(Request $request)
    {
        $param = ['id' => $request->id];
        // $items_ = DB::select('select * from people where id = :id', $param);
        $items = DB::table('people')->where('id', $request->id)->first();

        return view('hello.del', ['form' => $items]);
    }

    public function remove(Request $request)
    {
        $param = [
            'id' => $request->id,
        ];

        // DB::delete('delete from people where id = :id', $param);
        DB::table('people')->where('id', $request->id)->delete();
        return redirect('/hello');
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $max = $request->max;
        $min = $request->min;
        // 条件
        // $items = DB::table('people')->where('name', 'like', '%'. $name . '%')->orWhere('mail', 'like', '%' . $name . '%')->get();
        $items = DB::table('people')->whereRaw('age >= ? and age <= ?', [$min, $max])->orderBy('age', 'asc')->offset(2)->limit(2)->get();
        return view('hello.show', ['items' => $items]);
    }
}
