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
            </div>
        </div>
        <div class="mt-2">
            <label>Nombre de place : 0/{{ $parking->maximum_place }}</label><br>
            <label>Temps d'attribution (en secondes) : {{ $parking->using_time }}</label>
        </div>

        <table class="table mt-5">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Numéro de place</th>
                <th scope="col">Propriétaire</th>
                <th scope="col">Attribué jusqu'au</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parking->getPlaces as $place)
            <tr>
                <th scope="row">1</th>
                <td>{{ $place->place_number }}</td>
                <td>{{ $place->getOwner()->first()->name }}</td>
                <td>{{ $place->getOwner()->first()->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
