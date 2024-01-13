<script>
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
