<h1>ciao</h1>
@foreach ($posts as $key => $post)
<h1>titolo: {{$post->title}}</h1>
@endforeach
@foreach ($postsPublished as $key => $postPublished)
<h1>titolo: {{$postPublished->title}}</h1>
@endforeach
