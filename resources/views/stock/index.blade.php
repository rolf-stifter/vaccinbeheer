@extends('layouts/layout')


@section('content')

<div class="nav-icons">
    <a href={{route('stock.create')}}><i class="fas fa-plus fa-3x"></i></a>
</div>

    <table class="table table-striped">
    <thead>
        <tr>
            <th>In gebruik</th>
            <th>Product naam</th>
            <th>Aantal</th>
            <th>Aantal na vaccinaties</th>
            <th colspan="2">Actie</th>
        </tr>
    </thead>

    <tbody>
            @foreach($stock_lines as $stock_line)
            <tr>
                @if($stock_line->isUsed == 1)
                    <td>&#10004;</td>
                @else
                    <td>&#10060;</td>
                @endif
                <td>{{ $stock_line->productName}}</td>
                <td>{{ $stock_line->quantity}}</td>
                <td>{{ $stock_line->quantityAfterVac}}</td>
                <td><a href="{{ route('stock.edit', $stock_line->id)}}" class="btn btn-primary">Wijzigen</td>
                <td>
                    <button class="btn btn-danger" onclick="delete_data('{{route('stock.customdestroy', $stock_line->id)}}')">Verwijderen</button>
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