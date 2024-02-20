<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#AllDataTable_Pharmacy').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pharmacy.get-pharmacy-data') }}",
            columns: [{
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return '<span class="dos_lineas">' + data + '</span>';
                    }
                },
                {
                    data: 'rif',
                    name: 'rif'
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
    $('#mySelect1').on('change', function() {
        var value = $(this).val();
        $("#telephone").val(value);
        $("#telephone").focus();

    });
    $('#mySelect2').on('change', function() {
        var value = $(this).val();
        $("#telephone2").val(value);
        $("#telephone2").focus();

    });
</script>
