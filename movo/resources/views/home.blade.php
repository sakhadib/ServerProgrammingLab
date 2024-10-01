@extends('layouts.app')

@section('title', 'Home')

@section('main')

<div class="container">
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <form action="/search" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-floating mb-3">
                            <input name="movie" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Movie Name</label>
                        </div>
                    </div>
                    <div class="col-md-3 df jcc aic">
                        <button type="submit" class="btn btn-lg btn-danger w-100 mb-3">Search</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>


@endsection