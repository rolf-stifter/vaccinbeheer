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


    <form method="POST" action="{{ route('manage_requests.store') }}">
        <div class="form-group">
            @csrf
            <label>Vaccin_id:</label>
            <input type="text" class="form-control" name="vaccine_id">
        </div>
        <div class="form-group">
            <label>Aantal:</label>
            <input type="text" class="form-control" name="quantity">
        </div>
        <div class="form-group">
            <label>Datum aanvraag:</label>
            <input type="date" class="form-control" name="request_date">
        </div>
        <div class="form-group">
            <label>Status:</label>
            <input type="text" class="form-control" name="status">
        </div>
        <div class="form-group">
            <input type="submit" value="Aanvragen" class="btn btn-primary">
        </div>
    </form>
@endsection