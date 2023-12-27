<script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    var xhr;
    var xhr3;
    var select_country, $select_country;
    var select_state, $select_state;
    var select_city, $select_city;

    $select_country = $('#country').selectize({
        loadingClass: 'loading',
        onChange: function(value) {
            if (!value.length) return;
            /*listar estados*/
            select_state.disable();
            select_state.clearOptions();
            select_state.load(function(callback) {
                xhr3 && xhr3.abort();
                xhr3 = $.ajax({
                    url: './combo/' + value + '/state',
                    success: function(results) {
                        select_state.enable();
                        callback(results);
                    },
                    error: function() {
                        callback();
                    }
                })
            });
        }
    });

    $select_state = $('#state').selectize({
        labelField: 'name',
        valueField: 'id',
        searchField: ['name'],
        loadingClass: 'loading',
        preload: true,
        onChange: function(value) {
            if (!value.length) return;
            /*listar ciudades*/
            select_city.disable();
            select_city.clearOptions();
            select_city.load(function(callback) {
                xhr && xhr.abort();
                xhr = $.ajax({
                    url: './combo/' + value + '/city',
                    success: function(results) {
                        select_city.enable();
                        callback(results);
                    },
                    error: function() {
                        callback();
                    }
                })
            });
        }
    });

    $select_city = $('#city').selectize({
        labelField: 'name',
        valueField: 'id',
        searchField: ['name'],
        loadingClass: 'loading',
    });

    select_country = $select_country[0].selectize;
    select_state = $select_state[0].selectize;
    select_city = $select_city[0].selectize;

    $('#modal_zona').on('show.bs.modal', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.action);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.recordId != undefined) {
            modal.addClass('loading');
            $('.modal_registro_zona_id', modal).val(data.recordId);
            $.getJSON('zones/' + data.recordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.action);
                $("#method").val('put');
                var $country = $('#country').selectize();
                $country[0].selectize.setValue(obj.idCountry);
                var $state = $('#state').selectize();
                $state[0].selectize.setValue(obj.idState);
                var $city = $('#city').selectize();
                $city[0].selectize.setValue(obj.idCity);
                $('#name', modal).val(obj.name);
                modal.removeClass('loading');
            });
        }
    });
    $('#modal_zona').on('hidden.bs.modal', function(e) {
        $('#name').val('');
        $('#country')[0].selectize.clear();
        $('#state')[0].selectize.clear();
        $('#city')[0].selectize.clear();
    });
</script>
