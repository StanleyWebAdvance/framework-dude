@extends('admin.layouts.base')

@section('style')

    <style>
        .logo-dude {
            margin: 20px 0 10px 0;
        }

        .logo-dude p {
            font-size: 25px;
        }

        .enter-dude {
            margin: 40px 0 30px 0;
        }

        .enter-dude a {
            text-decoration: none;
            font-size: 20px;
        }
        .form-login{
            margin: 50px 0 0 0;
        }
    </style>

@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-12 text-center enter-dude">
                <a href="/login">login</a> / <a href="/registration">registration</a> / <a href="/">index</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 logo-dude">
                <p class="lead text-center">Hey, whats up dude? Login please.</p>
            </div>
        </div>

        @if(!empty($errors))
            <ul>
                @foreach($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="row align-items-start">

            <div class="col"></div>

            <div class="col">
                <form action="/login" method="post" class="form-login">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" name="email" class="form-control" aria-describedby="emailHelp"
                               placeholder="Enter your email address dude">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter your password dude">
                    </div>
                    <div class="form-group">
                        {{ $captcha }}
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="remember" class="form-check-input" checked="checked" id="check">
                        <label class="form-check-label" for="check">I will remember you dude</label>
                    </div>
                    {{ $_token }}
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>

            <div class="col"></div>

        </div>

    </div>
@endsection




