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

    $('#mySelect').on('change', function() {
        var value = $(this).val();
        $("#telefono").val(value);
        $("#telefono").focus();

    });
    $('#mySelect1').on('change', function() {
        var value = $(this).val();
        $("#telephone").val(value);
        $("#telephone").focus();

    });
    $('#mySelect2').on('change', function() {
        var value = $(this).val();
        $("#telephone2").val(value);
        $("#telephone2").focus();

    });
</script>
