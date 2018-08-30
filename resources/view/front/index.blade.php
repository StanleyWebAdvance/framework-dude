@extends('admin.layouts.base')

@section('style')

    <style>
        .logo-dude {
            margin: 277px 0 77px 0;
        }

        .logo-dude p {
            font-size: 77px;
        }

        .enter-dude a {
            text-decoration: none;
            font-size: 20px;
        }
    </style>

@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12 logo-dude">
                <p class="lead text-center">framework-dude</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center enter-dude">
                <a href="/login">login</a> / <a href="/registration">registration</a>
            </div>
        </div>

    </div>

@endsection