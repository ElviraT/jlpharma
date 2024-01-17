<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('.otro').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
        });
    });
    $(function() {
        $('.status').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
        });
    });

    $(document).ready(function() {
        // ASIGNAR NUMERO DE PEDIDO
        var iduser = $('#envia').val();
        $.ajax({
            url: '../combo/' + iduser + '/user',
            type: 'GET',

            error: function(err) {
                console.log(err);
            },

            success: function(options) {
                $('#contador').val(options['name']);
                $('#realizar_pedido').attr('disabled', false);
            }

        });
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
        $('#idPara').attr('readonly', true);
        $('#idDe').val('');
        $.ajax({
            url: './combo/' + combo + '/combo_pedido',
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
            $('#idPara').attr('readonly', false);
        }
    });
    $("input[name='para']").change(function() {
        // var combo = $(this).val();
        if ($(this).val() == 'Droguería') {
            var combo = $('#idDe').val();
        } else {
            var combo = $(this).val();
        }

        $('#idPara').val('');
        $.ajax({
            url: './combo/' + combo + '/combo_pedido',
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

    $('#confirm-rechazar').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $('#id', modal).val(data.recordId);
        $('.title', this).text(data.recordTitle);
        modal.removeClass('loading');
    });
</script>
