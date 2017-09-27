
<script src="js/angular.min.js?<?php echo VERSION;?>"></script>
<script src="js/relatorioOp.js?<?php echo VERSION;?>"></script>

<div class="container-fluid" ng-app="relatorioOP" ng-controller="relatorioOPController">
<center><h1 class="aba-titulo">Relatórios de Máquinas</h1></center>
<hr>

<div class="col-sm-12">
	<div class="col-sm-3 left-space">
		<select id="FILTRO" name="FILTRO" class="form-control">
			<option value="0">Selecionar...</option>
			<option ng-repeat="local in lista_local" value="{{ local.cod }}">{{ local.local }}</option>
		</select> 
	</div>
	<div class="col-sm-3 left-space">
		<input id="TODOS" type="checkbox" checked name="TODOS" value="TODOS">TODOS 	
		<button id="Btn_Go" class="btn btn-primary">Buscar</button>
		<button id="Export" class="btn btn-success">Exportar</button>
	</div>
</div>
<div class="col-sm-12">
	<div class="col-sm-3 left-space" id="search-filtro2" style="display:none;">
		<select id="SUBFILTRO" name="SUBFILTRO" class="form-control">
			<option value="0">Selecionar...</option>
			<option ng-repeat="sublocal in lista_sublocal" value="{{ sublocal.cod }}">{{ sublocal.local }}</option>
		</select> 
	</div>
	<div class="col-sm-3 left-space" id="info" ng-show="cadastros.length != null">
		{{"Resultado: "+ cadastros.length +" Máquinas encontradas."}}
	</div>
</div>

<div class="col-md-12 DVfiltros" ng-show="cadastros.length > 0">
	<button id="dominio" class="btn btn-sm btn-primary" ng-click="filtrarPorDominio(cadastros)">No Domínio</button>
	<button id="sdominio" class="btn btn-sm btn-primary" ng-click="filtrarSemDominio(cadastros)">Sem dominio</button>
	<button id="office" class="btn btn-sm btn-primary" ng-click="filtrarComOffice(cadastros)">Com Office</button>
	<button id="soffice" class="btn btn-sm btn-primary" ng-click="filtrarSemOffice(cadastros)">Sem Office</button>
	<button id="all" class="btn btn-sm btn-primary" ng-click="filtrarLimpar()">Todos</button>
	
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
			<th><a href="" ng-click="classPor('USUARIO')"> USUARIO</a></th>
	        <th><a href="" ng-click="classPor('LOCALIZACAO')">LOCALIZACAO</a></th>
	        <th><a href="" ng-click="classPor('MARCA')">MARCA</a></th>
	        <th><a href="" ng-click="classPor('MODELO')">MODELO</a></th>
	        <th><a href="" ng-click="classPor('HOSTNAME')">HOSTNAME</a></th>
	        <th><a href="" ng-click="classPor('ATIVO')">ATIVO</a></th>
			<th><a href="" ng-click="classPor('SERIAL')">SERIAL</a></th>
			<th><a href="" ng-click="classPor('IP')">IP</a></th>
			<th><a href="" ng-click="classPor('RAMAL')">RAMAL</a></th>
			<th><a href="" ng-click="classPor('OFFICE')">OFFICE</a></th>
			<th><a href="" ng-click="classPor('ULTIMOCONTATO')">ULTIMO CONTATO</a></th>
			<th><a href="" ng-click="classPor('DOMINIO')">DOMINIO</a></th>
			<th><a href="" ng-click="classPor('OPERACIONAL')">OPERACIONAL</a></th>
        </tr>
      </thead>
      <tbody>
        <tr  ng-repeat="cadastro in cadastros | filter:tipoFiltro | orderBy:criterioDeOrdem:sentidoOrdem" ng-class="{alerta: validaDominio(cadastro)}">
	        <td>{{$index + 1 }}</td>
			<td>{{cadastro.USUARIO}}</td>
			<td>{{cadastro.LOCALIZACAO}}</td>
			<td>{{cadastro.MARCA}}</td>
			<td>{{cadastro.MODELO}}</td>
			<td>{{cadastro.HOSTNAME}}</td>
			<td>{{cadastro.ATIVO}}</td>
			<td>{{cadastro.SERIAL}}</td>
			<td>{{cadastro.IP}}</td>
			<td>{{cadastro.RAMAL}}</td>
			<td>{{cadastro.OFFICE}}</td>
			<td>{{cadastro.ULTIMOCONTATO}}</td>
			<td>{{cadastro.DOMINIO}}</td>
			<td>{{cadastro.OPERACIONAL}}</td>
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