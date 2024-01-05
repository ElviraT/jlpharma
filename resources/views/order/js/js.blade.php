<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // ASIGNAR NUMERO DE PEDIDO
        var codigo = 0;
        var letras;
        letras = $('#contador').val().slice(3);
        var contador = parseInt(letras) + parseInt(1);
        if (contador < 10) {
            codigo = ('PE-000' + contador);
        } else if (contador < 100) {
            codigo = ('PE-00' + contador);
        } else if (contador < 1000) {
            codigo = ('PE-0' + contador);
        } else if (contador < 10000) {
            codigo = ('PE-' + contador);
        }
        $('#order').val(codigo);
        // FIN

        var combo = $('#combo').val();
        if (combo == '["Drogueria"]') {
            url = 'JL';
            $('.otro').attr('required', true);
        } else if (combo == '["Farmacia"]') {
            url = 'Droguería';
            $('.otro').attr('required', true);
        } else {
            url = '';
            $('.otro').attr('required', false);
            $('.otro').attr('hidden', true);
            $('#idPara').attr('required', true);
            $('#idDe').attr('required', true);
        }
        $.ajax({
            url: '../combo/' + url + '/combo_pedido',
            type: 'GET',

            error: function(err) {
                console.log(err);
            },

            success: function(options) {
                $('#idPara').selectize()[0].selectize.destroy();
                $('#idPara').selectize({
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name',
                    preload: true,
                    options: options,
                    create: true,
                });
            }
        });
    });
    $("input[name='de']").change(function() {
        var combo = $(this).val();
        $('#idDe').val('');
        $.ajax({
            url: '../combo/' + combo + '/combo_pedido',
            type: 'GET',

            error: function(err) {
                console.log(err);
            },

            success: function(options) {
                $('#idDe').selectize()[0].selectize.destroy();
                $('#idDe').selectize({
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name',
                    preload: true,
                    options: options,
                    create: true,
                });
            }
        });
    });
    $('#idDe').change(function() {
        var idDe = $(this).val();
        if (idDe != '') {
            $("#envia").val(idDe);
        }
    });
    $("input[name='para']").change(function() {
        var combo = $(this).val();
        $('#idPara').val('');
        $.ajax({
            url: '../combo/' + combo + '/combo_pedido',
            type: 'GET',

            error: function(err) {
                console.log(err);
            },

            success: function(options) {
                $('#idPara').selectize()[0].selectize.destroy();
                $('#idPara').selectize({
                    valueField: 'id',
                    labelField: 'name',
                    searchField: 'name',
                    preload: true,
                    options: options,
                    create: true,
                });
            }
        });
    });
    $('#idPara').change(function() {
        var idPara = $(this).val();
        if (idPara != '') {
            $("#recibe").val(idPara);
        }
    });
    $('#confirm-aceptar').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $('#id', modal).val(data.recordId);
        $('.title', this).text(data.recordTitle);
        modal.removeClass('loading');
    });
</script>
