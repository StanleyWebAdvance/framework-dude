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

@endsection
