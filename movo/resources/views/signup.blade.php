@extends('layouts.app')

@section('title', 'Signup')

@section('main')

<div class="page df dfc jcc">
    <div class="container">
        <div class="row">
            <div class="col-md-6 df dfc jcc aic">
                <div class="circle">
                    <img src="/asset/login-side.png" alt="" class="side">
                </div>
                <h1 class="display-1">MOVO</h1>
                <p class="lead">Your One Point Solution for Movies</p>
            </div>
            <div class="col-md-4 offset-md-1 df dfc jcc">
                <div class="cus-card">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h1 class="display-4">Signup</h1>
                                <p class="lead">Create your account from here</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="/signup" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="name" placeholder="name" name="name">
                                        <label for="floatingInput">Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="email" name="email">
                                        <label for="floatingInput">Email address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-danger w-100 mb-3">Signup</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .page {
        height: 90vh;
    }

    .side{
        width: 60%;
    }

    .circle {
        width: 300px;
        height: 300px;
        background-color: #ececec;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .cus-card {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

@endsection