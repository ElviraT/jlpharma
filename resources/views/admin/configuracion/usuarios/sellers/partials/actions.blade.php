@can('seller.edit')
    <a href="{{ route('seller.edit', $seller) }}" type="button" class="btn-transition btn btn-outline-success btn-sm"
        title="{{ __('Edit seller') }}">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="edit-3" class="feather-icon"></i>
        </span>
    </a>
@endcan
@can('seller.destroy')
    <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete" data-record-id="{{ $seller->id }}"
        data-record-title="{{ 'el vendedor ' }}{{ $seller->name }}" data-action="{{ route('seller.destroy', $seller->id) }}"
        title="{{ __('Delete seller') }}" class="btn-transition btn btn-outline-danger btn-sm">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="trash-2" class="feather-icon"></i>
        </span>
    </a>
@endcan

<script>
    feather.replace();
</script>
