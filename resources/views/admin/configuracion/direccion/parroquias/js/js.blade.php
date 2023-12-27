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
    $('#modal_parroquia').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_parroquia_id', modal).val(data.recordId);
            $.getJSON('parishes/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                var $municipio = $('#municipality').selectize();
                $municipio[0].selectize.setValue(obj.idMunicipality);
                $('#name', modal).val(obj.name);
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_parroquia').on('hidden.bs.modal', function(e) {
        $('#municipio')[0].selectize.clear();
        $('#nombre').val('');
    });
</script>
