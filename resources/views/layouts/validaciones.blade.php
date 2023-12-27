<script type="text/javascript">
	function SoloNumeros(numero){
        key1 = numero.keyCode || numero.which;
        numero = String.fromCharCode(key1);
        numeros = "1234567890.";
        especiales = "8-37-39-46";

        tecla_especial1 = false
        for(var i in especiales){
            if(key1 == especiales[i]){
                tecla_especial1 = true;
                break;
            }
        }
        console.log(numeros.indexOf());
        if(numeros.indexOf(numero)==-1 && !tecla_especial1 && key1 != '32'){
            return false;
        }
    }
    function soloLetras(letra){
        key = letra.keyCode || letra.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = "áéíóúabcdefghijklmnñopqrstuvwxyz(),/";
        especiales = "8-37-39-46";

        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        
        if(letras.indexOf(tecla)==-1 && !tecla_especial && key != '32'){
            return false;
        }
    }

    function letrasNumeros(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        alfa = "áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-.";
        especiales = "8-37-39-46-32";
          console.log(key);
        tecla_especial2 = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial2 = true;
                break;
                console.log(especiales[i])
            }
        }

        if(alfa.indexOf(tecla)==-1 && !tecla_especial2 && key != '32'){
            return false;
        }
    }
    function val_direccion(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        alfa = "áéíóúabcdefghijklmnñopqrstuvwxyz1234567890-,.";
        especiales = "8-37-39-46";
          console.log(key);
        tecla_especial2 = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial2 = true;
                break;
                console.log(especiales[i])
            }
        }

        if(alfa.indexOf(tecla)==-1 && !tecla_especial2 && key != '32'){
            return false;
        }
    }

    $(document).on('ajaxStart', function() {
        loading_show();
    })
     
    $(document).on('ajaxStop', function(start) {
        loading_hide();
    });
    
         function loading_show() {
            $('body').loadingModal({
                text: 'Por favor espere...',
                animation: 'circle',
            });
            $('body').loadingModal('show');
        }
    
    function loading_hide() {
        $('body').loadingModal('hide');
    } 


</script>
