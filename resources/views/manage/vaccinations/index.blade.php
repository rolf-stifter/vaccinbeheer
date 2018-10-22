@extends('layouts/layout')


@section('content')

<div class="success">
        @if( session()->get('success') )
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
    </div>

<div class="container bg-white shadow">
        <div class="pb-2 mt-4 mb-2 border-bottom">
            <h1>Beheer Vaccinaties</h1>
        </div>
    
<div class="table-responsive">
    <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Datum</th>
                    <th>School</th>
                    <th>Klas</th>
                    <th>Vaccin</th>
                    <th>Gebruiker</th>
                    <th>Aantal</th>
                    <th colspan="2" scope="col"><a href="{{ route('manage_vaccinations.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                </tr>
            </thead>

    <tbody>
            @foreach($vaccinations as $vaccination)
                    <tr>
                        <td>{{ $vaccination->vaccination_date }}</td>
                        <td>{{ $vaccination->schools->name}}</td>
                        <td>{{ $vaccination->school_class}}</td>
                        <td>{{ $vaccination->vaccins->name}}, {{$vaccination->vaccins->type}}</td>
                        <td>{{ $vaccination->user->name}}</td>
                        <td>{{ $vaccination->quantity}}</td>
                        <td><a href="{{ route('manage_vaccinations.edit', $vaccination->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
                        <td><button class="btn btn-danger" onclick="delete_data('{{route('manage_vaccinations.customdestroy', $vaccination->id)}}')"><i class="fas fa-trash-alt"></i></button>
                    </tr>
            @endforeach
    </tbody>
    </table>

@endsection

@section('javascript')
<script>

function delete_data(url){

    swal({
        title: 'Bent u zeker?',
        text: "Dit kan niet meer ongedaan gemaakt worden!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f44242',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Verwijderen'
        }).then((result) => {
        if (result.value) {
            location.replace(url);
        }
        })
}
</script>
@endsection