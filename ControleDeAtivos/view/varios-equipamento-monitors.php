<?php require_once("/../Functions/conexao.php"); ?>
<script src='/js/angular.min.js?<?php echo VERSION;?>'></script>
<script src="js/cadEquipamento-monitors-varios.js?<?php echo VERSION;?>"></script>
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
	<center><legend>Cadastrar vários monitores</legend></center>

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

<!-- SUB-LOCAL ->
<div class="form-group">
  <label class="col-md-4 control-label" for="SUBLOCAL">SUBLOCAL</label>
  <div class="col-md-4">
    <select id="SUBLOCAL" name="SUBLOCAL" class="form-control">
        <option value="0">Selecionar...</option>
         <option ng-repeat="sublocal in lista_sublocal" value="{{ sublocal.cod }}">{{ sublocal.local }}</option>
    </select>
  </div>
</div-->

<!-- DATA-->
<div class="form-group">
  <label class="col-md-4 control-label" for="DATA">DATA</label>  
  <div class="col-md-4">
  <input id="DATA" name="DATA" type="text" placeholder="Ex: 12/09/2014" class="form-control input-md"  required="">
    
  </div>
</div>

<!-- DATA-->
<div class="form-group">
  <label class="col-md-4 control-label">ARQUIVO "modelo,ativo,serial" (.CSV)</label>  
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
		<div class="col-md-8">
			<span class="alert-info">Para o funcionamento da ferramento, SEMPRE seguir o Exemplo: 
			<img src="../img/ex_cvs.png">
			</span>
		</div>
	<br>
	<br>

<?php

function insere_monitors($dado)
{
	$pdo = conecta();
	$marca_cod 	=	$_REQUEST['MARCA'];
	$local_cod	=	$_REQUEST['LOCAL'];
	/*$sublocal_cod = $_REQUEST['SUBLOCAL'];*/
	$data 		=	$_REQUEST['DATA'];
	$motivo 	=	"Cadastro Inicial";
	$usuario 	=	$_SESSION['user'];
	$status		=	1;

	//ignora a linha de titulo da coluna
	if($dado[1] == "ATIVO" || $dado[1] == "Ativo" || $dado[1] == "ativo")
	{
		return true;
	}

	//compara o que ja esta cadastrado visando evitar que haja duplicidade de fornecedores
	$busca = $pdo->prepare("SELECT ativo FROM modelo_monitor WHERE ativo=?");
	$busca->bindValue(1,$dado[1]);
	$busca->execute();
	
	if($busca->rowCount() == 0)
	{

		$insere = $pdo->prepare("INSERT INTO modelo_monitor (nome,ativo,serial,cod_marca,cod_local) VALUES (?,?,?,?,?);
			SELECT LAST_INSERT_ID() INTO @ID;
			INSERT INTO movimentacao (cod_equipamento,data,motivo,localizacao,usuario,status) VALUES(@ID,?,?,?,?,?)");
		
		//colunas da tabela
		$insere->bindParam(1, $dado[0] );
		$insere->bindParam(2, $dado[1] );
		$insere->bindParam(3, $dado[2] );
		$insere->bindParam(4, $marca_cod );
		$insere->bindParam(5, $local_cod );
		$insere->bindParam(6, $data );
		$insere->bindParam(7, $motivo );
		$insere->bindParam(8, $local_cod );
		/*$insere->bindParam(9, $sublocal_cod );*/
		$insere->bindParam(9, $usuario );
		$insere->bindParam(10, $status );

		if(!$insere->execute())
		{
			echo("<span class='col-md-8 alert alert-danger'>Erro ao cadastrar</span><br>");
			die();
		}
	}
	else{
		echo("<span class='col-md-8 alert alert-warning'>$dado[1] já está cadastrado no sistema.</span><br>");
	}
}

//verifica se o campo não esta vazio
if(@$_FILES['arquivo']['name'] != "")
{
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'],'base-monitor.csv'))
	{
		$row = 0;
		//tenta abrir o arquivo
		if (($handle = fopen("base-monitor.csv", "r")) !== FALSE)
		{	
			//percorre a lista de itens 
			while(($dados = fgetcsv($handle, 5000, ";")) !== FALSE)
			{
				insere_monitors($dados);
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