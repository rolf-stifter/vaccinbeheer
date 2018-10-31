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


    <form method="POST" action="{{ route('manage_stock.add') }}">
        <div class="form-group">
            @csrf
        <div class="form-group">
            <label>Vaccin:</label>
            <select name="vaccine_id" class="form-control">
                @foreach($vaccins as $vaccin)
                    <option value="{{$vaccin->id}}"> {{$vaccin->type}}, {{$vaccin->name}} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" name="quantity">
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection