<script type="text/javascript">
    $('#modal_statusp').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_status_id', modal).val(data.recordId);
            $.getJSON('statusp/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#color', modal).val(obj.color);
                $('#orden', modal).val(obj.orden);
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_statusp').on('hidden.bs.modal', function(e) {
        $('#name').val('');
        $('#color').val('');
        $('#orden').val('');
    });
</script>
