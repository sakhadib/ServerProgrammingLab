@extends('layouts.app')

@section('title', 'Tag Selector')

@section('main')

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5">
                <h1 class="display-3">Select your genre...</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="/genreChoice" method="post">
                    @csrf
                    <div class="row">
                        @foreach ($tags as $tag)
                            <div class="col-auto mt-3 mb-3">
                                <input name="tags[]" type="checkbox" class="btn-check" id="btn-check-{{ $tag->id }}" autocomplete="off" value="{{ $tag->id }}">
                                <label class="btn btn-lg btn-outline-dark" for="btn-check-{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12 mt-1">
                            <button type="submit" class="btn btn-lg btn-danger w-100 mt-5">Submit Selection</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 df jcc aic">
                <img src="/asset/genre.png" alt="" style="width: 60%">
            </div>
        </div>
    </div>
</div>




<style>
    .page {
        height: 90vh;
    }
</style>




@endsection