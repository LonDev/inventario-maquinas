<head>
	<link id="bsdp-css" href="/css/datepicker3.css" rel="stylesheet">	
</head>
<form class="form-horizontal" id="cadMovimentacao"  method="POST" ng-app="ControleAtivo" ng-controller="movimentacao">
<fieldset>

<!-- NOME -->
<center><legend>MOVIMENTAÇÃO DE EQUIPAMENTO</legend></center>


<!-- ATIVO -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ATIVO">ATIVO</label>  
  <div class="col-md-4">
  <!--textarea rows="5" class="form-control" id="ATIVO" name="ATIVO" placeholder="Ex: A105947,A123456,A789123" required></textarea-->
  <input id="ATIVO" name="ATIVO" placeholder="Ex: A105947 A123456 A789123" class="form-control input-md" required="" type="text">
  <span class="help-block">Digite a Identificação do Equipamento</span>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="DESTINO">DESTINO</label>
  <div class="col-md-4">
    <select id="DESTINO" name="DESTINO" class="form-control">
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



<div class="form-group">
  <label class="col-md-4 control-label" for="DATA">DATA</label>  
  <div class="col-md-4">
  <input id="DATA" name="DATA" type="text" placeholder="Ex: 12/09/2014" class="form-control input-md"  required="">
  </div>
</div>

<!-- MOTIVO -->
<div class="form-group">
  <label class="col-md-4 control-label" for="MOTIVO">MOTIVO</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="MOTIVO" name="MOTIVO"></textarea>
  </div>
</div>
 

<!-- CONCLUIR -->
<div class="form-group">
  <label class="col-md-4 control-label" for="MOVIMENTAR"></label>
  <div class="col-md-4" align="right">
    <button id="MOVIMENTAR" name="MOVIMENTAR" class="btn btn-success">MOVIMENTAR</button>
  </div>
</div>


 </fieldset>
  </form>
</div>

<script src='/js/angular.min.js?<?php echo VERSION;?>'></script>
<script src='/js/jquery-ui.js?<?php echo VERSION;?>'></script>
<script src="/js/bootstrap-datepicker.js?<?php echo VERSION;?>"></script>
<script src="/js/bootstrap-datepicker.pt-BR.js?<?php echo VERSION;?>"></script>
<script src="js/cadMovimentacao.js?<?php echo VERSION;?>"></script>
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

</body>
</html>