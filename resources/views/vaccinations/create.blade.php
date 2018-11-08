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


    <form method="POST" action="{{ route('vaccinations.store') }}">
        <div class="form-group">
            @csrf
            <label>Datum vaccinatie:</label>
            <input type="date" class="form-control" value="{{ old('vaccination_date') }}" name="vaccination_date">
        </div>
        <div class="form-group">
            <label>School:</label>
            <select name="school_id" class="form-control">
                    @foreach ($favorite_schools as $school)
                        <option value="{{$school->id}}" {{ old('school_id') == $school->id ? 'selected' : '' }}> {{ $school->name}}</option>
                    @endforeach
                    @foreach($schools as $school)
                        <option value="{{$school->id}}" {{ old('school_id') == $school->id ? 'selected' : '' }}> {{ $school->name}}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group">
            <label>Klas:</label>
            <input type="text" class="form-control" value="{{ old('school_class') }}" name="school_class">
        </div>
        <div class="form-group">
            <label>Vaccin:</label>
            <select name="vaccine_id" class="form-control">
                    @foreach($vaccins as $vaccin)
                        <option value="{{$vaccin->id}}" {{ old('vaccine_id') == $vaccin->id ? 'selected' : '' }}> {{$vaccin->type}}, {{$vaccin->name}} (Aantal: {{$vaccin->quantityAfterVac}})</option>
                    @endforeach
               </select>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" value="{{ old('quantity') }}" name="quantity">
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection