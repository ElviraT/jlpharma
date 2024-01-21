<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            letter-spacing: 1px;
            line-height: 27px;
        }

        #detalle_info,
        tr th td {
            border: 2px solid #555;
        }

        #detalle_info thead {
            background-color: rgb(80, 255, 182);
            border-bottom: 1px solid #555;
        }

        #detalle_info tfoot {
            border-top: 1px solid #555;
        }
    </style>

<body>
    <table>
        <tr>
            <td><img src="{{ asset('img/favicon.png') }}" alt="" width="27%"></td>
            <td>
                <h1>{{ 'Gestion de ventas JL' }}</h1>
            </td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td width="60%">
                <h3>{{ 'Datos del Cliente' }}</h3>
                <label>{{ 'RIF:  ' }}</label><span>{{ $order['order']->rif }}</span><br>
                <label>{{ 'Razón Social:  ' }}</label><span>{{ $order['order']->rs }}</span><br>
                <label>{{ 'Contacto:  ' }}</label><span>{{ $order['order']->c_nombre . ' ' . $order['order']->c_apellido }}</span><br>
                <label>{{ 'Segmento:  ' }}</label><span>{{ $order['order']->segmento }}</span><br>
                <label>{{ 'SICM/SADA:  ' }}</label><span>{{ $order['order']->sada . '/' . $order['order']->sicm }}</span><br>
                <label>{{ 'Teléfono:  ' }}</label><span>{{ $order['order']->telefono }}</span><br>
                <label>{{ 'Email:  ' }}</label><span>{{ $order['order']->email }}</span><br>
                <label>{{ 'Dirección:  ' }}</label><span>{{ $order['order']->direccion }}</span>
            </td>
            <td width="40%">
                <h3>{{ 'Datos de la orden' }}</h3>
                <label>{{ 'Pedido:  ' }}</label><span>{{ $order['pedido']->nOrder }}</span><br>
                <label>{{ 'Fecha:  ' }}</label><span>{{ date_format($order['pedido']->created_at, 'Y/m/d h:i') }}</span><br>
                <label>{{ 'Estado:  ' }}</label><span>{{ $order['pedido']->status->name }}</span>
                @if (isset($order['vendedor']))
                    <h3>{{ 'Datos del vendedor' }}</h3>
                    <label>{{ 'Cedula:  ' }}</label><span>{{ $order['vendedor']->dni }}</span><br>
                    <label>{{ 'Nombre:  ' }}</label><span>{{ $order['vendedor']->name }}</span><br>
                    <label>{{ 'Teléfono:  ' }}</label><span>{{ $order['vendedor']->telefono }}</span>
                @endif
            </td>
        </tr>
    </table>

    <h3>{{ 'Detalle del pedido' }}</h3>
    <table id="detalle_info" width="100%">
        <thead>
            <tr>
                <th>Nro.</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order['detalle'] as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->cant }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->importe }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">{{ 'Total' }}</th>
                <th>{{ $order['pedido']->total }}</th>
            </tr>
        </tfoot>
    </table>
    <hr>
    <div>
        <strong> {{ $order['order']->observation }} </strong>
    </div>
</body>

</html>
