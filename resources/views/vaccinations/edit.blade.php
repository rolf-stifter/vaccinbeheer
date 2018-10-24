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


    <form method="POST" action="{{ route('vaccinations.update', $vaccinations->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Datum vaccinatie:</label>
            <input type="date" class="form-control" name="vaccination_date" value="{{$vaccinations->vaccination_date}}">
        </div>
        <div class="form-group">
            <label>School:</label>
            <select name="school_id" class="form-control">
                @foreach ($schools as $school)
                    <option value="{{$school->id}}" {{$school->id == $vaccinations->school_id?'selected':''}}> {{$school->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Klas:</label>
            <input type="text" class="form-control" name="school_class" value={{$vaccinations->school_class}}>
        </div>
        <div class="form-group">
            <label>Vaccin:</label>
            <select name="vaccine_id" class="form-control">
                    @foreach ($vaccins as $vaccin)
                        <option value="{{$vaccin->id}}" {{$vaccin->id == $vaccinations->vaccine_id?'selected':''}}> {{$vaccin->type}}, {{$vaccin->name }}</option>
                    @endforeach
                </select>
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