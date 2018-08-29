@extends('admin.layouts.base')

@section('content')
    <a href="/login">Вход</a>

    <p>{{ $_token }}</p>

    <hr>

    <ul>

        @foreach ($pages as $page)

            <li>{{ $page['title'] }} || <i>{{ $page['uri'] }}</i> || <b>{{ $page['text'] }}</b> </li>

        @endforeach

    </ul>

    <br>
    <br>
    <hr>

    @if($errors)
        <ul>
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form class="form-horizontal" action="/upload/image" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="image" class="col-sm-3 control-label">Основное изображение:</label>
            <div class="col-sm-5">
                <input type="file" id="image" name="image">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type="hidden" name="_token" value="{{ $_token }}">
                <button type="submit" class="btn btn-success">сохранить</button>
            </div>
        </div>

    </form>

@endsection
