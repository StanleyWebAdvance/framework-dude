@extends('admin.layouts.base')

@section('style')

    <style>
        .not-found-dude{
            margin: 177px 0 30px 0;
        }
        .not-found-dude p{
            font-size: 177px;
        }
        .enter-dude a{
            text-decoration: none;
            font-size: 20px;
        }
    </style>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 not-found-dude">
            <p class="lead text-center">404</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center enter-dude">
            <a href="/" >return to main page dude!</a>
        </div>
    </div>

@endsection