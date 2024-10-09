@extends('layouts.app')

@section('title', '{{$movie->Title}}')

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-4 mt-5">
            <div class="row">
                <img src="{{$movie->Poster}}" alt="" style="width: 100%;" class="bs">
            </div>
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
                          <button class="btn btn-lg btn-outline-dark">{{$tag}}</button>
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