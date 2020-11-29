<html>
<head>
<title>Hello/Index</title>
</head>
<style>
body {font-size:16pt; color:#999}
h1 {font-size:100pt; text-align:right; color:#eee; margin:-40px 0px -50px 0px;}
</style>
<body>
    <h1>Blade/Index</h1>
    <p>&#064;foreachディレクティブの例</p>
    @isset($data)
    @php
    $counter = 0;
    @endphp
    @while ($counter < count($data))
    <p>{{$data[$counter]}}</p>
    @php
    $counter++;
    @endphp
    @endwhile
    <ol>
      @for ($i=1; $i<100; $i++)
      @if ($i % 2 == 1)
        @continue
      @elseif ($i <= 10)
      <li>No, {{$i}}
      @else
        @break
      @endif
      @endfor
      </ol>
      @foreach ($data as $item)
      @if ($loop->first)
      <p>start</p>
      <ul>
      @endif
      <li>{{$loop->iteration}},{{$item}}</li>
      @if ($loop->last)
      </ul><p>end</p>
      @endif
      @endforeach
    </ol>
    @endisset
    @isset ($msg)
    <p>Hello {{$msg}} !</p>
    @else
    <p>Input!</p>
    @endisset
    <form method="POST" action="/hello">
      @csrf
      <input type="text" name="msg">
      <input type="submit">
    </from>
</body>
</html>
