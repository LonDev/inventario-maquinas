<div class="container">
        
        <form class="form-horizontal" id="cadTipo" method="POST">
<fieldset>

<!-- Form Name -->
<center><legend>CADASTRO DE MODELO</legend></center>

<!-- MARCA -->
<div class="form-group">
  <label class="col-md-4 control-label" for="MARCA">MARCA</label>
  <div class="col-md-4">
    <select id="MARCA" name="MARCA" class="form-control">
    </select>
  </div>
</div>

<!-- TIPO DO EQUIPAMENTO -->
<div class="form-group">
  <label class="col-md-4 control-label" for="TIPO">MODELO</label>  
  <div class="col-md-4">
  <input id="TIPO" name="TIPO" placeholder="Ex: CPU - Optiplex3010" class="form-control input-md" required="" style="text-transform:uppercase" type="text">
  <div id="info"></div>
    
  </div>
</div>


<!-- CADASTRAR -->
<div class="form-group">
  <label class="col-md-4 control-label" for="CADASTRAR"></label>
  <div class="col-md-4" align="right">
    <button id="CADASTRAR" name="CADASTRAR" class="btn btn-success">CADASTRAR</button>
  </div>
</div>


</fieldset>
</form>
        
         </div>
  <div class="container-fluid">
      <br>
  <table class="table table-striped">
      <thead>
        <tr>
          <th width="50px">MARCA</th>
          <th>MODELO</th>
        </tr>
      </thead>
      <tbody id="lista-marcas">
      </tbody>
    </table>
  </div>
 <script src="js/cadTipo.js"></script>
</body>
</html>