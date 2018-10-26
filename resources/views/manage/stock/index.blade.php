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
        <h1>Beheer Voorraad 
            <p style="float:right">
                <button  type="button" class="btn btn-info" data-toggle="modal" data-target="#search_stock">
                        <i class="fas fa-search fa-lg"></i>
                </button>
            </p>
        </h1>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Gebruiker</th>
                    <th>Vaccin</th>
                    <th>Aantal</th>
                    <th>Aantal na vaccinaties</th>
                    <th colspan="2" scope="col"><a href="{{ route('manage_stock.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                </tr>
            </thead>

            <tbody>
                    @foreach($stock_lines as $stock_line)
                    <tr>
                        <td>{{ $stock_line->user->name}}</td>
                        <td>{{ $stock_line->vaccins->type}}, {{ $stock_line->vaccins->name}} </td>
                        <td>{{ $stock_line->quantity}}</td>
                        <td>{{ $stock_line->quantityAfterVac}}</td>
                        <td><a href="{{ route('manage_stock.edit', $stock_line->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
                        <td><button class="btn btn-danger" onclick="delete_data('{{route('manage_stock.customdestroy', $stock_line->id)}}')"><i class="fas fa-trash-alt"></i></button>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>
    <div class="container bg-white shadow">
            <div class="pb-2 mt-4 mb-2 border-bottom">
                <h1>Totaal Voorraad</h1>
            </div>

            <div class="table-responsive">
                    <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Vaccin</th>
                                    <th>Aantal</th>
                                    <th>Aantal na vaccinaties</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($total_vaccins as $vaccin)
                                    <tr>
                                        <td>{{ $vaccin->type}}, {{ $vaccin->name}} </td>
                                        <td>{{ $vaccin->sum}}</td>
                                        <td>{{ $vaccin->sum_after}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
            </div>
    </div>

<div class="modal" id="search_stock">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Specifiek zoeken</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <form method="GET" action="{{route('manage_stock.index')}}">
                    
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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