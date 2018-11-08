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


    <form method="POST" action="{{ route('manage_requests.store') }}">
        @csrf
        <div class="form-group">
            <label>Vaccin:</label>
            <select name="vaccine_id" class="form-control">
                @foreach($vaccins as $vaccin)
                    <option value="{{$vaccin->id}}" {{old('vaccine_id') == $vaccin->id? 'selected': ''}}> {{$vaccin->type}}, {{$vaccin->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" value="{{old('quantity')}}" name="quantity">
        </div>
        <div class="form-group">
                <label>Gebruiker:</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{old('user_id') == $user->id? 'selected': ''}}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        <div class="form-group">
            <label>Status:</label>
            <select name="status_id" class="form-control">
                    @foreach($statusses as $status)
                        <option value="{{$status->id}}" {{old('status_id') == $status->id? 'selected': ''}}>{{$status->name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Aanvragen" class="btn btn-primary">
        </div>
    </form>
@endsection