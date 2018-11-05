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
            <h1>Voorraad</h1>
        </div>
    
<div class="table-responsive">
    <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>In gebruik</th>
                    <th>Vaccin</th>
                    <th>Aantal</th>
                    <th>Aantal na geplande vaccinaties</th>
                    <th>Acties</th>
                    <!--
                        <th colspan="2" scope="col"><a href="{{ route('stock.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                        -->
                </tr>
            </thead>

    <tbody>
            @foreach($stock_lines as $stock_line)
                @if(Auth::id() == $stock_line->user_id)
                    <tr>
                        @if($stock_line->isUsed == 1)
                            <td>&#10004;</td>
                        @else
                            <td>&#10060;</td>
                        @endif
                        <td>{{ $stock_line->vaccins->type}}, {{$stock_line->vaccins->name}}</td>
                        <td>{{ $stock_line->quantity}}</td>
                        <td>{{ $stock_line->quantityAfterVac}}</td>
                        <td><button onclick="$('#vaccine_id').val({{$stock_line->vaccine_id}})" class="btn btn-success" title="voorraad afstaan" data-toggle="modal" data-target="#add_external"><i class="fas fa-angle-double-right"></i></button></td>
                    <!-- 
                        <td><a href="{{ route('stock.edit', $stock_line->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
                        <td><button class="btn btn-danger" onclick="delete_data('{{route('stock.customdestroy', $stock_line->id)}}')"><i class="fas fa-trash-alt"></i></button> 
                        -->
                    </tr>
                @endif
            @endforeach
    </tbody>
    </table>

    @if($stock_lines != '')
    <div class="modal " id="add_external">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Voorraad afstaan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="GET" action="{{ route('stock.add_external_stock', $stock_line->id) }}">
                        @csrf 
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Aantal:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                            {!! $errors->first('quantity', '<p style="color:red;">:message</p>') !!}
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="vaccine_id" id="vaccine_id" value={{$stock_line->vaccine_id}}>
                        </div>
                    </div>
                <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="submit" value="Afstaan" class="btn btn-primary mr-auto">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Sluiten</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    
@endsection

@section('javascript')
<script type="text/javascript">

@if($errors->any())
    $(window).on('load',function(){
        $('#add_external').modal('show');
    });
@endif

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