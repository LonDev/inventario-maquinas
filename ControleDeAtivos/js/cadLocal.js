$(document).ready(function(){
    $('#lista-destino').load('controller/LocalController.php'); 

$('#cadLocal').submit(function(){
     $('input[type=text]').val(function () {
    return this.value.toUpperCase();
});
var dados = jQuery( this ).serialize();


$.ajax({
	type: "POST",
	url: "controller/LocalController.php",
	data: dados,
	success: function( data ){
    alert( "Destino Cadastrado com Sucesso !!" );
    $("#DESTINO").val(''); 
    location.reload();
        },
	error: function( data ){
    $("#info").html('* Local já cadastrado !');
    }       
    
    });
    
return false;
    });
});
