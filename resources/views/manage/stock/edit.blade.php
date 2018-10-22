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


    <form method="POST" action="{{ route('manage_stock.update', $stock_lines->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>In gebruik:</label>
            <select name="isUsed" class="form-control">
                <option value="1" {{$stock_lines->isUsed == 1 ?'selected':''}}> Ja </option>
                <option value="0" {{$stock_lines->isUsed == 0 ?'selected':''}}> Neen </option>
            </select>
        </div>
        <div class="form-group">
            <label>Gebruiker:</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}" {{$user->id == $stock_lines->user_id ? 'selected': ''}}> {{$user->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Product Naam:</label>
            <input type="text" class="form-control" name="productName" value={{$stock_lines->productName}}>
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" name="quantity" value={{$stock_lines->quantity}}>
        </div>
        <div class="form-group">
            <label>Aantal na vaccinatie:</label>
            <input type="text" class="form-control" name="quantityAfterVac" value={{$stock_lines->quantityAfterVac}}>
        </div>
        <div class="form-group">
            <input type="submit" value="Wijzig" class="btn btn-primary">
        </div>
    </form>
@endsection