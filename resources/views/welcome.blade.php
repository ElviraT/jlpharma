<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <!-- Styles -->
    <style>
        html,
        body {
            font-family: 'Georgia';
            font-weight: 200;
            height: 85vh;
            margin: 0;
        }

        .full-height {
            height: 90vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #303030;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-shadow: 2px 2px 2px #fff;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        h4 {
            letter-spacing: .1rem;
            color: #636b6f;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/dashboard') }}">{{ 'Home' }}</a>
                @else
                    <a href="{{ route('login') }}">{{ 'Login' }}</a>
                    {{-- <a href="{{ route('paciente.create') }}">{{ 'Registro Paciente' }}</a> --}}
                @endauth
            </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <img src="{{ asset('img/logo.png') }}" width="50%">
                {{-- {{ $response . 'response' }} --}}
            </div>
        </div>
    </div>
</body>

</html>
