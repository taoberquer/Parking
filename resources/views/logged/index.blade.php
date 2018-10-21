@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom du parking</th>
                    <th scope="col">Numéro de place</th>
                    <th scope="col">Status</th>
                    <th scope="col">Temps restant</th>
                    <th scope="col"><a href="{{ route('adminParkingsCreate') }}" class="btn btn-success">Nouvelle réservation</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($parkings as $parking)
                    <tr>
                        <td>{{ $parking->name }}</td>
                        <td>{{ $parking->getUserPlace(Auth::user()->id)->place_number }}</td>
                        <td>{{ $parking->getUserPlace(Auth::user()->id)->getStatus($parking->using_time) }}</td>
                        <td>{{ $parking->getUserPlace(Auth::user()->id)->getRemainingTime($parking->using_time) }}</td>
                        @if (in_array($parking->getUserPlace(Auth::user()->id)->getStatus($parking->using_time), ['Expiré', 'Abandonné']))
                            <td><a href="{{ route('adminParkingsCreate') }}" class="btn btn-success">Renouveler</a></td>
                        @else
                            <td><a href="{{ route('adminParkingsCreate') }}" class="btn btn-danger">Abandonner</a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
