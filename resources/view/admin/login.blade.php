@extends('admin.layouts.base')

@section('content')

    @if($errors)
        <ul>
            @foreach($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/login" method="post">

        <input type="text" name="name" value="">

        <input type="hidden" name="_token" value="{{ $_token }}">

        <button type="submit">Отправить</button>

    </form>

    <a href="/">на главную</a>

@endsection




