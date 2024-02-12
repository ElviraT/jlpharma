<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table_roles = $('#AllDataTable_checkout').DataTable({
            lengthChange: false,
            "order": [],
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
    $(function() {
        $('.select').selectize({
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
            $('#idPara').val('').change();
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
    $('#cambiar_status').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $('#id', modal).val(data.recordId);
        $('#leer', modal).val(data.recordLeer);
        // $('.title', this).text(data.recordTitle);
        modal.removeClass('loading');
    });
    $('#permiso_modal').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $('#no_pedido', modal).text(data.recordNpedido);
        $('#pedido', modal).val(data.recordNpedido);
        $('#cliente', modal).val(data.recordCliente);
        $('#id_pedido', modal).val(data.recordId);
        modal.removeClass('loading');
    });

    // MODAL INFO
    $('#modal_info').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('#estado', modal).text(data.recordStatus);
            $('#id_pdf', modal).val(data.recordId);
            var url = "{{ route('order.info', 'id') }}";
            url = url.replace('id', data.recordId);
            $.getJSON(url, function(data) {

                var options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true,
                };
                console.log(data);
                var fecha = new Date(data.pedido.created_at);
                $('#idTitle').append(data.pedido.nOrder);
                $('#rif').text(data.order.rif);
                $('#rs').text(data.order.rs);
                $('#contacto').text(data.order.c_nombre + ' ' + data.order.c_apellido);
                $('#seg').text(data.order.segmento);
                $('#sada').text(data.order.sada + '/' + data.order.sicm);
                $('#tel').text(data.order.telefono);
                $('#email').text(data.order.email);
                $('#dir').text(data.order.direccion);
                $('#nopedido').text(data.pedido.nOrder);
                $('#fecha').text(fecha.toLocaleDateString("es-ES", options));
                if (data.vendedor) {
                    $('#cedula').text(data.vendedor.dni);
                    $('#nombre').text(data.vendedor.name);
                    $('#telefono').text(data.vendedor.telefono);
                }
                // DETALLE DE PEDIDO
                $("#cuerpo").html("");
                $("#footer").html("");
                var total_cant = 0;
                var totalbs = 0;
                for (var i = 0; i < data.detalle.length; i++) {
                    total_cant += parseInt(data.detalle[i].cant, 10);
                    var tr = `<tr>
                    <td>` + ([parseInt(i) + parseInt(1)]) + `</td>
                    <td><span class="dos_lineas">` + data.detalle[i].name + `</span></td>
                    <td>` + data.detalle[i].cant + `</td>
                    <td>$` + data.detalle[i].price.toFixed(2) + `</td>
                    <td>$` + data.detalle[i].importe.toFixed(2) + `</td>
                    </tr>`;
                    $("#cuerpo").append(tr)

                }
                var trF = `<tr>
                    <th></th>
                    <th></th>
                    <th>` + total_cant + `</th>
                    <th>Total</th>
                    <th>$ ` + data.pedido.total.toFixed(2) + '<br>' +
                    `Bs ` + data.pedido.total_bs.toFixed(2) + `</th> 
                    </tr>`;
                $("#footer").append(trF)
                // FIN DETALLE
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_info').on('hidden.bs.modal', function() {
        $('#estado').text('');
        $('#idTitle').text('Pedido ');
        $('#rif').text('');
        $('#rs').text('');
        $('#contacto').text('');
        $('#seg').text('');
        $('#sada').text('');
        $('#tel').text('');
        $('#email').text('');
        $('#dir').text('');
        $('#pedido').text('');
        $('#fecha').text('');
        $('#cedula').text('');
        $('#nombre').text('');
        $('#telefono').text('');
        $("#cuerpo").html('');
        $("#footer").html('');
    });
    // FIN MODAL INFO
</script>
