<script type="text/javascript">
    $('#modal_producto').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_product_id', modal).val(data.recordId);
            $.getJSON('mis-productos/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $('#name', modal).val(obj.name);
                $('#price', modal).val(obj.price);
                $('#quantity').val(obj.quantity);
                $('#quantity_min').val(obj.quantity_min);
                modal.removeClass('loading');
            });
        }
    });
</script>
