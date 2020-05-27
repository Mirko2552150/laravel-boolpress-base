@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        {{-- form che indizzera vs la rotta update --}}
        <form action="{{route('admin.users.update', $user->id)}}">
          @method('PATCH')
          @csrf
          <div class="form-group">
            <label for="name">Nome</label>
            <input class="form-control" type="text" name="name" value="{{(!empty(old('name'))) ? old('name') : $user->name}}">
            @error ('name')
              <span class="alert alert-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" value="{{(!empty(old('email'))) ? old('email') : $user->email}}">
            @error ('email')
              <span class="alert alert-danger">
                {{ $message }}
              </span>
            @enderror
          </div>
          <input class="btn btn-primary " type="submit" value="salva">
        </form>
      </div>
    </div>
  </div>
@endsection
