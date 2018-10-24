@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="col">{{ $parking->name }}</h1>
            <div class="col row justify-content-end">
                <div class="col-auto"><a href="{{ route('adminParkingsEdit', $parking->id) }}" class="btn btn-warning">Modifier</a></div>
                <form class="col-auto" action="{{ route('adminParkingsDelete', $parking->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
                <div class="col-auto"><a href="{{ route('adminParkingsRefresh', $parking->id) }}" class="btn btn-info">Rafraichir les places en attentes</a></div>
            </div>
        </div>
        <div class="mt-2">
            <label>Nombre de place : {{ $parking->getCountPlaces() }} / {{ $parking->maximum_place }}</label><br>
            <label>Temps d'attribution (en secondes) : {{ $parking->using_time }}</label>
        </div>

        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Numéro de place</th>
                <th scope="col">Propriétaire</th>
                <th scope="col">Attribué jusqu'au</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parking->getPlacesAndWaiting as $place)
            <tr>
                <th scope="row">{{ $place->id }}</th>
                <td>{{ $place->getPlaceNumber($parking->using_time) }}</td>
                <td>{{ $place->getOwner()->first()->name }}</td>
                <td>{{ date('d/m/Y à H:i:s', strtotime($place->getOwner()->first()->created_at) + $parking->using_time ) }}</td>
                    <td>
                        <form action="{{ route('giveUpPlace', $parking->getUserPlace($place->getOwner()->first()->id)->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Désinscire</button>
                        </form>
                    </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
