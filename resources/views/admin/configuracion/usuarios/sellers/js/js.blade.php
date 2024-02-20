<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#AllDataTable_seller').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('seller.get-seller-data') }}",
            columns: [{
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return '<span class="dos_lineas">' + data + '</span>';
                    }
                },
                {
                    data: 'telefono',
                    name: 'telefono',

                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language: {
                url: "{{ asset('js/Spanish.json') }}",
            },
        });
    });
    $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
        });
    });
    $('#mySelect').on('change', function() {
        var value = $(this).val();
        $("#telefono").val(value);
        $("#telefono").focus();

    });
</script>
