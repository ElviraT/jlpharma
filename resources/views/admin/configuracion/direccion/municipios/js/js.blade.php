<!-- Select2 -->
<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(function() {
        $('.pickerSelectClass').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
        });
    });
    $('#modal_municipio').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_municipio_id', modal).val(data.recordId);
            $.getJSON('municipality/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                var $estado = $('#state').selectize();
                $estado[0].selectize.setValue(obj.idState);
                $('#name', modal).val(obj.name);
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_municipio').on('hidden.bs.modal', function(e) {
        $('#state')[0].selectize.clear();
        $('#name').val('');
    });
</script>
