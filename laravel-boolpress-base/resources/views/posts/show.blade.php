<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Documento</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>{{$post->title}}</h2>
          <small>Scritto da {{$post->author}}</small>
          <div>
            {!! $post->body !!}
            {{-- !! usiamo ESCAPE per evitare caratteri speciali, esempio text editor --}}
          </div>
          <img src="{{$post->img}}" alt="{{$post->title}}">
        </div>
      </div>
    </div>
  </body>
</html>
