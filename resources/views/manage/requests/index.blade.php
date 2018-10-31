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
        <h1>Beheer Aanvragen
            <p style="float:right">
                <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#search_request">
                        <i class="fas fa-search fa-lg"></i>
                </button>
            </p>
        </h1>
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
                                <th scope="col">Status</th>
                                <th colspan="2" scope="col"><a href="{{ route('manage_requests.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                            </tr>
                        </thead>
                <tbody>
                    @foreach($request_tabs[$status->id] as $request_data)
                            <tr>
                                <td>{{$request_data->vaccins->name}}, {{$request_data->vaccins->type}}</td>
                                <td>{{$request_data->quantity}}</td>
                                <td>{{$request_data->request_date}}</td>
                                <td>{{$request_data->user->name}}</td>
                                <td>{{$request_data->status->name}}</td>
                                <td>
                                    <a href="{{ route('manage_requests.edit', $request_data->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                    <button class="btn btn-danger" onclick="delete_data('{{route('manage_requests.customdestroy', $request_data->id)}}')"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

<div class="modal" id="search_request">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Specifiek zoeken</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <form method="GET" action="{{route('manage_requests.index')}}">
                        
                <!-- Modal body -->
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Vaccin:</label>
                                <select name="vaccine_id" class="form-control">
                                    <option value=""> Alle Vaccins</option>
                                    @foreach($vaccins as $vaccin)
                                        <option value="{{$vaccin->id}}" {{$request->get('vaccine_id')==$vaccin->id?'selected':''}}> {{$vaccin->type}}, {{$vaccin->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Gebruiker:</label>
                                <select name="user_id" class="form-control">
                                    <option value=""> Alle Gebruikers</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{$request->get('user_id')==$user->id?'selected':''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" value="Zoeken" class="btn btn-primary mr-auto">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Sluiten</button>
                    </div>
                </form>
            </div>
        </div>
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