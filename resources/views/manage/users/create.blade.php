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
            <label>Naam:</label>
            <input type="text" name="name" value="{{old('name')}}" class="form-control">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{old('email')}}" class="form-control">
        </div>
        <div class="form-group">
            <label>Gebruikers type:</label>
            <select name="user_roles_id" class="form-control">
                @foreach($user_roles as $role)
                    <option value="{{ $role->id }}"  {{old('user_roles_id') == $role->id? 'selected': ''}}> {{ $role->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection