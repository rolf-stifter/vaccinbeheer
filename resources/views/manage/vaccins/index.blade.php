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
            <h1>Vaccins</h1>
        </div>
    
<div class="table-responsive">
    <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>In gebruik</th>
                    <th>Product naam</th>
                    <th>Product type</th>
                    <th>Minimum aantal</th>
                    <th colspan="2" scope="col"><a href="{{ route('vaccins.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                </tr>
            </thead>

    <tbody>
            @foreach($vaccins as $vaccins)
                    <tr>
                        @if($vaccins->active == 1)
                            <td>&#10004;</td>
                        @else
                            <td>&#10060;</td>
                        @endif
                        <td>{{ $vaccins->name}}</td>
                        <td>{{ $vaccins->type}}</td>
                        <td>{{ $vaccins->minimum_amount}}</td>
                        <td>
                            <a href="{{ route('vaccins.edit', $vaccins->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                            <button class="btn btn-danger" onclick="delete_data('{{route('vaccins.customdestroy', $vaccins->id)}}')"><i class="fas fa-trash-alt"></i></button>
                        </td>
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