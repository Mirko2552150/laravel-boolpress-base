<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();
      // $user = Auth::id(); // id admin
      // $data['user_id'] = $user; // push
      $validator = Validator::make($data, [
            'name' => 'required|unique:categories|max:80',
            'email' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.categories.create')
                        ->withErrors($validator)
                        ->withInput();
        }
      dd('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::findOrFail($id);

      return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::findOrFail($id); // restituisce in auto 404
      return view('admin.users.edit', compact('user')); // gli passiamo la rotta e l'utente da editare
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
      $user = User::findOrFail($id);

      $data = $request->all();
      dd($data);
      $validate = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
      ]);

      if ($validator->fails()) {
          return redirect()->route('admin.users.edit', $id) // dinamica
              ->withErrors($validator) // mi permette di usare @errors
              ->withInput(); // mantiene i file corretti inseriti dall'utente, mi permette di usare OLD
      }

      // if(empty($data['src'])) {
      //   $data['src'] = 'mio path';
      // }


      $user->fill($data); // nel model inserisco in FILLABLE i nomi della colonne da compilare
      $update = $user->update();

      if(!$user) {
          dd('errore di salvataggio');
      }

      return redirect()->route('admin.users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      // dd($id);
      if (empty($user)) {
        abort('404');
      }

      $user->delete();

      return redirect()->route('admin.users');
    }
}
