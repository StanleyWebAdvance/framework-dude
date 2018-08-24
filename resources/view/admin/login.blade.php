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

        <button type="submit">Отправить</button>

    </form>

    <a href="/">на главную</a>

@endsection


@section('script')
    <script src="/assets/formAjax.js"></script>
@endsection


