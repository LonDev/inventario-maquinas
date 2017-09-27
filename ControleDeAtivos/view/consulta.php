<center><legend>Consulta de Movimentação</legend></center>
	<form class="form-group" id="ConsultaAtivo" method="POST">
		<div class="col-sm-12 left-space">
			<div class="col-sm-2">
				<input id="VALOR" name="VALOR"  type="text" class="form-control" required />
			</div>
			<div class="col-sm-2 input-group">
				<select id="FILTRO" name="FILTRO" class="form-control">
					<option value="ATIVO">ATIVO</option>
					<option value="SERIAL">SERIAL</option>
				</select>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary">Buscar</button>
					</span>
			</div>
			<div id="col-sm-12 info"></div>
		</div>
		</form>
      <br>
  <div class="container">
    <table class="table table-striped table-responsive">
        <thead>
          <tr>
            <th>MARCA</th>
            <th>TIPO</th>
            <th>ATIVO</th>
            <th>SERIAL</th>
            <th>DATA</th>
            <th>LOCAL</th>
  		      <th>SUBLOCAL</th>
            <th>MOTIVO</th>
            <th>USUARIO</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="lista-equipamento">
        </tbody>
      </table>
  </div>  
</div>
<script src="js/consulta.js"></script>    
</body>
</html>