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


    <form method="POST" action="{{ route('manage_stock.store') }}">
        <div class="form-group">
            @csrf
            <label>In gebruik:</label>
            <select name="isUsed" class="form-control">
                <option value="1" {{old('isUsed') == 1? 'selected': ''}}>Ja</option>
                <option value="0" {{old('isUsed') == 0? 'selected': ''}}>Neen</option>
            </select>
        </div>
        <div class="form-group">
            <label>Gebruiker:</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}" {{old('user_id') == $user->id? 'selected': ''}}> {{$user->name}} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Vaccin:</label>
            <select name="vaccine_id" class="form-control">
                @foreach($vaccins as $vaccin)
                    <option value="{{$vaccin->id}}" {{old('vaccine_id') == $vaccin->id? 'selected': ''}}> {{$vaccin->type}}, {{$vaccin->name}} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" value="{{old('quantity')}}" name="quantity">
        </div>
        <!--
        <div class="form-group">
            <label>Aantal na vaccinatie:</label>
            <input type="text" class="form-control"  name="quantityAfterVac">
        </div>
        -->
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection