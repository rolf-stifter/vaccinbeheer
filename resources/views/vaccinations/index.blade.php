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
            <h1>Vaccinaties</h1>
        </div>

    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#gepland">Gepland</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#voorbij">Voorbij</a></li>
    </ul>
<div class="tab-content">
    <!-- Show table with vaccinations that are planned -->
    <div class="tab-pane active" id="gepland">
        <div class="table-responsive">
            <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Datum</th>
                            <th>School</th>
                            <th>Klas</th>
                            <th>Vaccin</th>
                            <th>Aantal</th>
                            <th colspan="2" scope="col"><a href="{{ route('vaccinations.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                        </tr>
                    </thead>

            <tbody>
                    @foreach($vaccinations_planned as $vaccination)
                        @if(Auth::id() == $vaccination->user_id)
                            <tr>
                                <td>{{ $vaccination->vaccination_date }}</td>
                                <td>{{ $vaccination->schools->name}}</td>
                                <td>{{ $vaccination->school_class}}</td>
                                <td>{{ $vaccination->vaccins->type}}, {{$vaccination->vaccins->name}}</td>
                                <td>{{ $vaccination->quantity}}</td>
                                <td><a href="{{ route('vaccinations.edit', $vaccination->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
                                <td><button class="btn btn-danger" onclick="delete_data('{{route('vaccinations.customdestroy', $vaccination->id)}}')"><i class="fas fa-trash-alt"></i></button>
                                
                            </tr>
                        @endif
                    @endforeach
            </tbody>
            </table>
        </div>
    </div>
    <!------------------------------------------------->    
    
    <!-- Show table with vaccinations that are finished -->
    <div class="tab-pane fade" id="voorbij">
        <div class="table-responsive">
                <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Datum</th>
                                <th>School</th>
                                <th>Klas</th>
                                <th>Vaccin</th>
                                <th>Aantal</th>
                                <th colspan="2" scope="col"><a href="{{ route('vaccinations.create')}}"><i style="color:#fff;" class="fas fa-plus"></i></th>
                            </tr>
                        </thead>

                <tbody>
                        @foreach($vaccinations_finished as $vaccination)
                            @if(Auth::id() == $vaccination->user_id)
                                <tr>
                                    <td>{{ $vaccination->vaccination_date }}</td>
                                    <td>{{ $vaccination->schools->name}}</td>
                                    <td>{{ $vaccination->school_class}}</td>
                                    <td>{{ $vaccination->vaccins->type}}, {{$vaccination->vaccins->name}}</td>
                                    <td>{{ $vaccination->quantity}}</td>
                                    <td><a href="{{ route('vaccinations.edit', $vaccination->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></td>
                                    <td><button class="btn btn-danger" onclick="delete_data('{{route('vaccinations.customdestroy', $vaccination->id)}}')"><i class="fas fa-trash-alt"></i></button>
                                    
                                </tr>
                            @endif
                        @endforeach
                </tbody>
                </table>
            </div>
    </div>
    <!------------------------------------------------->  

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