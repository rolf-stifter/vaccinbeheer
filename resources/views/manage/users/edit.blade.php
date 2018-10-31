@extends('layouts/layout')

@section('content')

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <form method="POST" action="{{ route('users.update', $users->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Gebruiker:</label>
            <input type="text" class="form-control" name="name" value="{{$users->name}}">
        </div>
        <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" value="{{$users->email}}">
            </div>
        <div class="form-group">
            <input type="submit" value="Wijzig" class="btn btn-primary">
        </div>
    </form>
@endsection