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


    <form method="POST" action="{{ route('vaccins.store') }}">
        <div class="form-group">
            @csrf
            <label>In gebruik:</label>
            <select name="active" class="form-control">
                <option value="1">Ja</option>
                <option value="0">Neen</option>
            </select>
        </div>
        <div class="form-group">
            <label>Product Naam:</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label>Product Type::</label>
            <input type="text" class="form-control" name="type">
        </div>
        <div class="form-group">
            <label>Minimum Aantal:</label>
            <input type="text" class="form-control" name="minimum_amount">
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection