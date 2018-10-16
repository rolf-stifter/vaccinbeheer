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


    <form method="POST" action="{{ route('stock.store') }}">
        <div class="form-group">
            @csrf
            <label>In gebruik:</label>
            <select name="isUsed" class="form-control">
                <option value="1">Ja</option>
                <option value="0">Neen</option>
            </select>
        </div>
        <div class="form-group">
            <label>Product Naam:</label>
            <input type="text" class="form-control" name="productName">
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" name="quantity">
        </div>
        <div class="form-group">
            <label>Aantal na vaccinatie:</label>
            <input type="text" class="form-control" name="quantityAfterVac">
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection