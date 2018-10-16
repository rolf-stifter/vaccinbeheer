@extends('layouts/layout')

@section('content') 
<div class="success">
    @if( session()->get('success') )
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
</div>

<div class="nav-icons">
    <a href={{route('requests.create')}}><i class="fas fa-plus fa-3x"></i></a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Vaccin</th>
            <th>Aantal</th>
            <th>Aanvraag datum</th>
            <th>status</th>
            <th colspan="2">Actie</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $request)
        <tr>
            <td>{{$request->vaccine_id}}</td>
            <td>{{$request->quantity}}</td>
            <td>{{$request->request_date}}</td>
            <td>{{$request->status}}</td>
            <td><a href="{{ route('requests.edit', $request->id)}}" class="btn btn-primary">Wijzigen</td>
            <td><button class="btn btn-danger" onclick="delete_data('{{route('requests.customdestroy', $request->id)}}')">Verwijderen</button>
                <!--
                <form action="{{ route('requests.destroy', $request->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="delete();">Verwijderen</button>
                </form>
                -->
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