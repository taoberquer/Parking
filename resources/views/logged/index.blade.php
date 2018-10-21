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
                    <th scope="col"><a href="{{ route('newPlaceRequest') }}" class="btn btn-success">Nouvelle réservation</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($parkings as $parking)
                    <tr>
                        <td>{{ $parking->name }}</td>
                        <td>{{ $parking->getUserPlace(Auth::user()->id)->getPlaceNumber($parking->using_time) }}</td>
                        <td>{{ $parking->getUserPlace(Auth::user()->id)->getStatus($parking->using_time) }}</td>
                        <td>{{ $parking->getUserPlace(Auth::user()->id)->getRemainingTime($parking->using_time) }}</td>
                        @if (in_array($parking->getUserPlace(Auth::user()->id)->getStatus($parking->using_time), ['Expiré', 'Abandonné']))
                            <td>
                                <form action="{{ route('addPlace') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="parking_id" value="{{ $parking->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-success">Renouveler</button>
                                </form>
                            </td>
                        @else
                            <td>
                                <form action="{{ route('giveUpPlace', $parking->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Abandonner</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
