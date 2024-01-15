<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <!-- Styles -->
    <style>
        html,
        body {
            font-family: 'Georgia';
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }


        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        a {
            color: #303030;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            text-shadow: 2px 2px 2px #fff;
        }

        h1,
        h3 {
            letter-spacing: .1rem;
            color: #636b6f;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="container-fluid" align="center">
            <img src="{{ asset('img/logo.png') }}" alt="logo" width="30%">
            <h1>Parece Que Estas Presentando Problemas</h1>

            <div class="property-preview-content"
                style="margin-left: 100px; margin-right: 100px; border:2px solid #04c38c;" align="center">
                <table>
                    <tr>
                        <h2><i class="fa fa-hand-o-left" aria-hidden="true"> <a href="javascript:history.back(1)">Volver
                                    a la página anterior</a></i></h2><br><br>

                        <!--h2><i class="fa fa-users" aria-hidden="true"> <a href="https://www.soporte.mainframe.com.ve/">Soporte</a></i></h2 -->
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
