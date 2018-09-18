@extends('admin.layouts.base')

@section('style')

    <style>
        .admin-dude{
            margin: 177px 0 50px 0;
        }
        .admin-dude p{
            font-size: 177px;
        }
        .logout-dude{
            margin: 40px 0 30px 0;
        }
        .logout-dude a {
            text-decoration: none;
            font-size: 20px;
        }
    </style>

@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12 text-center logout-dude">
                <a href="/logout">logout</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 admin-dude">
                <p class="lead text-center">dashboard</p>
            </div>
        </div>

    </div>

@endsection



