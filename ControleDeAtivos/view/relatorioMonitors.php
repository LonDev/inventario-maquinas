
<script src="js/angular.min.js?<?php echo VERSION;?>"></script>
<script src="js/relatorioMon.js?<?php echo VERSION;?>"></script>

<div class="container-fluid" ng-app="relatorioMon" ng-controller="relatorioOPController">
<center><h1 class="aba-titulo">Relatórios de Monitores</h1></center>
<hr>

<div class="col-sm-12">
	<div class="col-sm-3 left-space">
		<select id="FILTRO" name="FILTRO" class="form-control">
			<option value="0">Selecionar...</option>
			<option ng-repeat="local in lista_local" value="{{ local.cod }}">{{ local.local }}</option>
		</select> 
	</div>
	<div class="col-sm-3 left-space">
		<!--input id="TODOS" type="checkbox" checked name="TODOS" value="TODOS">TODOS -->
		<button id="Btn_Go" class="btn btn-primary">Buscar</button>
		<button id="Export" class="btn btn-success">Exportar</button>
	</div>
</div>
<div class="col-sm-12">
	<!--div class="col-sm-3 left-space" id="search-filtro2" style="display:none;">
		<select id="SUBFILTRO" name="SUBFILTRO" class="form-control">
			<option value="0">Selecionar...</option>
			<option ng-repeat="sublocal in lista_sublocal" value="{{ sublocal.cod }}">{{ sublocal.local }}</option>
		</select> 
	</div-->
	<div class="col-sm-3 left-space" id="info" ng-show="cadastros.length != null">
		{{"Resultado: "+ cadastros.length +" Monitores encontrados."}}
	</div>
</div>

<div class="col-md-12 DVfiltros" ng-show="cadastros.length > 0">
	<span class="pesquisaLista">
		Mostrando: {{ (cadastros|filter:tipoFiltro).length }} <input type="text" name="busca" ng-model="tipoFiltro" placeholder="FILTRO" />
	</span>
</div>

<br>
<div id="conteudo-tabela">
      
  <table id="jsondata" class="table table-responsive table-hover">
      <thead>
        <tr class="texto-tr">
        	<th>#</th>
			<th><a href="" ng-click="classPor('LOCALIZACAO')">LOCALIZAÇÃO</a></th>
			<!--th><a href="" ng-click="classPor('LOCALIZACAO')">SUBLOCALIZAÇÃO</a></th-->
	        <th><a href="" ng-click="classPor('MARCA')">MARCA</a></th>
	        <th><a href="" ng-click="classPor('MODELO')">MODELO</a></th>
	        <th><a href="" ng-click="classPor('SERIAL')">SERIAL</a></th>
			<th><a href="" ng-click="classPor('ATIVO')">ATIVO</a></th>
        </tr>
      </thead>
      <tbody>
        <tr  ng-repeat="cadastro in cadastros | filter:tipoFiltro | orderBy:criterioDeOrdem:sentidoOrdem">
	        <td>{{$index + 1 }}</td>
			<td>{{cadastro.local}}</td>
			<td>{{cadastro.marca}}</td>
			<td>{{cadastro.modelo}}</td>
			<td>{{cadastro.serial}}</td>
			<td>{{cadastro.ativo}}</td>
		</tr> 	
	</tbody>
  </table>
  </div>
  <div id="carregando" class="dcarregando">
  	<center>
  		<img width="100" height="100" src="/img/carregando.gif" />
  </div>                
</body> 
</html>