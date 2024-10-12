@extends('layouts.app')

@section('title', 'Home')

@section('main')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <form action="/search" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 df dfc jcc" style="padding: 12px; padding-bottom: 0px; border-radius: 10px">
                        <div class="input-group mb-3">
                            <!-- Movie Name Input Field -->
                            <div class="form-floating">
                                <input name="movie" type="text" class="form-control" id="floatingInput" placeholder="Movie Name">
                                <label for="floatingInput">Movie Name</label>
                            </div>
            
                            <!-- Search Button inside Input Group -->
                            <button type="submit" class="btn btn-danger btn-lg">Search</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <div class="row">
        @foreach($movies as $movie)
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



<style>
    .card:hover {
        transform: scale(1.1);
        transition: 0.2s ease-in-out all;
        cursor: pointer;
    }

    .card{
        transition: 0.2s ease-in-out all;
    }
</style>


@endsection