 var app = angular.module("ControleAtivo",[]);

app.controller('movimentacao', function($scope, $http){

$http.get("view/Listas/listarLocais.php").then(function(response){
        $scope.lista_local = response.data;
}); 

$('#DESTINO').change(function(){
    local = $("#DESTINO").val();

  $http.get("view/Listas/listarSubLocal.php?LOCAL="+local).then(function(response){
        $scope.lista_sublocal = response.data;
    }); 
 
});
  

$('#cadMovimentacao').submit(function(){
    $('input[type=text]').val (function () {
    return this.value.toUpperCase();
    });
   
   //contador de máquinas no array com sucesso
    var totalDeMaquina = 0;

    //var separa = [];
    //array com os ativos
    var separa = $("#ATIVO").val().split(" ");

  for(i = 0; i < separa.length; i++)
    {
        $("#ATIVO").val("");
        $("#ATIVO").val(separa[i]);
       
        var ATIVO = $("#ATIVO").val();

        var dados = jQuery( this ).serialize();
                $.ajax({
                    type: "POST",
                    url: "controller/MovimentacaoController.php?acao=movimentar",
                    data:dados,
                    success: function( data ){
                      totalDeMaquina++;
                          if(totalDeMaquina == separa.length)
                          {
                            alert(totalDeMaquina+" Máquina(s) movimentada(s) com sucesso!");
                          }
                    },
                    error: function( data ){
                        alert(ATIVO+"\n"+data);
                        
                    }
                });
          
    }
    
   return false;
});

});