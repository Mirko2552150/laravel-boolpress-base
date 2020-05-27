@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th colspan="3"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $key => $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}></td>
                <td><button class="btn btn-primary" type="button" name="button"><a href="{{route('admin.users.edit', $user->id)}}">EDIT</a></button></td>
                <td>
                  <form method="POST" action="{{route('admin.users.destroy', $user->id)}}">
                    @method('DELETE')
                    @csrf
                  <button class="btn btn-outline-danger" type="submit" name="button">DELETE</button>
                </form>
              </td>
                {{-- <td>{{$user->}}></td> --}}
                {{-- <td>{{$user->}}></td> --}}
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
