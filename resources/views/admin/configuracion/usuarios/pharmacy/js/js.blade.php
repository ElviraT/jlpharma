{{-- datepicker --}}
{{-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js') }}"></script> --}}

{{-- fileinput --}}
{{-- <script src="{{ asset('js/piexif.min.js') }}"></script>
<script src="{{ asset('js/sortable.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/fileinput.min.js') }}"></script>
<script src="{{ asset('js/LANG.js') }}"></script> --}}

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

    // $(function() {
    //     var dtn = new Date();
    //     dtn.setFullYear(new Date().getFullYear() - 18);
    //     //Date picker
    //     $('#brithday').datepicker({
    //         autoclose: true,
    //         format: 'yyyy-mm-dd',
    //         viewMode: "years",
    //         endDate: dtn,
    //         todayHighlight: true,
    //         language: 'es'
    //     });

    // });
    // $(function() {
    //     var dtn = new Date();
    //     //Date picker
    //     $('#fecha').datepicker({
    //         autoclose: true,
    //         format: 'yyyy-mm-dd',
    //         viewMode: "years",
    //         endDate: dtn,
    //         todayHighlight: true,
    //         language: 'es'
    //     });
    // });

    // $("#avatar").fileinput({
    //     languaje: 'es',
    //     overwriteInitial: false,
    //     showClose: false,
    //     showCaption: false,
    //     showBrowse: false,
    //     browseOnZoneClick: true,
    //     removeLabel: '',
    //     removeIcon: '<i class="ti-eraser"></i>',
    //     removeTitle: 'Cancelar o restablecer cambios',
    //     elErrorContainer: '#kv-avatar-errors-2',
    //     msgErrorClass: 'alert alert-block alert-danger',
    //     @if (isset($medico) && $medico->Foto_Medico != '')
    //         defaultPreviewContent: '<img src="{{ asset('avatars/' . str_replace('\\', '/', $medico->Foto_Medico)) }}" alt="Foto Perfil" style="width:100%"><h6 class="text-muted">Clic para seleccionar</h6>',
    //     @else
    //         defaultPreviewContent: '<img src="{{ asset('img/avatar.png') }}" alt="Foto Perfil" style="width:100%"><h6 class="text-muted">Clic para seleccionar</h6>',
    //     @endif
    //     layoutTemplates: {
    //         main2: '{preview} {remove} {browse}'
    //     },
    //     allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
    // });



    // $(document).ready(function() {
    //     //variables
    //     var pass1 = $('#contrasena');
    //     var pass2 = $('#contrasena2');
    //     var boton = $('#btnusuario');
    //     var confirmacion = "Las contraseñas si coinciden";
    //     var negacion = "No coinciden las contraseñas";
    //     var vacio = "La contraseña no puede estar vacía";
    //     //oculto por defecto el elemento span
    //     var span = $('<span></span>').insertAfter(pass2);
    //     span.hide();
    //     //función que comprueba las dos contraseñas
    //     function coincidePassword() {
    //         var valor1 = pass1.val();
    //         var valor2 = pass2.val();
    //         //muestro el span
    //         span.show().removeClass();
    //         //condiciones dentro de la función
    //         if (valor1 != valor2) {
    //             span.text(negacion).addClass('negacion');
    //             $('#btnusuario').attr("disabled", true);
    //         }
    //         if (valor1.length == 0 || valor1 == "") {
    //             span.text(vacio).addClass('negacion');
    //             $('#btnusuario').attr("disabled", true);
    //         }
    //         if (valor1.length != 0 && valor1 == valor2) {
    //             span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
    //             $('#btnusuario').attr("disabled", false);
    //         }
    //     }
    //     //ejecuto la función al soltar la tecla
    //     pass2.keyup(function() {
    //         coincidePassword();
    //     });
    // });
    // // tab
    // $('#nav-tab a:first').tab('show');

    // //for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
    // $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    //     //save the latest tab; use cookies if you like 'em better:
    //     localStorage.setItem('selectedTab', $(e.target).attr('id'));
    // });

    // //go to the latest tab, if it exists:
    // var selectedTab = localStorage.getItem('selectedTab');
    // if (selectedTab) {
    //     $('#' + selectedTab).tab('show');
    // }

    // var xhr;
    // var xhr2;
    // var xhr3;
    // var select_state, $select_state;
    // var select_city, $select_city;
    // var select_municipality, $select_municipality;
    // var select_parish, $select_parish;

    // $select_state = $('#idState').selectize({
    //     loadingClass: 'loading',
    //     onChange: function(value) {
    //         if (!value.length) return;
    //         /*listar ciudades*/
    //         select_city.disable();
    //         select_city.clearOptions();
    //         select_city.load(function(callback) {
    //             xhr && xhr.abort();
    //             xhr = $.ajax({
    //                 url: '../combo/' + value + '/city',
    //                 success: function(results) {
    //                     select_city.enable();
    //                     callback(results);
    //                 },
    //                 error: function() {
    //                     callback();
    //                 }
    //             })
    //         });
    //         /*listar municipios*/
    //         select_municipality.disable();
    //         select_municipality.clearOptions();
    //         select_municipality.load(function(callback) {
    //             xhr2 && xhr2.abort();
    //             xhr2 = $.ajax({
    //                 url: '../combo/' + value + '/municipality',
    //                 success: function(results) {
    //                     select_municipality.enable();
    //                     callback(results);
    //                 },
    //                 error: function() {
    //                     callback();
    //                 }
    //             })
    //         });
    //     }
    // });

    // $select_city = $('#idCity').selectize({
    //     labelField: 'name',
    //     valueField: 'id',
    //     searchField: ['name'],
    //     loadingClass: 'loading',
    // });

    // $select_municipality = $('#idMunicipality').selectize({
    //     labelField: 'name',
    //     valueField: 'id',
    //     searchField: ['name'],
    //     loadingClass: 'loading',
    //     preload: true,

    //     onChange: function(value) {
    //         if (!value.length) return;
    //         /*listar parroquias*/
    //         select_parish.disable();
    //         select_parish.clearOptions();
    //         select_parish.load(function(callback) {
    //             xhr3 && xhr3.abort();
    //             xhr3 = $.ajax({
    //                 url: '../combo/' + value + '/parish',
    //                 success: function(results) {
    //                     select_parish.enable();
    //                     callback(results);
    //                 },
    //                 error: function() {
    //                     callback();
    //                 }
    //             })
    //         });
    //     }
    // });

    // $select_parish = $('#idParish').selectize({
    //     labelField: 'name',
    //     valueField: 'id',
    //     searchField: ['name'],
    //     loadingClass: 'loading'
    // });

    // select_city = $select_city[0].selectize;
    // select_parish = $select_parish[0].selectize;
    // select_municipality = $select_municipality[0].selectize;
    // select_state = $select_state[0].selectize;

    // select_city.disable();
    // select_municipality.disable();
    // select_parish.disable();
</script>
