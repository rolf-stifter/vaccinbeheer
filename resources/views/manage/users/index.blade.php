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
        <h1>Gebruikers</h1>
    </div>

<div class="table-responsive">
    <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Naam</th>
                    <th scope="col">Email</th>
                    <th colspan="2" scope="col"><a href="{{ route('users.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                </tr>
            </thead>
    <tbody>
        @foreach($users as $user)
            @if($user->active)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                        <button class="btn btn-danger" onclick="delete_data('{{route('users.customdestroy', $user->id)}}')"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
@endsection

@section('javascript')
<script>

function delete_data(url){

    swal({
        title: 'Bent u zeker?',
        text: "Deze gebruiker zal niet meer kunnen inloggen",
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