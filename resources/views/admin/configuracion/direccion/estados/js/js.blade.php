<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.pickerSelectClass').selectize({
            preload: true,
            loadingClass: 'loading',
            closeAfterSelect: true
        });
    });
    $('#modal_estado').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_estado_id', modal).val(data.recordId);
            $.getJSON('states/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                var $country = $('#idCountry').selectize();
                $country[0].selectize.setValue(obj.idCountry);
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_estado').on('hidden.bs.modal', function(e) {
        $('#nombre').val('');
    });
</script>
