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


    <form method="POST" action="{{ route('manage_vaccinations.update', $vaccinations->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Datum vaccinatie:</label>
            <input type="date" class="form-control" name="vaccination_date" value="{{$vaccinations->vaccination_date}}">
        </div>
        <div class="form-group">
            <label>School:</label>
            <input type="text" class="form-control" name="school" value={{$vaccinations->school}}>
        </div>
        <div class="form-group">
            <label>Klas:</label>
            <input type="text" class="form-control" name="school_class" value={{$vaccinations->school_class}}>
        </div>
        <div class="form-group">
            <label>Vaccin:</label>
            <input type="text" class="form-control" name="vaccine_id" value={{$vaccinations->vaccine_id}}>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" name="quantity" value={{$vaccinations->quantity}}>
        </div>
        <div class="form-group">
            <input type="submit" value="Wijzig" class="btn btn-primary">
        </div>
    </form>
@endsection