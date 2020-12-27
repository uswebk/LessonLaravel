@extends('layouts.helloapp')

@section('title', 'Show')

@section('menubar')
  @parent
  詳細ページ
@endsection

@section('content')
  @if ($items != null)
    @foreach ($items as $item)
    <table width="600px">
      <tr>
        <th width="15%">age:</th>
        <td width="10%">{{$item->age}}</td>
        <th width="15%">name:</th>
        <td width="20%">{{$item->name}}</td>
        <th width="15%">mail:</th>
        <td width="25%">{{$item->mail}}</td>
      </tr>
    </table>
    @endforeach
  @endif
@endsection

@section('footer')
copyright 2020 laravel.
@endsection