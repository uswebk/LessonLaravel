<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;

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
        if ($request->hasCookie('msg'))
        {
            $msg = 'Cookie:' . $request->cookie('msg');
        } else {
            $msg = 'Not Cookie';
        }

        return view('hello.index', ['msg'=> $msg]);
        // $data = [
        //     ['name'=>'one','mail'=>'one@email.com'],
        //     ['name'=>'two','mail'=>'two@email.com'],
        //     ['name'=>'three','mail'=>'three@email.com'],
        //     ['name'=>'four','mail'=>'four@email.com'],
        // ];
        // $message = "Hello";
        // return view('hello.index', ['data'=>$data,'message'=>$message]);
        // return view('hello.index', ['data'=>$request->data]);
        $validator = Validator::make($request->query(), [
            'id' => 'required',
            'pass' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = 'クエリーに問題があります。';
        } else {
            $msg = 'ID/PASSを受け付けました。フォームを入力してください。';
        }
        return view('hello.index', ['msg'=>$msg ]);
    }

    public function post(Request $request)
    {
        // return view('hello.index', ['msg'=> 'OK!']);
        // $validate_rule = [
        //     'name' => 'required',
        //     'mail' => 'email',
        //     'age' => 'numeric|between:0,150',
        // ];

        // $this->validate($request, $validate_rule);
        // return view('hello.index', ['msg'=> $request->msg]);
        // $rules = [
        //     'name' => 'required',
        //     'mail' => 'email',
        //     'age' => 'numeric|hello',
        // ];
        // $messages = [
        //     'name.required' => '名前を入力してください',
        //     'mail.email' => 'メールアドレスが必要です',
        //     'age.numeric' => '年齢を整数で入力してください',
        //     'age.hello' => '偶数のみ受け付けます',
        //     'age.min' => '年齢は0歳以上で入力してください',
        //     'age.max' => '年齢は200歳以下で入力してください',
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);

        // $validator->sometimes('age', 'min:0', function($input){
        //     return !is_int($input->age);
        // });
        // $validator->sometimes('age', 'max:200', function($input){
        //     return !is_int($input->age);
        // });

        // if ($validator->fails()) {
        //     return redirect('/hello')->withErrors($validator)->withInput();
        // }
        // return view('hello.index', ['msg'=> 'OK!']);

        $validate_rule = [
            'msg' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $msg = $request->msg;
        $response = response()->view('hello.index', ['msg'=>'['.$msg.']を保存しました。']);
        $response->cookie('msg', $msg, 100);
        return $response;
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
}
