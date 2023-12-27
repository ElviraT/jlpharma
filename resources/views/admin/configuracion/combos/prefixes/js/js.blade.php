<script type="text/javascript">
    $('#modal_prefix').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_prefix_id', modal).val(data.recordId);
            $.getJSON('prefixes/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_prefix').on('hidden.bs.modal', function(e) {
        $('#name').val('');
    });
</script>
