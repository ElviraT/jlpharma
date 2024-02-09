@can('product.edit')
    <a href="#" type="button" data-toggle="modal" data-target="#modal_producto"
        class="btn-transition btn btn-outline-success btn-sm"
        data-record-id="{{ $product->id }}"
        title="{{ __('Edit Product') }}"
        data-action="{{ route('product.update', $product->id) }}">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="edit-3" class="feather-icon"></i>
        </span>
    </a><br>
@endcan
@can('product.destroy')
    <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete"
        data-record-id="{{ $product->id }}"
        data-record-title="{{ 'el producto ' }}{{ $product->name }}"
        data-action="{{ route('product.destroy', $product->id) }}"
        title="{{ __('Delete Product') }}"
        class="btn-transition btn btn-outline-danger btn-sm">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="trash-2" class="feather-icon"></i>
        </span>
    </a><br>
@endcan
@if ($product->quantity <= $product->quantity_min)
    <a href="#" type="button" class="btn btn-outline-warning btn-sm"
        data-container="body" data-toggle="popover" data-placement="bottom"
        title="Producto con cantidad minima en stock">
        <span class="">
            <i data-feather="alert-triangle" class="feather-icon"></i>
        </span>
    </a>
@endif


<script>
    feather.replace();
</script>