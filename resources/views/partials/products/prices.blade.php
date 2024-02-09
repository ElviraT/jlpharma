<strong>{{ 'Centro de salud: ' }}</strong>{{ number_format($product->price_cs, 2) . '$' }}<br>
<strong>{{ 'Droduería: ' }}</strong>{{ number_format($product->price_dg, 2) . '$' }}<br>
<strong>{{ 'Stock: ' }}</strong>{{ $product->quantity }}
