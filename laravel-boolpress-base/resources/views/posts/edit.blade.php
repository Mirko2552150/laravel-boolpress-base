{{-- @dd($post); --}}
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FORM</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    {{-- uso blade con il nome della nostra rotta cosi portiamo i dati del FORM alla nostra rotta per salvare --}}
    <form class="form-group" action="{{route('posts.update', $post->id)}}" method="POST">
      {{-- token per la sicurezza --}}
      @csrf
      {{-- inseriamo il metodo --}}
      @method('PUT')
      <div class="form-group">
        <label class="form-check-label" for="title">Titolo</label>
        <input name="title" class="form-control" type="text" placeholder="Inserisci i titolo" value="{{ (!empty(old('body'))) ? old('body') : $post->title }}">
        @error ('title') {{ $message }}@enderror
      </div>
      <div class="form-group">
        <label class="form-check-label" for="title">Autore</label>
        <input class="form-control" type="text" placeholder="Inserisci il nome dell'autore" name="author" value="{{ (!empty(old('author'))) ? old('author') : $post->author }}">
      </div>
      <div class="form-group">
        <label class="form-check-label" for="title">Immagine</label>
        <input class="form-control" type="text" placeholder="Inserisci il path" name="src" value="{{ (!empty(old('src'))) ? old('src') : $post->src }}">
      </div>
      <div class="form-group">
        <label class="form-check-label" for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label class="form-check-label" for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      </div>
      <div class="form-group">
        <label class="form-check-label" for="body">Testo</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body">{{ (!empty(old('body'))) ? old('body') : $post->body }}</textarea>
      </div>
      <div class="form-check">
        <label class="form-check-label" class="form-check-input" id="exampleCheck1" for="not-published">Non Pubblicato</label>
        <input type="radio" id="not-published" name="published" value="0" {{ ($post->published == 0) ? 'checked' : '' }}>
        <label for="published">Pubblicato</label>
        <input class="form-check-label" class="form-check-input" id="exampleCheck1" type="radio" id="published" name="published" value="1" {{ ($post->published == 1) ? 'checked' : '' }}>
      </div>
      <button value="Salva" type="submit" class="btn btn-primary">Submit</button>
    </form>
  </body>
</html>
