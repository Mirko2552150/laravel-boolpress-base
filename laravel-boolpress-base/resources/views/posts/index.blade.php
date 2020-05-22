
@foreach ($posts as $key => $post)
{{-- @dd($post->id) --}}
<h1>titolo: <a href="">{{$post->title}}</a></h1>
{{-- {{route('posts.show), $post->id}} --}}
<h2>Autore: {{$post->author}}</h2>
<p>{{$post->body}}</p>
<img src="{{$post->src}}" alt="">
<a href="{{ route('posts.edit', $post->id) }}">Mofidica</a>
<a href="{{ route('posts.show', $post->id) }}">Visualizza</a>
<form method="POST" action="{{route('posts.destroy', $post->id)}}">
  @method('DELETE')
  @csrf
  <button type="submit" name="button">ELIMINA</button>
</form>
@endforeach
{{-- <h1>POST PUBBLICATI</h1>
@foreach ($postsPublished as $key => $postPublished)
<h1>titolo: {{$postPublished->title}}</h1>
<h2>Autore: {{$postPublished->author}}</h2>
<p>{{$postPublished->body}}</p>
<img src="{{$postPublished->src}}" alt="">
@endforeach --}}
