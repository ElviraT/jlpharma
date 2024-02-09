<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}" />
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
            letter-spacing: 1px;
            line-height: 18px;
        }

        #detalle_info,
        tr th td {
            border: 2px solid #555;
        }

        #detalle_info thead {
            background-color: #049383;
            border-bottom: 1px solid #555;
            color: white;
        }

        #detalle_info tfoot {
            border-top: 1px solid #555;
        }
    </style>



<body>
    <table>
        <tr>
            <td>
                <img src="{{ asset('img/favicon.png') }}" alt="" width="30%">
            </td>

            <td>
                <h1>
                    {{ 'Gestion de ventas JL Pharma Medicamentos' }}

                </h1>
            </td>
        </tr>
    </table>
    <hr>
    <table width='100%'>
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
                <th width='2%'>Nro.</th>
                <th>Producto</th>
                <th width='10%'>Cantidad</th>
                <th width='15%'>Precio Unitario</th>
                <th width='15%'>Total $</th>
            </tr>
        </thead>
        <tbody>
            @php($cant = 0)
            @foreach ($order['detalle'] as $key => $item)
                @php($cant = $cant + $item->cant)
                <tr>
                    <td align="center">{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td align="center">{{ $item->cant }}</td>
                    <td align="center">{{ number_format($item->price, 2) . '$' }}</td>
                    <td align="center">{{ number_format($item->importe, 2) . '$' }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">{{ 'Total' }}</th>
                <th>{{ $cant }}</th>
                <th colspan="2" align="right">{{ number_format($order['pedido']->total, 2) . '$' }}<br>
                    {{ number_format($order['pedido']->total_bs, 2) . 'Bs' }}</th>
            </tr>
        </tfoot>
    </table>
    <hr>
    <div>
        <strong>{{ 'Observación: ' }}</strong> {{ $order['order']->observation }}
    </div>
</body>

</html>
