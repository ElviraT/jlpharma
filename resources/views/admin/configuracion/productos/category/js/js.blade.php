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

    $('#modal_categoria').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_category_id', modal).val(data.recordId);
            $.getJSON('category/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                var $speciality = $('#speciality').selectize();
                $speciality[0].selectize.setValue(obj.idSpeciality);
                $('#name', modal).val(obj.name);
                $('#color', modal).val(obj.color);
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_categoria').on('hidden.bs.modal', function(e) {
        $('#name').val('');
        $('#color').val('');
    });
</script>
