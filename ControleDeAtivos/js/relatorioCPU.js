var relatorioApp = angular.module("relatorioOP",[]);

relatorioApp.controller("relatorioOPController",function($scope, $http){
	$scope.result = [];

	 $("#busca").val(function () {
    	return this.value.toLowerCase();
	});
	$("#carregando").hide();

	 $http.get("view/Listas/listarLocais.php").then(function(response){
        $scope.lista_local = response.data;
    }); 
   
	
	 $('#FILTRO').change(function(){
		 $http.get('view/Listas/listarSubLocal.php?LOCAL='+$('#FILTRO option:selected').val()).then(function(response){
            $scope.lista_sublocal = response.data;
         });

       });
	 
	 /*
	 $("#TODOS").change(function(){
		if($("#TODOS").is(':checked'))
			$("#search-filtro2").hide();  // checked
		else
			$("#search-filtro2").show();  // unchecked
	 });
	 */

	//botão buscar
	$("#Btn_Go").click(function(){
		
		//limpa a lista de dados e exibe a imagem de carregando
		$scope.cadastros = "";
		$("#carregando").show();
		
		valor = " ";
	   
	   if (valor == "Selecionar...") {
	        alert("Escolhe uma opção");
			exit;
	    };
		 
		 
		 
	    if ($("#TODOS").is(':checked')){
			
			//se for selecionado a opção todos
			if($("#FILTRO option:selected").text() == "MGC - TODOS")
			{
				valor1 = $("#FILTRO option:selected").val();
				filtro = "l.nome like'".concat(valor1)+"%'"+
				 " and l.nome != 'MGC - SITES'";

			}
			else
			{
				valor1 = $("#FILTRO option:selected").text();
				filtro = "l.nome ='".concat(valor1)+ "' ";    
			}    
			
		}
		else {
		valor1 = $("#FILTRO option:selected").val();
		valor2 = $("#SUBFILTRO option:selected").val();
		};
	
		//efetua a busca com os parametros passados
		$http.get("controller/office_ocs_cpu.php?LOCAL="+valor1+"&SUBLOCAL="+valor2)
		.then(function(response){

			//lista para a pagina
			$scope.cadastros = response.data;

			//lista para os filtros 
			$scope.lista = response.data;
			
			$("#carregando").hide();
		});
	});
	
	 //Botão Exportar
    $("#Export").click(function(){
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#conteudo-tabela').html()));
         e.preventDefault();
    });

    //faz o toggle no botao que foi clicado
	/*
	$("div.DVfiltros button").click(function(){
		$("DVfiltros button").addClass("btn-primary");
		$("DVfiltros button").removeClass("habilitado");
		$(this).toggleClass("btn-primary habilitado");
	});
	*/

	$scope.convertMB = function(num)
	{
		//convert MB para GB
		return (num / 1024).toFixed(2);
	}

	$scope.classPor = function(campo){
		$scope.criterioDeOrdem = campo;
		$scope.sentidoOrdem = !$scope.sentidoOrdem;
	}

	//--------------------------------------------Filtros-----------------------------------------------------------------------
	$scope.filtrarPor = function(tipo){
		$scope.tipoFiltro = tipo;
	}
	
	$scope.filtrarPorDominio = function(cadastro){
		$scope.cadastros = $scope.lista.filter(function(cadastro){
			
			if(cadastro.DOMINIO != " Não Localizado")
				{
					return cadastro;
				}			
		});
	}

	$scope.filtrarSemDominio = function(){
		//lista = $scope.cadastrosOriginal;
		$scope.cadastros = $scope.lista.filter(function(cadastro){
		
			if(cadastro.DOMINIO == " Não Localizado")
				{
					return cadastro;
				}
		});
	}

	$scope.filtrarSemOffice = function(){
		$scope.cadastros = $scope.lista.filter(function(cadastro){
		
			if(cadastro.OFFICE == " - ")
				{
					return cadastro;
				}
		});
	}

	$scope.filtrarComOffice = function(){
		$scope.cadastros = $scope.lista.filter(function(cadastro){
		
			if(cadastro.OFFICE != " - ")
				{
					return cadastro;
				}
		});
	}
	$scope.filtrarLimpar = function(){
		$scope.cadastros = $scope.lista;
	}

	$scope.validaDominio = function(cadastro){
		if($("#FILTRO option:selected").text() != "MGC - TI")
		{
			if(cadastro.DOMINIO == " Não Localizado")
			{
				return true;
			}
		return false;
		}
	}


});
