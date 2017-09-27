  <form class="form-horizontal" id="cadMarca"  method="POST">
<fieldset>

<!-- NOME -->
<center><legend>Cadastro de Marcas</legend></center>



<!-- MARCA -->
<div class="form-group">
  <label class="col-md-4 control-label" for="MARCA">MARCA</label>  
  <div class="col-md-4">
  <input id="MARCA" name="MARCA" placeholder="Ex: DELL" class="form-control input-md" required=""  style="text-transform:uppercase" type="text">
  <div id="info"></div>
  </div>
</div>

    
<!-- CONCLUIR -->
<div class="form-group">
  <label class="col-md-4 control-label" for="CADASTRAR"></label>
  <div class="col-md-4" align="right">
    <button id="CADASTRAR" name="CADASTRAR" class="btn btn-success">CADASTRAR</button>
  </div>
</div>



 </fieldset>
  </form>
      <br>
  <table class="table table-striped">
      <thead>
        <tr>
          <th>NOME</th>
        </tr>
      </thead>
      <tbody id="lista-marcas">
     </tbody>
    </table>
  </div>

<script src="js/cadMarca.js"></script>
  
</body>
</html>