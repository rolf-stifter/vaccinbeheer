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


    <form method="POST" action="{{ route('manage_vaccinations.store') }}">
        <div class="form-group">
            @csrf
            <label>Datum vaccinatie:</label>
            <input type="date" class="form-control" name="vaccination_date">
        </div>
        <div class="form-group">
            <label>School:</label>
            <input type="text" class="form-control" name="school">
        </div>
        <div class="form-group">
            <label>Klas:</label>
            <input type="text" class="form-control" name="school_class">
        </div>
        <div class="form-group">
            <label>Vaccin:</label>
            <input type="text" class="form-control" name="vaccine_id">
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