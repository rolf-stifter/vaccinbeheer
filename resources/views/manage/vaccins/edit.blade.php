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


    <form method="POST" action="{{ route('vaccins.update', $vaccins->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>In gebruik:</label>
            <select name="active" class="form-control">
                <option value="1" {{$vaccins->active == 1 ?'selected':''}}> Ja </option>
                <option value="0" {{$vaccins->active == 0 ?'selected':''}}> Neen </option>
            </select>
        </div>
        <div class="form-group">
            <label>Product Naam:</label>
            <input type="text" class="form-control" name="name" value={{$vaccins->name}}>
        </div>
        <div class="form-group">
            <label>Product Type::</label>
            <input type="text" class="form-control" name="type" value={{$vaccins->type}}>
        </div>
        <div class="form-group">
            <label>Minimum Aantal:</label>
            <input type="text" class="form-control" name="minimum_amount" value={{$vaccins->minimum_amount}}>
        </div>
        <div class="form-group">
            <input type="submit" value="Wijzig" class="btn btn-primary">
        </div>
    </form>
@endsection