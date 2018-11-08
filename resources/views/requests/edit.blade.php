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


    <form method="POST" action="{{ route('requests.update', $requests->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Vaccin:</label>
            <select name="vaccine_id" class="form-control">
                    @foreach($vaccins as $vaccin)
                    <option value="{{$vaccin->id}}" {{$vaccin->id == $requests->vaccine_id ? 'selected': ''}}> {{$vaccin->type }}, {{$vaccin->name }} </option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" name="quantity" value={{$requests->quantity}}>
        </div>
        <div class="form-group">
            <input type="submit" value="Wijzig" class="btn btn-primary">
        </div>
    </form>
@endsection