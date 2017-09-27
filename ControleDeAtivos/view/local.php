 <form class="form-horizontal" id="cadLocal"  method="POST">
<fieldset>

<!-- NOME -->
<center><legend>Cadastro de Destino</legend></center>



<!-- MARCA -->
<div class="form-group">
  <label class="col-md-4 control-label" for="DESTINO">DESTINO</label>  
  <div class="col-md-4">
  <input id="DESTINO" name="DESTINO" placeholder="Ex: MGC - DATACENTER" class="form-control input-md" required=""  type="text">
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
  <table class="table table-striped table-hover table-responsive table-condensed">
      <thead>
        <tr>
          <th>NOME</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="lista-destino">
      </tbody>
    </table>
  </div>

<script src="js/cadLocal.js"></script> 
</body>
</html>