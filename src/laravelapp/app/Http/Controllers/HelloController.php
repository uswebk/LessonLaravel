<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function index(Request $request){
        // $data = [
        //     ['name'=>'one','mail'=>'one@email.com'],
        //     ['name'=>'two','mail'=>'two@email.com'],
        //     ['name'=>'three','mail'=>'three@email.com'],
        //     ['name'=>'four','mail'=>'four@email.com'],
        // ];
        // $message = "Hello";
        // return view('hello.index', ['data'=>$data,'message'=>$message]);
        // return view('hello.index', ['data'=>$request->data]);
        return view('hello.index', ['msg'=>"input!"]);
    }

    public function post(Request $request) {
        $validate_rule = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];

        $this->validate($request, $validate_rule);
        // return view('hello.index', ['msg'=> $request->msg]);
        return view('hello.index', ['msg'=> 'OK!']);
    }

    public function request(Request $request, Response $response) {
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

    public function other() {
        global $head, $style, $body, $end;

        $html = $head . tag('title', 'Hello/Other'). $style . $body
        . tag('h1', 'Other')
        . tag('p', 'This is Other page')
        . $end;
        return $html;
    }
}
