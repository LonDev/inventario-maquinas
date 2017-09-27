$(document).ready(function(){
    $('#lista-marcas').load('controller/MarcaController.php'); 
$('#cadMarca').submit(function(){
    $('input[type=text]').val (function () {
    return this.value.toUpperCase();
});
var dados = jQuery( this ).serialize();
 
$.ajax({
type: "POST",
url: "controller/MarcaController.php",
data: dados,
success: function( data ){
    alert( "Marca Cadastrada com Sucesso !!" );
    $("#MARCA").val(''); 
    location.reload();
        },
error: function( data ){
    $("#info").html('* Marca já cadastrada !');
    }
        
    });
    
return false;
    });
});
