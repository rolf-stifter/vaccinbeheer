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


    <form method="POST" action="{{ route('requests.store') }}">
        <div class="form-group">
            @csrf
            <label>Vaccin:</label>
           <select name="vaccine_id" class="form-control">
                @foreach($vaccins as $vaccin)
                    <option value="{{$vaccin->id}}" {{old('vaccine_id') == $vaccin->id? 'selected': ''}}> {{$vaccin->type}}, {{$vaccin->name}} </option>
                @endforeach
           </select>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" value="{{ old('quantity') }}" name="quantity">
        </div>
        <div class="form-group">
            <input type="submit" value="Aanvragen" class="btn btn-primary">
        </div>
    </form>
@endsection