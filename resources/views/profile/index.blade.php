@extends('layouts/layout')


@section('content')

<div class="wrapper">
    
    <div class="container bg-white shadow">
        <div class="pb-2 mt-4 mb-2 border-bottom">
            <h1>Scholen</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Actie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                            <tr>
                                <td>{{$school->name}}</td>
                                <td><a href="{{ route('profile.favorites', $school->id) }}" class="btn btn-success" title="Toevoegen aan favorieten"><i class="fas fa-angle-double-right"></i></a></td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container bg-white shadow">
        <div class="pb-2 mt-4 mb-2 border-bottom">
            <h1>Favoriete scholen</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Actie</th>
                        <th scope="col">Naam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorite_schools as $school)
                            <tr>
                                <td><a href="{{route('profile.delete_fav', $school->id)}}" class="btn btn-danger" title="Verwijderen uit favorieten"><i class="fas fa-angle-double-left"></i></a></td>
                                <td>{{$school->name}}</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection