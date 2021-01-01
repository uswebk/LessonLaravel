@extends('layouts.helloapp')

@section('title', 'Index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
@if (Auth::check())
<p>USER: {{$user->name . '(' . $user->email . ')'}}</p>
@else
<p>ログインしていません。(<a href="/login">ログイン</a>|<a href="/register">登録</a>)</p>
@endif
@if (count($errors) > 0)
  <p>Error!</p>
  @endif
  <form action="/hello" method="post">
    <table>
      @csrf
      @if ($errors->has('msg'))
      <tr>
        <th>ERROR</th>
        <td>{{$errors->first('msg')}}</td>
      </tr>
      @endif
      <tr>
        <th>Message:</th>
        <td><input type="text" name="msg" value="{{old('msg')}}"></td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" value="send"></td>
      </tr>
      @error('name')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror
      <tr>
        <th>name:</th>
        <td><input type="text" name="name" value={{old('name')}}></td>

      </tr>
      @error('mail')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror
      <tr>
        <th>mail:</th>
        <td><input type="text" name="mail" value={{old('mail')}}></td>
      </tr>
      @error('age')
      <tr>
        <th>Error</th>
        <td>{{$message}}</td>
      </tr>
      @enderror
      <tr>
        <th>age:</th>
        <td><input type="text" name="age" value={{old('age')}}></td>
      </tr>
      <tr>
        <th></th>
        <td><input type="submit" value="send"></td>
      </tr>
    </table>
  </form>


  <p>the <middleware>google.com</middleware></p>
  <p>the <middleware>yahoo.co.jp</middleware></p>

  <table>
    <tr>
      <th><a href="/hello?sort=name">NAME</a></th>
      <th><a href="/hello?sort=mail">MAIL</a></th>
      <th><a href="/hello?sort=age">AGE</a></th>
    </tr>
  @foreach ($items as $item)
  <tr>
    <td>{{$item->name}}</td>
    <td>{{$item->mail}}</td>
    <td>{{$item->age}}</td>
  </tr>
  @endforeach
  </table>
  {{$items->appends(['sort' => $sort])->links()}}
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