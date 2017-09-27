
<script src="js/angular.min.js?<?php echo VERSION;?>"></script>
<script src="js/relatorioCPU.js?<?php echo VERSION;?>"></script>

<div class="container-fluid" ng-app="relatorioOP" ng-controller="relatorioOPController">
<center><h1 class="aba-titulo">Relatórios de máquinas disponiveis</h1></center>
<hr>

<div class="col-sm-12">
	<div class="col-sm-3 left-space">
		<select id="FILTRO" name="FILTRO" class="form-control">
			<option value="25">MGC - TI</option>
		</select> 
	</div>
	<div class="col-sm-3 left-space">
		<!--input id="TODOS" type="checkbox" checked name="TODOS" value="TODOS">TODOS -->	
		<button id="Btn_Go" class="btn btn-primary">Buscar</button>
		<button id="Export" class="btn btn-success">Exportar</button>
	</div>
</div>
<div class="col-sm-12">
	<div class="col-sm-3 left-space">
		<select id="SUBFILTRO" name="SUBFILTRO" class="form-control">
			<option value="29">MGC - DISPONIVEL</option>
		</select> 
	</div>
	<div class="col-sm-3 left-space" id="info" ng-show="cadastros.length != null">
		{{"Resultado: "+ cadastros.length +" Máquinas encontradas."}}
	</div>
</div>

<div class="col-md-12 DVfiltros" ng-show="cadastros.length > 0">
	<!--button id="dominio" class="btn btn-sm btn-primary" ng-click="filtrarPorDominio(cadastros)">No Domínio</button>
	<button id="sdominio" class="btn btn-sm btn-primary" ng-click="filtrarSemDominio(cadastros)">Sem dominio</button>
	<button id="office" class="btn btn-sm btn-primary" ng-click="filtrarComOffice(cadastros)">Com Office</button>
	<button id="soffice" class="btn btn-sm btn-primary" ng-click="filtrarSemOffice(cadastros)">Sem Office</button>
	<button id="all" class="btn btn-sm btn-primary" ng-click="filtrarLimpar()">Todos</button-->
	
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
		    <th><a href="" ng-click="classPor('localizacao')">LOCALIZACAO</a></th>
	        <th><a href="" ng-click="classPor('marca')">MARCA</a></th>
	        <th><a href="" ng-click="classPor('modelo')">MODELO</a></th>
	        <th><a href="" ng-click="classPor('ativo')">ATIVO</a></th>
			<th><a href="" ng-click="classPor('serial')">SERIAL</a></th>
			<th><a href="" ng-click="classPor('cpu')">PROCESSADOR</a></th>
			<th><a href="" ng-click="classPor('hd')">HD(GB)</a></th>
			<th><a href="" ng-click="classPor('mem_ram')">MEMORIA(GB)</a></th>
			<th><a href="" ng-click="classPor('ultimo_contato')">ULTIMO CONTATO</a></th>
        </tr>
      </thead>
      <tbody>
        <tr  ng-repeat="cadastro in cadastros | filter:tipoFiltro | orderBy:criterioDeOrdem:sentidoOrdem" ng-class="{alerta: validaDominio(cadastro)}">
	        <td>{{$index + 1 }}</td>
			<td>{{cadastro.localizacao}}</td>
			<td>{{cadastro.marca}}</td>
			<td>{{cadastro.modelo}}</td>
			<td>{{cadastro.ativo}}</td>
			<td>{{cadastro.serial}}</td>
			<td>{{cadastro.cpu}}</td>
			<td>{{ convertMB(cadastro.hd) }}</td>
			<td>{{ convertMB(cadastro.mem_ram) }}</td>
			<td>{{cadastro.ultimo_contato}}</td>
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