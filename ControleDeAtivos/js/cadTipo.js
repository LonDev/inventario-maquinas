$(document).ready(function(){
    $('#lista-marcas').load('controller/TipoController.php'); 
    $('#MARCA').load('/view/Listas/listarMarcas.php');
$('#cadTipo').submit(function(){
    $('input[type=text]').val (function () {
    return this.value.toUpperCase();
});
var dados = jQuery( this ).serialize();
 
 $.ajax({
type: "POST",
url: "controller/TipoController.php",
data: dados,
success: function( data ){
    alert( "Tipo Cadastrado com Sucesso !!" );
    location.reload();
        },
error: function( data ){
    $("#info").html('* Tipo já cadastrado !');
    }    
       
    });
    
return false;
    });
});
