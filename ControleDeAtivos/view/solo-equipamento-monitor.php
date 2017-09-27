
<form class="form-horizontal" id="cadEquipamento" method="POST" ng-app="ControleAtivo" ng-controller="equipamento">
<fieldset>

<!-- FORM -->
<center><legend>Cadastro de Monitor</legend></center>

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
  <label class="col-md-4 control-label" for="TIPO">MODELO</label>
  <div class="col-md-4">
   <input type="text" name="MODELO" class="form-control">
  </div>
</div>

<!-- ATIVO-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ATIVO">ATIVO</label>  
  <div class="col-md-4">
  <input id="ATIVO" name="ATIVO" type="text" placeholder="Ex: A105947" class="form-control input-md" style="text-transform:uppercase" required="">
  </div>
</div>

<!-- SERIAL-->
<div class="form-group">
  <label class="col-md-4 control-label" for="SERIAL">SERIAL</label>  
  <div class="col-md-4">
  <input id="SERIAL" name="SERIAL" type="text" placeholder="Ex: 59BCLZ1" class="form-control input-md" style="text-transform:uppercase" required="">
    
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

<!-- CADASTRO -->
<div class="form-group">
  <label class="col-md-4 control-label" for="CADASTRAR"></label>
  <div class="col-md-4" align="right">
    <button id="CADASTRAR" name="CADASTRAR" class="btn btn-success">CADASTRAR</button>
  </div>
</div>

</fieldset>
</form>
<script src="js/angular.min.js"></script>
<script src="js/cadEquipamento-monitor.js"></script>

</body>
    
</html>

