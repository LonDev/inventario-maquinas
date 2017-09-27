$(document).ready(function(){

$('#login').submit(function(){
    $("#carregando").show();

    var dados = $( this ).serialize();

    setTimeout(func, 2000);
    function func() {
        $.ajax({
    	type: "POST",
    	url: "controller/UsuarioController.php",
    	data: dados,
    	success: function( data ){
            window.location = "/";
            $("#carregando").hide();
    	},
    	error: function( data ){
        alert("Usuario sem Acesso ao Sistema !\nContate um administrador do sistema.");
        $("#carregando").hide();
        }
    });
};

return false;
    });
        
});