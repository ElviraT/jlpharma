<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>{{ 'Pedido de: ' }}{{ $order->userSend->name }}</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        td {
            text-align: center;
        }

        table thead {
            background-color: #04c38c;
        }

        p {
            font-family: "Segoe UI";
            font-size: 16px;
        }
    </style>
</head>

<body>
    <p>Hola! <strong>{{ $order->userReceives->name }}</strong>, Se ha reportado un nuevo pedido.</p>
    <p>Estos son los datos del pedido realizado</p>
    <br>
    <table id="AllDataTable" width="100%">
        <thead>
            <tr>
                <th>{{ 'NOMBRE' }}</th>
                <th>{{ 'CANTIDAD' }}</th>
                <th>{{ 'PRECIO UNITARIO' }}</th>
                <th>{{ 'IMPORTE' }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->detalle as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->cant }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->importe, 2) }}</td>
                </tr>
            @endforeach
            <tr class="fw-bolder">
                <td colspan="2"></td>
                <th class="text-end">{{ 'Total' }}</th>
                <td class="text-end">
                    {{ $order->total }}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
