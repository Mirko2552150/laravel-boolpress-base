<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // helpers laravel, fa diventare la stringa della SLUG
use Illuminate\Support\Facades\Validator; // importo il nostro validator, per il check dei campi del form
use App\Post; // importo il model POST
use Carbon\Carbon;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $posts = Post::all(); // prendo tutti i RECORD
         $postsPublished = Post::where('published', 1)->get(); // prendo i dati filtrati
         // dd($posts);
         return view('posts.index', compact('posts', 'postsPublished'));

     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); // mi ritorna sempre la PAG CREATE NON DINAMICA
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request) // prende i dati dal FORM, il request e' un oggetto
     {
       $data = $request->all(); // prendo gli attributi dall' FORM
       $now = Carbon::now()->format('Y-m-d-H-i-s');
       $data['slug'] = Str::slug($data['title'] , '-') . $now; // helpers per lavorare per stringhe
       $validator = Validator::make($data, [ // scrivo i controlli del validator
           'title' => 'required|string|max:150',
           'body' => 'required',
           'src' => 'required',
           'published' => 'required',
           'author' => 'required'
       ]);
       if ($validator->fails()) {
           return redirect('posts/create') // dinamica
               ->withErrors($validator) // mi permette di usare @errors
               ->withInput(); // mantiene i file corretti inseriti dall'utente, mi permette di usare OLD
       }
       $post = new Post;
       // $post->title = $data['title'];
       if(empty($data['src'])) {
         $data['src'] = 'mio path';
       }
       $post->fill($data); // nel model inserisco in FILLABLE i nomi della colonne da compilare
       $saved = $post->save();
       if(!$saved) {
           dd('errore di salvataggio');
       }
       // se usiamo redirect e NON view cambia la URI, come click sul un lin
       // return redirect()->route('posts.show', $post->slug); // restituisco all ROUTE lo SLUG creato dal title
       return redirect()->route('posts.show', $post->id); // restituisco all ROUTE lo SLUG creato dal title ROTTE DINAMICHE
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($slug) // prende in ingresso l-attributo dal RETURN della funzione STORE e cerca quel record
    public function show($id) // prende in ingresso l-attributo dal RETURN della funzione STORE e cerca quel record
    {
      $post = Post::where('id', $id)->first();
      // $post = Post::find($id)->get(); // mi cerca id corrispondente per SHOW
      // $post = Post::where('slug', $slug)->first();
      if (empty($post)) {
        abort('404');
      }
      return view('posts.show', compact('post')); // ritorno un solo dato all posts.show, la VAR post

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $Post // modifico il parametro in ingresso
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) // come se fosse un FIND
    {
      if (empty($post)) {
        abort('404');
      }
      // dd($Post);
      return view('posts.edit', compact('post')); // gli ritorno la VAR POST
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // simile a Store ma con l'ID che prediamo dalla rotta
    {
      // $post = Post::find($id);
      $post = Post::where('id', $id)->first();
      if (empty($post)) {
        abort('404');
      }

      $data = $request->all(); // prendo gli attributi dall' FORM
      // $now = Carbon::now()->format('Y-m-d-H-i-s');
      // dd($data['title']);
      $data['slug'] = Str::slug($data['title'] , '-') . $id; // helpers per lavorare per stringhe
      $validator = Validator::make($data, [ // scrivo i controlli del validator
          'title' => 'required|string|max:150',
          'body' => 'required',
          'src' => 'required',
          'published' => 'required',
          'author' => 'required'
      ]);
      if ($validator->fails()) {
          return redirect('posts/create') // dinamica
              ->withErrors($validator) // mi permette di usare @errors
              ->withInput(); // mantiene i file corretti inseriti dall'utente, mi permette di usare OLD
      }

      // if(empty($data['src'])) {
      //   $data['src'] = 'mio path';
      // }

      $post->fill($data); // nel model inserisco in FILLABLE i nomi della colonne da compilare
      $saved = $post->update();

      if(!$post) {
          dd('errore di salvataggio');
      }

      return redirect()->route('posts.show', $post->id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // prendo in ingresso l ID dal FORM
    {
      $post = Post::find($id);
      // dd($id);
      if (empty($post)) {
        abort('404');
      }

      $post->delete();

      return redirect()->route('posts.index');
    }
}
