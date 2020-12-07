@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
<p>the <middleware>google.com</middleware></p>
<p>the <middleware>yahoo.co.jp</middleware></p>
@endsection
@section('content')
  <p>ここが本文のコンテンツです。</p>
  <table>
  {{-- @foreach($data as $item) --}}
  {{-- <tr><th>{{$item['name']}}</th><td>{{$item['mail']}}</td></tr> --}}
  {{-- @endforeach --}}
  </table>
  <p>必要なだけ記述できます。</p>
  {{-- <p>'message' = {{$message}}</p>
  <p>'view_message' = {{$view_message}}</p> --}}
  <ul>
  {{-- @each('components.item', $data, 'item') --}}
  </ul>
  @component('components.message')
    @slot('msg_title')
    CAUTION!
    @endslot

    @slot('msg_content')
    これはメッセージの表示です。
    @endslot
  @endcomponent

  @include('components.subview',['msg_title'=>'OK', 'msg_content'=>'サブビュー'])
@endsection

@section('footer')
copyright 2020 .
@endsection