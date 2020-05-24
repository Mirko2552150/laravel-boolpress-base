<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta charset="utf-8">
    <title>FORM</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    @foreach ($posts as $key => $post)
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{$post->src}}" alt="">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->body}}</p>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button class="btn btn-outline-primary" type="button" name="button"><a href="{{ route('posts.edit', $post->id) }}">Mofidica</a></button>
        </div>
        <div class="col-sm-10">
          <button class="btn btn-outline-success" type="button" name="button"><a href="{{ route('posts.show', $post->id) }}">Visualizza</a></button>
        </div>
        <div class="col-sm-10">
          <form method="POST" action="{{route('posts.destroy', $post->id)}}">
            @method('DELETE')
            @csrf
            <button class="btn btn-outline-danger" type="submit" name="button">Elimina</button>
          </form>
        </div>
      </div>
    @endforeach
    <td>{{ $posts->links() }}</td>
  </body>
</html>
{{-- @foreach ($posts as $key => $post)
{{-- @dd($post->id) --}}
{{-- <h1>titolo: <a href="">{{$post->title}}</a></h1> --}}
{{-- {{route('posts.show), $post->id}} --}}
{{-- <h2>Autore: {{$post->author}}</h2> --}}
{{-- <p>{{$post->body}}</p>
<img src="{{$post->src}}" alt=""> --}}


{{-- @endforeach --}}
{{-- <h1>POST PUBBLICATI</h1>
@foreach ($postsPublished as $key => $postPublished)
<h1>titolo: {{$postPublished->title}}</h1>
<h2>Autore: {{$postPublished->author}}</h2>
<p>{{$postPublished->body}}</p>
<img src="{{$postPublished->src}}" alt="">
@endforeach --}}
