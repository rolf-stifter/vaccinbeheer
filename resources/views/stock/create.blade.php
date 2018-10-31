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
                <option value="1" {{old('isUsed') == 1? 'selected': ''}}>Ja</option>
                <option value="0" {{old('isUsed') == 0? 'selected': ''}}>Neen</option>
            </select>
        </div>
        <div class="form-group">
            <label>Vaccin:</label>
            <input type="text" class="form-control" value="{{ old('productName') }}" name="productName">
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" value="{{ old('quantity') }}" name="quantity">
        </div>
        <div class="form-group">
            <label>Aantal na vaccinatie:</label>
            <input type="text" class="form-control" value="{{ old('quantityAfterVac') }}" name="quantityAfterVac">
        </div>
        <div class="form-group">
            <input type="submit" value="Toevoegen" class="btn btn-primary">
        </div>
    </form>
@endsection