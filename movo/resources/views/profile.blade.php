@extends('layouts.app')

@section('title', 'Profile')

@section('main')

    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-3">{{$geek->name}}</h1>
                </div>
            </div>
            <div class="row">
                @foreach($tags as $tag)
                <div class="col-auto">
                    <a href="/tag/{{$tag->id}}" class="btn btn-outline-secondary">{{$tag->name}}</a>
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h1 class="display-6">Favourites of {{ strtok($geek->name, ' ') }},</h1>
                </div>
            </div>
            <div class="row">
                @foreach($favourites as $movie)
                <div class="col-md-3 mt-4">
                    <div class="card bs" style="position: relative;">
                        <!-- Card image -->
                        <div style="position: relative; width: 100%; padding-top: 75%; overflow: hidden;">
                            <img src="{{$movie->Poster}}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" class="card-img-top" alt="...">
                        </div>
        
                        <!-- Rated button positioned in the top-right corner -->
                        <button class="btn btn-warning btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 1;">{{$movie->Rated}}</button>
        
                        <!-- Card body -->
                        <div class="card-body">
                            <h5 class="card-title mt-2">{{$movie->Title}}</h5>
                            <p class="card-text">{{$movie->Year}} . {{$movie->Director}}</p>
                            <a href="/movie/{{$movie->id}}" class="btn btn-danger w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>



    <style>
        .page{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>

<style>
    .card-img-top-wrapper {
        position: relative;
        width: 100%;
        padding-top: 133.33%; /* 3:4 aspect ratio */
        overflow: hidden;
    }
    .card-img-top-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>


@endsection