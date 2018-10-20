@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="" method="post" class="col-10">
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
                        <input type="password" class="form-control" placeholder="Laisser vide">
                    </div>
                    <div class="form-group col">
                        <label for="inputState">Rôle</label>
                        <select id="inputState" class="form-control">
                            <option selected>{{ $user->role }}</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
@endsection