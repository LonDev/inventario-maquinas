$(document).ready(function(){
$('#ConsultaAtivo').submit(function(){
    $('input[type=text]').val (function () {
    return this.value.toUpperCase();
});

var consulta = $("#FILTRO").val();
var _valor = $("#VALOR").val();
//var dados = jQuery( this ).serialize();
 
 $.post("controller/MovimentacaoController.php",{"filtro":consulta,"valor":_valor}, function(result){
    if(result ==""){
    	alert("Máquina não cadastrada");
    }
    $("#lista-equipamento").html(result);
 });
 
 return false;
    });
	
});
