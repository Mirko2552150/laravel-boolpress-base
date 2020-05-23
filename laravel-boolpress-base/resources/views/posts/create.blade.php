{{-- @dd($errors); --}}
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>FORM</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    {{-- uso blade con il nome della nostra rotta cosi portiamo i dati del FORM alla nostra rotta per salvare --}}
    <form class="form-group" action="{{route('posts.store')}}" method="POST">
      {{-- token per la sicurezza --}}
      @csrf
      {{-- inseriamo il metodo --}}
      @method('POST')
      <div class="form-group">
        <label class="form-check-label" for="title">Titolo</label>
        <input class="form-control" type="text" placeholder="Inserisci i titolo" value="{{ old('title') }}" name="title">
        {{-- stampo l'errore direttamente nell'INPUT --}}
        @error ('title') {{ $message }}@enderror
      </div>
      <div class="form-group">
        <label class="form-check-label" for="body">Testo</label>
        {{-- se il campo non e' vuoto inserisco il valore inserito nel campo oppure insrisco il testo INSERISCI UN TESTO --}}
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body">{{ (!empty(old('body'))) ? old('body') : 'inserisci un testooooooooooooo' }}</textarea>
      </div>
      <div class="form-group">
        <label class="form-check-label" for="title">Autore</label>
        <input class="form-control" type="text" placeholder="Inserisci il nome dell'autore" name="author">
      </div>
      <div class="form-group">
        <label class="form-check-label" for="title">Immagine</label>
        <input class="form-control" type="text" placeholder="Inserisci il path" name="src" value="{{ old('src') }}">
      </div>
      <div class="form-group">
        {{-- for associato all ID dell INPUT --}}
        <label class="form-check-label" for="not-published">Non Pubblicato</label>
        <input class="form-control" type="radio" id="not-published" name="published" value="0" {{ (old('published') == 0) ? 'checked' : '' }}>
        <label class="form-check-label" for="published">Pubblicato</label>
        <input class="form-control" type="radio" id="published" name="published" value="1" {{ (old('published') == 1) ? 'checked' : '' }}>
      </div>
      <div>
        <input class="form-control" type="submit" value="Salva">
      </div>
    </form>
  </body>
</html>
