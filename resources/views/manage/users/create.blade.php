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


    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            <label>Gebruiker:</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection