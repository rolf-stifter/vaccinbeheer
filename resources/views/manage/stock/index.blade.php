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
        <h1>Beheer Voorraad</h1>
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