@extends('layouts.app')

@section('title', $movie->Title)

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-4 mt-5">
            <div class="row">
                <img src="{{$movie->Poster}}" alt="" style="width: 100%;" class="bs">
            </div>
            @if(session('geek_id'))
            <div class="row mt-3">
              <div class="col-6">
                @if($wishlist == false)
                <form action="/addWishlist" method="POST">
                  @csrf
                  <input type="text" name="movie_id" id="" value="{{$movie->id}}" hidden>
                  <button type="submit" class="btn btn-dark w-100">Add to Favourite</button>
                </form>
                @else
                <form action="/removeWishlist" method="POST">
                  @csrf
                  <input type="text" name="movie_id" id="" value="{{$movie->id}}" hidden>
                  <button type="submit" class="btn btn-outline-dark w-100">Remove from Favourite</button>
                </form>
                @endif
              </div>

              <div class="col-6">
                @if($watched == false)
                <form action="/addWatched" method="POST">
                  @csrf
                  <input type="text" name="movie_id" id="" value="{{$movie->id}}" hidden>
                  <button type="submit" class="btn btn-dark w-100">Add to Watched</button>
                </form>
                @else
                <form action="/removeWatched" method="POST">
                  @csrf
                  <input type="text" name="movie_id" id="" value="{{$movie->id}}" hidden>
                  <button type="submit" class="btn btn-outline-dark w-100">Remove from Watched</button>
                </form>
                @endif
              </div>
              
            </div>
            @endif
        </div>
        <div class="col-md-8 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4">{{$movie->Title}}</h1>
                        <p class="fs-4">Director : {{$movie->Director}}</p>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="box-card df dfc jcc">
                      <div class="row">
                        <div class="col-4 df jcc aic">
                          <h1 class="display-5"><i class="uil uil-clock"></i></h1>
                        </div>
                        <div class="col-8 df jcs aic">
                          <h1 class="display-6">{{$movie->Runtime}}</h1>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="box-card df dfc jcc">
                      <div class="row">
                        <div class="col-4 df jcc aic">
                          <h1 class="display-5"><i class="uil uil-calender"></i></h1>
                        </div>
                        <div class="col-8 df jcs aic">
                          <h1 class="display-6">{{$movie->Released}}</h1>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  @foreach($tags as $tag)
                      <div class="col-auto mt-3 mb-3">
                          <a href="/tag/{{$tag->id}}" class="btn btn-sm btn-outline-dark">{{$tag->name}}</a>
                      </div>
                  @endforeach
              </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                              <tr>
                                <th scope="row">Year</th>
                                <td>{{$movie->Year}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Rated</th>
                                <td>{{$movie->Rated}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Released</th>
                                <td>{{$movie->Released}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Run Time</th>
                                <td>{{$movie->Runtime}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Director</th>
                                <td>{{$movie->Director}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Language</th>
                                <td>{{$movie->Language}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Country</th>
                                <td>{{$movie->Country}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Type</th>
                                <td>{{$movie->Type}}</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .box-card {
        width: 100%;
        height: 80px;
        background-color: #f1f1f1;
        border-radius: 10px;
        margin-top: 10px;
    }
</style>

@endsection