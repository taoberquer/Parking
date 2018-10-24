@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nom du parking</th>
                    <th scope="col">Nombre de place</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($parkings as $parking)
                        <tr>
                            <td>{{ $parking->name }}</td>
                            <td>{{ $parking->getCountPlaces() }} / {{ $parking->maximum_place }}</td>

                            @if (!$parking->getUserPlace(Auth::user()->id) OR in_array($parking->getUserPlace(Auth::user()->id)->getStatus($parking->using_time), ['Expiré', 'Abandonné']))
                                <td>
                                    <form action="{{ route('addPlace') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="parking_id" value="{{ $parking->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <button type="submit" class="btn btn-success">Rejoindre</button>
                                    </form>
                                </td>
                            @else
                                <td>
                                    <form action="{{ route('giveUpPlace', $parking->getUserPlace(Auth::user()->id)->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Quitter</button>
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
