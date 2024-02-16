@can('mis_productos.edit')
    <a href="#" type="button" data-toggle="modal" data-target="#modal_producto"
        class="btn-transition btn btn-outline-success" data-record-id="{{ $product['id'] }}" title="{{ __('Edit Product') }}"
        data-action="{{ route('product.update', $product) }}">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="edit-3" class="feather-icon"></i>
        </span>
    </a>
@endcan

@if ($product->quantity <= $product->quantity_min)
    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom"
        title="Producto con cantidad minima"><i class="fas fa-exclamation-triangle text-white"></i></button>
@endif


<script>
    feather.replace();
</script>
