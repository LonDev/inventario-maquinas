     var app = angular.module("ControleAtivo",[]);

    app.controller('equipamento', function($scope, $http){
      
    $http.get("view/Listas/listarMarcas.php?v=monitor").then(function(response){
        $scope.lista_marcas = response.data;
    });

    $http.get("view/Listas/listarLocais.php").then(function(response){
        $scope.lista_local = response.data;
    }); 
    
	$('#LOCAL').change(function(){
        $http.get('view/Listas/listarSubLocal.php?LOCAL='+$('#LOCAL option:selected').val()).then(function(response){
            $scope.lista_sublocal = response.data;
         }); 
        
    });
   
    $('#MARCA').change(function(){
         $http.get('view/Listas/listarTipos.php?MARCA='+$('#MARCA option:selected').val()).then(function(response){
            $scope.lista_modelos = response.data;
         }); 
     });

    $("button").click(function(){
        $("form").submit();
    });
    
});