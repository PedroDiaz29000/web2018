$(document).ready(function(){
$( "#nombre" ).focus();

$('#boton').click(function(){
  $.ajax({
        type: "POST",
        url: "registro.php",
        data: $("#regitro").serialize(),
        success: function(data){          
        	alert(data);
			limpiar();
			$( "#nombre" ).focus();
           }
    });
	})
})

function limpiar(){
 $('input[type="text"]').val('');
 $('#comen').val('');
}