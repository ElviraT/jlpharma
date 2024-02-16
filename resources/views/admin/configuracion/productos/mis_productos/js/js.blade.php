<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#AllDataTable_prod').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('mis_productos.get-product-data') }}",
            columns: [{
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return '<span class="dos_lineas">' + data + '</span>';
                    }
                },
                {
                    data: 'price',
                    name: 'price',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return data.toFixed(2) + ' $';
                    }
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    orderable: false,
                    searchable: false
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
            // initComplete: function(settings, json) {
            //     // Inicializa Bootstrap Toggle
            //     initializeBootstrapToggle();
            // }
        });

    });

    $('#modal_producto').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_product_id', modal).val(data.recordId);
            $.getJSON('mis-productos/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $('#name', modal).val(obj.name);
                $('#price', modal).val(obj.price);
                $('#quantity').val(obj.quantity);
                $('#quantity_min').val(obj.quantity_min);
                modal.removeClass('loading');
            });
        }
    });
</script>
