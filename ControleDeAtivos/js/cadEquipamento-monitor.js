   var app = angular.module("ControleAtivo",[]);

    app.controller('equipamento', function($scope, $http){
	  
	$http.get("view/Listas/listarMarcas.php?v=monitor").then(function(response){
        $scope.lista_marcas = response.data;
    });

    $http.get("view/Listas/listarLocais.php").then(function(response){
        $scope.lista_local = response.data;
    });	
		
    $('#cadEquipamento').submit(function(){
        $('input[type=text]').val (function () {
            return this.value.toUpperCase();
        });
            var dados = jQuery( this ).serialize();
            jQuery.ajax({
                type: "POST",
                url: "controller/monitorController.php?v=cadastrar",
                data: dados,
                success: function( data ){
                    alert( data );
                    location.reload();
                    },
                error: function( data ){
                    alert( data );
                }
            });
return false;
    });
    
});