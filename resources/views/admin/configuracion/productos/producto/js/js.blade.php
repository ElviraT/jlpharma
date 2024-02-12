<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#AllDataTable_prod').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.get-product-data') }}",
            columns: [{
                    data: 'image',
                    name: 'img',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'codigo',
                    name: 'codigo'
                },
                {
                    data: 'name',
                    name: 'name',
                    render: function(data, type, row) {
                        return '<span class="dos_lineas">' + data + '</span>';
                    }
                },
                {
                    data: 'prices',
                    name: 'prices',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'category.name',
                    name: 'category.name'
                },
                {
                    data: 'available',
                    name: 'available',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'rotacion',
                    name: 'rotacion',
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
            initComplete: function(settings, json) {
                // Inicializa Bootstrap Toggle
                initializeBootstrapToggle();
            }
        });

        function initializeBootstrapToggle() {
            $('input[name="available"], input[name="rotacion"]').bootstrapToggle();
        }

        // Vuelve a inicializar Bootstrap Toggle después de que la tabla se vuelva a renderizar (por ejemplo, después de una búsqueda)
        $('#AllDataTable_prod').on('draw.dt', function() {
            initializeBootstrapToggle();
        });
    });

    $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
        });
    });

    $('#modal_producto').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        var codigo = 0;
        var letras;
        letras = $('#contador').val().slice(1);
        var contador = parseInt(letras) + parseInt(1);
        if (contador < 10) {
            codigo = ('P00' + contador);
        } else if (contador < 100) {
            codigo = ('P0' + contador);
        } else if (contador < 1000) {
            codigo = ('P' + contador);
        }
        $('#codigo').val(codigo);
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_product_id', modal).val(data.recordId);
            $.getJSON('product/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', obj.action);
                $("#method").val('put');
                var $category = $('#category').selectize();
                $category[0].selectize.setValue(obj.idCategory);
                $('#codigo', modal).attr('readonly', false);
                $('#codigo', modal).val(obj.codigo);
                $('#codigo', modal).attr('readonly', true);
                $('#name', modal).val(obj.name);
                $('#description', modal).val(obj.description);
                $('#codigo', modal).val(obj.codigo);
                $('#img', modal).attr('src', '../' + img);
                $('#price_cs', modal).val(obj.price_cs);
                $('#price_dg', modal).val(obj.price_dg);
                $('#price_tf', modal).val(obj.price_tf);
                $('#quantity').val(obj.quantity);
                $('#quantity_min').val(obj.quantity_min);
                $('#quantity_tf').val(obj.quantity_tf);
                $('#check').attr('hidden', false);
                if (obj.available == 1) {
                    $('#available').prop('checked', true).change();
                }
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_producto').on('hidden.bs.modal', function(e) {
        $('#codigo').val('');
        $('#name').val('');
        $('#description').val('');
        $('#codigo').val('');
        $('#img').attr('src', '');
        $('#price_cs').val('');
        $('#price_dg').val('');
        $('#price_tf').val('');
        $('#idCategory').val('').trigger('change.select2');
        $('#check').attr('hidden', true);
        $('#available').bootstrapToggle('on');
        $('#quantity').val('');
        $('#quantity_min').val('');
        $('#quantity_tf').val('');
    });
    $(function() {
        $('[data-toggle="popover"]').popover({
            container: 'body',
            trigger: 'focus'
        })
    })

    function activar(idP, idDis) {
        var id = idDis;
        var idPro = idP;
        $.ajax({
            url: './activar/' + id + '/' + idPro + '/product',
            type: 'GET',

            error: function(err) {
                console.log(err);
            },

            success: function(options) {
                console.log('OK');
                window.location.reload();
            }
        });
    }

    function rotacion(idP, idRot) {
        var id = idRot;
        var idPro = idP;
        $.ajax({
            url: './rotacion/' + id + '/' + idPro + '/product',
            type: 'GET',

            error: function(err) {
                console.log(err);
            },

            success: function(options) {
                console.log('OK');
                window.location.reload();
            }
        });
    }
</script>
