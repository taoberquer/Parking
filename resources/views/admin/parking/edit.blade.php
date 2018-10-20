@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form action="{{ route('adminParkingsUpdate', $parking->id) }}" method="post" class="col-10">
                <div class="form-row">
                    <div class="form-group col">
                        @method('PATCH')
                        @csrf
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nation" value="{{ $parking->name }}">
                    </div>
                    <div class="form-group col">
                        <label for="maximum_place">Nombre de place</label>
                        <input type="number" class="form-control" name="maximum_place" id="maximum_place" placeholder="168" value="{{ $parking->maximum_place }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="using_time">Temps d'attribution (secondes)</label>
                        <input type="number" name="using_time" class="form-control" id="using_time" placeholder="500" value="{{ $parking->using_time }}">
                    </div>
                    <div class="col"></div>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
@endsection