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
        <h1>Aanvragen</h1>
    </div>

<div class="table-responsive">
    <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Vaccin</th>
                    <th scope="col">Aantal</th>
                    <th scope="col">Aanvraag datum</th>
                    <th scope="col">status</th>
                    <th colspan="2" scope="col"><a href="{{ route('requests.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                </tr>
            </thead>
    <tbody>
        @foreach($requests as $request)
        <tr>
            <td>{{$request->vaccine_id}}</td>
            <td>{{$request->quantity}}</td>
            <td>{{$request->request_date}}</td>
            <td>{{$request->status}}</td>
            <td><a href="{{ route('requests.edit', $request->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
            <td><button class="btn btn-danger" onclick="delete_data('{{route('requests.customdestroy', $request->id)}}')"><i class="fas fa-trash-alt"></i></button>
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