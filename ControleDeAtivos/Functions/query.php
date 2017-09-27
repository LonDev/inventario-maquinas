<?php
include("conexao.php");


if (empty($_POST['valor'])) {
  
} ELSE {
    $filtro=$_POST['filtro'];
    $valor=$_POST['valor'];
    
    $query="select m.nome,
t.nome as equi,
e.ativo,
e.serial,
mo.data,
l.nome as local,
sl.nome as sublocal,
mo.motivo,
mo.usuario,
mo.status
 from 
marca as m,
tipo as t,
sublocal as sl,
equipamento as e,
movimentacao as mo,
local as l WHERE
m.cod = t.codmarca AND
e.cod_tipo = t.cod AND
mo.cod_equipamento = e.cod AND
mo.localizacao = l.cod AND sl.codlocal = l.cod AND sl.id = mo.sublocal AND e.$filtro = '$valor' order by mo.cod desc";
    
    $connect->set("sql",$query);
    $resultado=$connect->executar();
	
	if(mysql_num_rows($resultado)!=0) { // se tem algum registro no banco
   // faco algo aqui
    while ($dados = mysql_fetch_array($resultado)) {
                $marca = $dados['nome'];
                $tipo = $dados['equi'];
                $ativo = $dados['ativo'];
                $serial = $dados['serial'];
                $data = $dados['data'];
                $local=$dados['local'];
				$sublocal=$dados['sublocal'];
                $motivo = $dados['motivo'];
                $usuario = $dados['usuario'];
                $status = $dados['status'];
                echo "<tr>";
                echo "<td>";
                echo $marca;
                echo "</td>";
                
                
                echo "<td>";
                echo $tipo;
                echo "</td>";
                
                
                echo "<td>";
                echo $ativo;
                echo "</td>";
                
                
                echo "<td>";
                echo $serial;
                echo "</td>";
                
                
                echo "<td>";
                echo $data;
                echo "</td>";
                
                
                echo "<td>";
                echo $local;
                echo "</td>";
				
				echo "<td>";
                echo $sublocal;
                echo "</td>";
                
                
                echo "<td>";
                echo $motivo;
                echo "</td>";
                
                
                 echo "<td>";
                echo $usuario;
                echo "</td>";
                
                echo "<td>";
                if ($status == 1) { 
                    echo "<img src='/img/atual.png' width='25px' height='25px' alt='Posição Atual   ' />";
                } 
                echo "</td>";
                
                
                echo "</tr>";
                
    }
	
	} else { // se n tem registro no banco
  echo "<script>alert('Nenhum resultado encontrado !');</script>";
}
}
?>