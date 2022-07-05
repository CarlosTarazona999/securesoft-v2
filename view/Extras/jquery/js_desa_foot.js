var fecha_fin = new Date('2019-07-16 19:30');
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;
    var element = 'tk_6';

jQuery(".selATMTimer").select2({
	placeholder:'Buscar',
	selectOnClose:true,
        ajax:{
        url: '/ATM/Vista/show/php/selectATM.php',
        dataType: 'json',
        processResults: function(data) {
return{
results:data
};
            
       },
cache:true
    }
});

jQuery(document).ready(function(){
      jQuery(".selATMTimer").on("change", function (e) { 
        var cadena = jQuery(".selATMTimer option:selected").val();

        jQuery.ajax({
        type: 'GET',
        url: '/ATM/Vista/show/search.php?q='+cadena,
        data: 'q=' + cadena,
        dataType: 'json',
        success: function(data) {
            for (var i=0;i< data.atm.length;i++) {
                jQuery("#uuid").val(data.atm[i].UUID);
                jQuery("#fabricante").val(data.atm[i].MANUFACTURER);
            };            
       }  
    });
  
    });
});


jQuery("#chkMasivo").on('change', function() {

if(jQuery("#chkMasivo").is(':checked')) {  
            document.getElementById('txaMasivo').required ="true";
	jQuery("#txaMasivo").prop("disabled",false); 
	jQuery("#fabricante").prop("value","");
	jQuery(".selATMTimer").val(null).trigger('change');
        } else {  
            document.getElementById('txaMasivo').required ="false";
 	jQuery("#txaMasivo").prop("disabled",true);
        }  
});



jQuery('input[type=radio][name=opcion_state]').on('change', function() {

    if(this.value==1 || this.value==4){
        document.getElementById('divSubaccion').style.display ="block";
document.getElementById('divMasivo').style.display ="block";
        document.getElementById('divbuttons').style.marginLeft ="auto";
        document.getElementById('divMotivo').style.display ="none";
        document.getElementById('accion_cierre').required ="false";
    }
    else{
        if(this.value==100){
            document.getElementById('divSubaccion').style.display ="none";
document.getElementById('divMasivo').style.display ="none";
            document.getElementById('divMotivo').style.display ="block";
            document.getElementById('divbuttons').style.marginLeft ="auto";
            document.getElementById('accion_cierre').required ="true";
        }else{
            document.getElementById('divSubaccion').style.display ="none";
document.getElementById('divMasivo').style.display ="none";
            //document.getElementById('divbuttons').style.marginLeft ="538px";
            document.getElementById('divMotivo').style.display ="none";
            document.getElementById('accion_cierre').required ="false";
        }
        
    }
    
});

jQuery('input[type=radio][name=opcion_timer]').on('change', function() {
    //jQuery('input[type=number][name=setTimer]').val(null);
});

jQuery('input[type=number][name=setTimer]').on('keypress', function() {
  //  jQuery('input[type=radio][name=opcion_timer]').prop( "checked", false );
});




jQuery('input[type=button][name=btnState]').on('click', function() {
    if(jQuery('input[name=opcion_checker]:checked').val()==4){
        var op_text="no definido";
        switch (jQuery('input[name=opcion_state]:checked').val()){
            case "0": op_text="Activar";break;
            case "1": op_text="Desactivar";break;
            case "4": op_text="Pasar a modo operador";break;
            case "98": op_text="Reiniciar";break;
            case "99": op_text="Elimnar";break;
            case "100": op_text="Cerrar el ticket para";break;
            default: op_text="default";break;
        }

        Swal.fire({
        title: 'Confirmar Operación',
        text: "Esta seguro de "+op_text+" el ATM "+ jQuery("#atm_id option:selected").text()+" con ticket "+document.getElementById('ticket_ca').value+"?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, lo confirmo!',
        cancelButtonText: 'No, deshacer!',
showLoaderOnConfirm:true,
        }).then((result) => {
        if (result.value) {
            jQuery.ajax({
                type: "POST",
                url: '/ATM/Vista/show/php/save-desactivaciones.php',
                data: {atm_id: document.getElementById('atm_id').value, ticket_ca: document.getElementById('ticket_ca').value,
                opcion_checker:jQuery('input[name=opcion_checker]:checked').val(),uuid:document.getElementById('uuid').value,
                opcion_state:jQuery('input[name=opcion_state]:checked').val(),
                txaMasivo:jQuery('#txaMasivo').val(),
                opcion_timer:jQuery('select#opcion_timer option:checked').val(),
                accion_cierre:document.getElementById('accion_cierre').value},    
                success: function(data){
                    if(data=="true"){
                        let timerInterval 
                        Swal.fire({ title: 'Operacion exitosa!',type: 'success', html: '', 
                        timer: 3000,onClose: () => {  clearInterval(timerInterval)  }});
                        setTimeout(function(){window.location="index.php";}, 1000);
                    }
                    else{
                        Swal.fire('ADVERTENCIA!',data,'warning');
                    }
                }
            });
        }
        });
    }    
    
    
});        


// Set up the Select2 control

    $(document).ready(function(){

        $(".atm_row").click(function(){
            var valores="";
            var a_row = new Array();
            $(this).find("td").each(function(){
                valores=$(this).html();
                a_row.push(valores);
                
            });

        jQuery("#ticket_ca").val(a_row[5]);
	jQuery("#chkMasivo").prop("checked",false);
	jQuery("#txaMasivo").prop("disabled",true);
jQuery("#txaMasivo").prop("value",null);

// Fetch the preselected item, and add to the control
var studentSelect = $('.selATMTimer');
$.ajax({
    type: 'GET',
    url: '/ATM/Vista/show/php/selectATMtwo.php?q='+a_row[2]
}).then(function (data) {
    // create the option and append to Select2
    var option = new Option(data[0]['text'], data[0]['id'], true, true);
    studentSelect.append(option).trigger('change');

    studentSelect.trigger({
        type: 'select2:select',
        params: {
            data: data
        }
    });
});


 });
});

  function actualizar(){
      location.reload(true);
      };

/*Mostrar datos del ATM en formulario de desactivaciones*/
jQuery(document).ready(function(){
      jQuery(".selATMTimer").on("change", function (e) { 
        var cadena = jQuery(".selATMTimer option:selected").text();
    
        jQuery.ajax({
        type: 'GET',
        url: '/ATM/Vista/show/php/get_atm_dataAPI_v6.php?q='+cadena,
        data: 'q=' + cadena,
        success: function(data) {
                jQuery("#resultado").html(data);          
       }  
    });
  
    });
});
/*Mostrar datos del ATM en formulario de desactivaciones*/

