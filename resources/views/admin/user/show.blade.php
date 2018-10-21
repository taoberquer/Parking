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
            @foreach($parkings as $parking)
                <tr>
                    <td>{{ $parking->name }}</td>
                    <td>{{ $parking->getUserPlace($user->id)->getPlaceNumber($parking->using_time) }}</td>
                    <td>{{ $parking->getUserPlace($user->id)->getStatus($parking->using_time) }}</td>
                    <td>{{ $parking->getUserPlace($user->id)->getRemainingTime($parking->using_time) }}</td>
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
                <div></div>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
