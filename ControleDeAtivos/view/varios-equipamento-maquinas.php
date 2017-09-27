<?php require_once("/../Functions/conexao.php"); ?>

<script src='/js/angular.min.js?<?php echo VERSION;?>'></script>
<script src="js/cadEquipamento-maquinas-varios.js?<?php echo VERSION;?>"></script>
<script src='/js/jquery-ui.js?<?php echo VERSION;?>'></script>
<script src="/js/bootstrap-datepicker.js?<?php echo VERSION;?>"></script>
<script src="/js/bootstrap-datepicker.pt-BR.js?<?php echo VERSION;?>"></script>
<script> 
    $(function() {
 $('#DATA').datepicker({
    showOn: "button",
    format: "dd-mm-yyyy",
    language: "pt-BR",
    orientation: "top auto",
    keyboardNavigation: false,
    autoclose: true,
    todayHighlight: true,
    buttonImage: "img/calendario.png",
    buttonImageOnly: true,
    buttonText: "Select date"
    });
});
</script>

	<center><legend>Cadastrar várias Maquinas</legend></center>

<form class="form-horizontal" id="cadEquipamento" method="POST" enctype="multipart/form-data" ng-app="ControleAtivo" ng-controller="equipamento">
<fieldset>

<!-- MARCA -->
<div class="form-group">
  <label class="col-md-4 control-label" for="MARCA">MARCA</label>
  <div class="col-md-4">
    <select id="MARCA" name="MARCA" class="form-control">
        <option value="0">Selecionar...</option>
        <option ng-repeat="marcas in lista_marcas" value="{{ marcas.cod }}">{{ marcas.marca }}</option>
    </select>
  </div>
</div>

<!-- TIPO -->
<div class="form-group">
  <label class="col-md-4 control-label" for="MODELO">MODELO</label>
  <div class="col-md-4">
    <select id="TIPO" name="MODELO" class="form-control">
        <option value="0">Selecionar...</option>
        <option ng-repeat="modelo in lista_modelos" value="{{ modelo.cod }}">{{ modelo.nome }}</option>
    </select>
  </div>
</div>

<!-- LOCAL -->
<div class="form-group">
  <label class="col-md-4 control-label" for="LOCAL">LOCAL</label>
  <div class="col-md-4">
    <select id="LOCAL" name="LOCAL" class="form-control">
        <option value="0">Selecionar...</option>
         <option ng-repeat="local in lista_local" value="{{ local.cod }}">{{ local.local }}</option>
    </select>
  </div>
</div>

<!-- SUB-LOCAL -->
<div class="form-group">
  <label class="col-md-4 control-label" for="SUBLOCAL">SUBLOCAL</label>
  <div class="col-md-4">
    <select id="SUBLOCAL" name="SUBLOCAL" class="form-control">
        <option value="0">Selecionar...</option>
         <option ng-repeat="sublocal in lista_sublocal" value="{{ sublocal.cod }}">{{ sublocal.local }}</option>
    </select>
  </div>
</div>

<!-- DATA-->
<div class="form-group">
  <label class="col-md-4 control-label" for="DATA">DATA</label>  
  <div class="col-md-4">
  <input id="DATA" name="DATA" type="text" placeholder="Ex: 12/09/2014" class="form-control input-md"  required="">
    
  </div>
</div>

<!-- DATA-->
<div class="form-group">
  <label class="col-md-4 control-label">ARQUIVO (.CSV)</label>  
  <div class="col-md-4">
    <input type="file" name="arquivo" class="form-control">
  </div>
</div>

<!-- CADASTRO -->
<div class="form-group">
  <label class="col-md-4 control-label" for="CADASTRAR"></label>
  <div class="col-md-4" align="right">
    <button class="btn btn-success">CADASTRAR</button>
  </div>
</div>

</fieldset>
</form>
<hr>
	<div class="container">
<?php

function insere_maquinas($dado)
{
	$pdo = conecta();
	$marca_cod 	=	$_REQUEST['MARCA'];
	$modelo_cod =	$_REQUEST['MODELO'];
	$local_cod	=	$_REQUEST['LOCAL'];
	$sublocal_cod = $_REQUEST['SUBLOCAL'];
	$data 		=	$_REQUEST['DATA'];
	$motivo 	=	"Cadastro Inicial";
	$usuario 	=	$_SESSION['user'];
	$status		=	1;

	//ignora a linha de titulo da coluna
	if($dado[0] == "ATIVO" || $dado[0] == "Ativo" || $dado[0] == "ativo")
	{
		return true;
	}

	//compara o que ja esta cadastrado visando evitar que haja duplicidade de fornecedores
	$busca = $pdo->prepare("SELECT ativo FROM equipamento WHERE ativo=?");
	$busca->bindValue(1,$dado[0]);
	$busca->execute();
	
	if($busca->rowCount() == 0)
	{

		$insere = $pdo->prepare("INSERT INTO equipamento (cod_tipo,ativo,serial) VALUES (?,?,?);
			SELECT LAST_INSERT_ID() INTO @ID;
			INSERT INTO movimentacao (cod_equipamento,data,motivo,localizacao,sublocal,usuario,status) VALUES(@ID,?,?,?,?,?,?)");
		
		//colunas da tabela
		$insere->bindParam(1, $modelo_cod );
		$insere->bindParam(2, $dado[0] );
		$insere->bindParam(3, $dado[1] );
		$insere->bindParam(4, $data );
		$insere->bindParam(5, $motivo );
		$insere->bindParam(6, $local_cod );
		$insere->bindParam(7, $sublocal_cod );
		$insere->bindParam(8, $usuario );
		$insere->bindParam(9, $status );

		if(!$insere->execute())
		{
			echo("<span class='col-md-8 alert alert-danger'>Erro ao cadastrar</span><br>");
			die();
		}
	}
	else{
		echo("<span class='col-md-8 alert alert-warning'>$dado[0] já está cadastrado no sistema.</span><br>");
	}
}

//verifica se o campo não esta vazio
if(@$_FILES['arquivo']['name'] != "")
{
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'],'base-maquina.csv'))
	{
		$row = 0;
		//tenta abrir o arquivo
		if (($handle = fopen("base-maquina.csv", "r")) !== FALSE)
		{	
			//percorre a lista de itens 
			while(($dados = fgetcsv($handle, 5000, ";")) !== FALSE)
			{
				insere_maquinas($dados);
				//echo "$dados[0]<br>$dados[1]<br>$dados[2]";
				$row++;
			}
		}

		fclose($handle);
		echo ("<div class='col-md-8 alert alert-success'>$row registros foram inseridos.<br>
		Base atualizada com sucesso.</div>");
	}
	else
	{
		echo("<div class='col-md-8 alert alert-danger'>Erro ao salvar base de dados</div>");
	}
}
?>
</div>