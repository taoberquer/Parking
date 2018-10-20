@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Nombre place restante</th>
                    <th scope="col">Nombre de place</th>
                    <th scope="col">Temps d'attribution</th>
                    <th scope="col"><a href="{{ route('adminParkingsCreate') }}" class="btn btn-success">Ajouter</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($parkings as $parking)
                    <tr>
                        <th scope="row">{{$parking->id}}</th>
                        <td><a href="{{ route('adminParkingsShow', $parking->id) }}">{{ $parking->name }}</a></td>
                        <td>0</td>
                        <td>{{ $parking->maximum_place }}</td>
                        <td>{{ $parking->using_time }} s</td>
                        <td class="row">
                            <div class="col"><a href="{{ route('adminParkingsEdit', $parking->id) }}" class="btn btn-warning">Modifier</a></div>
                            <form class="col" action="{{ route('adminParkingsDelete', $parking->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
