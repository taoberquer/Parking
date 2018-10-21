@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rôle</th>
                    <th scope="col">Actions</th>
                    <th scope="col"><a href="{{ route('adminUsersCreate') }}" class="btn btn-success">Ajouter</a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td><a href="{{ route('adminUsersShow', $user->id) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="row">
                            <a href="{{ route('adminUsersEdit', $user->id) }}" class="btn btn-warning">Modifier</a>
                            <form class="col" action="{{ route('adminUsersDelete', $user->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
