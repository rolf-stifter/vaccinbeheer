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


    <form method="POST" action="{{ route('schools.update', $schools->id) }}">
        @method('PATCH')
        @csrf
            <div class="form-group">
                <label>Naam:</label>
                <input type="text" name="name" value="{{$schools->name}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Toevoegen" class="btn btn-primary">
            </div>
    </form>
@endsection