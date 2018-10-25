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
        <h1>Beheer Aanvragen</h1>
    </div>

    <ul class="nav nav-tabs">
        @foreach($statusses as $status)
            <li class="nav-item">
                <a class="nav-link {{$status->id == 1?'active':'' }}" data-toggle="tab" href="#status_{{$status->id}}">{{$status->name}}</a>
            </li>
        @endforeach
    </ul>

<div class="tab-content">
    @foreach($statusses as $status)
        <div class="tab-pane {{$status->id == 1?'active':'' }}" id="status_{{$status->id}}">
            <div class="table-responsive">
                <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Vaccin</th>
                                <th scope="col">Aantal</th>
                                <th scope="col">Aanvraag datum</th>
                                <th scope="col">Gebruiker</th>
                                <th scope="col">status</th>
                                <th colspan="2" scope="col"><a href="{{ route('manage_requests.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                            </tr>
                        </thead>
                <tbody>
                    @foreach($request_tabs[$status->id] as $request)
                            <tr>
                                <td>{{$request->vaccins->name}}, {{$request->vaccins->type}}</td>
                                <td>{{$request->quantity}}</td>
                                <td>{{$request->request_date}}</td>
                                <td>{{$request->user->name}}</td>
                                <td>{{$request->status->name}}</td>
                                <td><a href="{{ route('manage_requests.edit', $request->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
                                <td><button class="btn btn-danger" onclick="delete_data('{{route('manage_requests.customdestroy', $request->id)}}')"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

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