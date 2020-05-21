<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // helpers laravel, fa diventare la stringa della SLUG
use Illuminate\Support\Facades\Validator;
use App\Post; // importo il model POST
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
         $postsPublished = Post::where('published', 1)->get();
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
        return view('posts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $data = $request->all(); // prendo i dati dall' INPUT
       $data['slug'] = Str::slug($data['title'] , '-') . rand(1,100);
       $validator = Validator::make($data, [
           'title' => 'required|string|max:150',
           'body' => 'required',
           'author' => 'required'
       ]);
       if ($validator->fails()) {
           return redirect('posts/create')
               ->withErrors($validator)
               ->withInput();
       }
       $post = new Post;
       // $post->title = $data['title'];
       $post->fill($data);
       $saved = $post->save();
       if(!$saved) {
           dd('errore di salvataggio');
       }
       return redirect()->route('posts.show', $post->id);
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::where('id', $id)->first();
      return view('posts.show', compact('post'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
