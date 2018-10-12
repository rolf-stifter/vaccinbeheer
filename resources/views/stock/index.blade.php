@extends('layouts/layout')


@section('content')

    <table class="table table-striped">
    <thead>
        <tr>
            <th>In gebruik</th>
            <th>Product naam</th>
            <th>Aantal</th>
            <th>Aantal na vaccinaties</th>
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
            </tr>
            @endforeach
    </tbody>
    </table>

@endsection