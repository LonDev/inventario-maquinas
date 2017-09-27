<?php
 require_once("/../model/movimentacao.php");
 require_once("/../dao/MovimentacaoDAO.php");


switch (@$_REQUEST['acao'])
{
  case 'movimentar':
    movimentar();
    break;

  default:
    listar();
    break;
}

function listar()
{
  $movimentacao = new Movimentacao();
  $movimentacaoDao = new MovimentacaoDAO();
    	
   //instancia um movimentacao 
    	$listamovimentacao = $movimentacaoDao->buscaMovimentacao($_REQUEST['filtro'],$_REQUEST['valor']);
    
    if($listamovimentacao != null)
    {
      foreach($listamovimentacao as $movimentacao)
      {
      	echo"<tr>
          			<td>".$movimentacao->get('marca')."</td>
                <td>".$movimentacao->get('cod_tipo')."</td>
               	<td>".$movimentacao->get('ativo')."</td>
               	<td>".$movimentacao->get('serial')."</td>
               	<td>".$movimentacao->get('data')."</td>
                <td>".$movimentacao->get('localizacao')."</td>
                <td>".$movimentacao->get('sublocal')."</td>
                <td>".$movimentacao->get('motivo')."</td>
               	<td>".$movimentacao->get('usuario')."</td>		
            	</tr>";
      }        
     }
 }

function movimentar()
{
  session_start();
  $movimentacao = new Movimentacao();
  $movimentacaoDao = new MovimentacaoDAO();
  

  $movimentacao->set("ativo",$_POST['ATIVO']);
  $movimentacao->set("localizacao",$_POST['DESTINO']);
  $movimentacao->set("motivo",$_POST['MOTIVO']);
  $movimentacao->set("data",$_POST['DATA']);
  $movimentacao->set("usuario",$_SESSION['user']);
  $movimentacao->set("sublocal",$_POST['SUBLOCAL']);


  if($movimentacaoDao->cadastraMovimentacao($movimentacao))
  {
    echo "Movimentado com sucesso";
  }
  else
  {
    echo "Erro ao movimentar";
  }

}

?>
