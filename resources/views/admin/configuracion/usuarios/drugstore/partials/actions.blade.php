@can('drugstore.edit')
    <a href="{{ route('drugstore.edit', $drugstore) }}" type="button" class="btn-transition btn btn-outline-success btn-sm"
        title="{{ __('Edit drugstore') }}">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="edit-3" class="feather-icon"></i>
        </span>
    </a>
@endcan
@can('drugstore.destroy')
    <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete" data-record-id="{{ $drugstore->id }}"
        data-record-title="{{ 'la droguería ' }}{{ $drugstore->name }}"
        data-action="{{ route('drugstore.destroy', $drugstore->id) }}" title="{{ __('Delete drugstore') }}"
        class="btn-transition btn btn-outline-danger btn-sm">
        <span class="btn-icon-wrapper pr-2 opacity-7">
            <i data-feather="trash-2" class="feather-icon"></i>
        </span>
    </a>
@endcan

<script>
    feather.replace();
</script>
