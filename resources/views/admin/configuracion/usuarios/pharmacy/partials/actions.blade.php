@can('pharmacy.edit')
    <a href="{{ route('pharmacy.edit', $pharmacy) }}" type="button" class="btn-transition btn btn-outline-success btn-sm"
        title="{{ __('Edit Pharmacy') }}">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="edit-3" class="feather-icon"></i>
        </span>
    </a>
@endcan
@can('pharmacy.destroy')
    <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete" data-record-id="{{ $pharmacy->id }}"
        data-record-title="{{ 'la farmacia ' }}{{ $pharmacy->name }}"
        data-action="{{ route('pharmacy.destroy', $pharmacy->id) }}" title="{{ __('Delete Pharmacy') }}"
        class="btn-transition btn btn-outline-danger btn-sm">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="trash-2" class="feather-icon"></i>
        </span>
    </a>
@endcan

<script>
    feather.replace();
</script>
