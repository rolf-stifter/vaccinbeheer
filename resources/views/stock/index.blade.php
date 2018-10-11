@extends('layouts/layout')


@section('content')

    <table class="table table-striped">
    <thead>
        <tr>
            <th>In gebruik</th>
            <th>Product Naam</th>
            <th>Aantal</th>
            <th>Aantal na vaccinaties</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>&#10004;</td>
            <td>Product 1</td>
            <td>5</td>
            <td>2</td>
        </tr>
        <tr>
            <td>&#10060;</td>
            <td>Product 2</td>
            <td>10</td>
            <td>3</td>
        </tr>
    </tbody>
    </table>

@endsection