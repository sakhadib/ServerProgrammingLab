@extends('layouts.app')

@section('title', '{{$movie->Title}}')

@section('main')

<div class="container">
    <div class="row">
        <div class="col-md-4 mt-5">
            <div class="row">
                <img src="{{$movie->Poster}}" alt="" style="width: 100%">
            </div>
            <div class="row">
                @foreach($tags as $tag)
                    <div class="col-auto mt-3 mb-3">
                        <button class="btn btn-danger">{{$tag}}</button>
                    </div>
                @endforeach
            </div>
            
            
        </div>
        <div class="col-md-8 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-4">{{$movie->Title}}</h1>
                    </div>
                </div>
                <div class="row mt-5">
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




@endsection