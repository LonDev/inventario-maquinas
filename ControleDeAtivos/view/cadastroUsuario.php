 <form class="form-horizontal" id="cadLocal"  method="POST">

<!-- NOME -->
<center><legend>Cadastro de Destino</legend></center>

<!-- MARCA -->
<div class="form-group">
  <label class="col-md-4 control-label">USUÁRIO</label>  
  <div class="col-md-4">
  <input id="USUARIO" name="USUARIO" placeholder="Ex: odilon.silva" class="form-control input-md" required=""  type="text">
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

  </form>
      <br>
  <table class="table table-striped">
      <tr>
        <th>Usuário</th>
        <th>Acesso</th>
      </tr>
      <tr ng-repeat="usuario in listaUser">
        <td>{{usuario.nome}}</td>
        <td>{{usuario.acesso}}</td>
      </tr>
  </table>
<script src="js/cadUser.js"></script> 
</body>
</html>