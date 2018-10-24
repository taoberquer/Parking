@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="col">{{ $user->name }}</h1>
            <div class="col row justify-content-end">
                <div class="col-auto"><a href="{{ route('adminUsersEdit', $user->id) }}" class="btn btn-warning">Modifier</a></div>
                <form class="col-auto" action="{{ route('adminUsersDelete', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
            </div>
        </div>
        <div class="mt-2">
            <label>Email : {{ $user->email }}</label><br>
            <label>Role : {{ $user->role }}</label>
        </div>
        @foreach($parkings as $parking)
            <div class="card">
                <div class="card-header">{{ $parking->name }}</div>
                <div class="card-body">
                    @if ($parking->getUserPlace($user->id))
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col align-middle">Numéro : {{ $parking->getUserPlace($user->id)->getPlaceNumber($parking->using_time) }}</th>
                                <th scope="col">Status : {{ $parking->getUserPlace($user->id)->getStatus($parking->using_time) }}</th>
                                <th scope="col">Temps restant : {{ $parking->getUserPlace($user->id)->getRemainingTime($parking->using_time) }}</th>
                                @if (in_array($parking->getUserPlace($user->id)->getStatus($parking->using_time), ['Expiré', 'Abandonné']))
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
                                        <form action="{{ route('giveUpPlace', $parking->getUserPlace($user->id)->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Abandonner</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            </thead>
                        </table>
                        <h3>Historique</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro</th>
                                <th scope="col">status</th>
                                <th scope="col">Création</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parking->getUserPlaces($user->id)->get() as $place)
                                <tr>
                                    <th scope="row">{{ $place->id }}</th>
                                    <td>{{ $place->place_number }}</td>
                                    <td>{{ $place->getStatus($parking->using_time) }}</td>
                                    <td>{{ $place->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
