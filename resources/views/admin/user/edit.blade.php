@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('adminUsersUpdate', $user->id) }}" method="post" class="col-10">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col">
                        <label for="exampleInputEmail1">Adresse email</label>
                        <input type="email" value="{{ $user->email }}" class="form-control" name="email">
                    </div>
                    <div class="form-group col">
                        <label for="exampleInputEmail1">Nom</label>
                        <input type="text" value="{{ $user->name }}" class="form-control" name="name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="exampleInputPassword1">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="********">
                    </div>
                    @if(\Auth::user()->isAdmin())
                    <div class="form-group col">
                        <label for="inputState">Rôle</label>
                        <select id="inputState" class="form-control" name="role">
                            <option value="admin" @if ($user->role == 'admin') selected @endif>Administrateur</option>
                            <option value="user" @if ($user->role == 'user') selected @endif>Utilisateur</option>
                        </select>
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
@endsection