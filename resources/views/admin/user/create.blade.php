@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('adminUsersStore') }}" method="post" class="col-10">
                <div class="form-row">
                    <div class="form-group col">
                        @csrf
                        <label for="email">Adresse email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="exemple@exemple.fr">
                    </div>
                    <div class="form-group col">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Giselle">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="***********">
                    </div>
                    <div class="form-group col">
                        <label for="inputState">Rôle</label>
                        <select id="inputState" class="form-control" name="role">
                            <option value="user" selected>Utilisateur</option>
                            <option value="admin">Administrateur</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
@endsection