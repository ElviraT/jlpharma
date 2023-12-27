<script type="text/javascript">
    $('#modal_pais').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_pais_id', modal).val(data.recordId);
            $.getJSON('countries/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_pais').on('hidden.bs.modal', function(e) {
        $('#name').val('');
    });
</script>
