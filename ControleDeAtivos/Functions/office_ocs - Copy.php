<?php
ini_set( 'display_errors', true );
error_reporting( E_ALL );

$banco1 = mysqli_connect('127.0.0.1', 'root', '','controleativo');
	
$banco2 = mysqli_connect('10.221.240.235', 'chafy', 'abc123abc','ocsweb');

$banco3 = mysqli_connect('10.221.18.88', 'guichafy', 'a1b2c3','ocsweb');


if (empty($_GET['filtro'])){
    
} else {

$filtro = $_GET['filtro'];
$valor = $_GET['valor'];
}

	 $sql="select 
l.nome as OPERACAO,
sl.nome as LOCALIZACAO,
m.nome as MARCA,
t.nome as MODELO,
e.ativo, 
e.serial 
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
mo.localizacao = l.cod AND sl.codlocal = l.cod AND sl.id = mo.sublocal $filtro $valor and mo.status = 1 order by  mo.cod desc;";

//and l.nome = 'MGC - HSBC'
$titulo = array("OPERACAO","LOCALIZACAO","MARCA","MODELO","SERIAL","ATIVO","OFFICE");
$i=0;
$hostname = array();
$operacao = array();
$localizacao = array();
$marca = array();
$modelo = array();
$serial = array();
$ativo = array();
$office = array();
$teste = array ();
$var = array();


	$resultado = mysqli_query($banco1,$sql);
	
    while ($dados = mysqli_fetch_array($resultado,MYSQL_BOTH)){
        $var[] = $dados;
	$ativo[$i] =  $dados['ativo'];
	$nome[0] = "PCT".$ativo[$i];
	$serial[$i] = $dados['serial'];		
	$hostname[0] = $serial[$i];
	$host = $hostname[0];
	$var[$i][6] = " - ";
	$var[$i][7] = " Não Localizado";
	$var[$i][8] = " Não Localizado";
	$var[$i][9] = " Não Localizado";
	$var[$i][10] = " Não Localizado";
	$var[$i][11] = " Não Localizado";
	$var[$i][12] = " Não Localizado";
	$var[$i][13] = " Não Localizado";

			
			/* INICIA OCS */
			

			
			$sql2 = "select s.name,h.ipaddr as SOFTWARE from hardware as h,softwares as s,bios as b WHERE
			 s.hardware_id=h.id and h.id=b.hardware_id and  b.ssn = '$host' and  s.name  like 'Microsoft Office%' and s.language = 'Neutro' and s.folder <> '' ";
			$Roffice = mysqli_query($banco2,$sql2);			
			while ($dados_office = mysqli_fetch_array($Roffice)){
			
                        $var[$i][6] = $dados_office[0]; //OFFICE
		}
		
		//Informações Basicas da Maquina
		$sql3 = "select h.ipaddr,h.userid,h.lastcome,h.name,h.workgroup  from hardware as h,bios as b WHERE h.id=b.hardware_id and  b.ssn = '$host' ";
			$info = mysqli_query($banco2,$sql3);			
			while ($dados_ocs = mysqli_fetch_array($info)){
			
                        $var[$i][7] = $dados_ocs[0]; //IP
						$var[$i][8] = $dados_ocs[1]; //USUARIO
						$var[$i][9] = $dados_ocs[2]; //CONTATO
						$var[$i][11] = $dados_ocs[3]; //HOSTNAME
						$var[$i][12] = $dados_ocs[4]; //DOMINIO
		}
		
		$sql4 = "select r.ramal from hardware as h , vw_Ramal as r,bios as b WHERE h.id=b.hardware_id and r.hardware_id = h.id and b.ssn = '$host' ";
			$info2 = mysqli_query($banco2,$sql4);			
			while ($dados_ocs2 = mysqli_fetch_array($info2)){
			
                        $var[$i][10] = $dados_ocs2[0]; //RAMAL
		}
		
		$sql5 = "select o.operacional from hardware as h , vw_Operacional as o,bios as b WHERE h.id = b.hardware_id and h.id=o.hardware_id and b.ssn = '$host'";
			$info3 = mysqli_query($banco2,$sql5);			
			while ($dados_ocs3 = mysqli_fetch_array($info3)){
			
                        $var[$i][13] = $dados_ocs3[0]; //OPERACIONAL
		}
		
		
	/* BASE MANUAL TIVIT.CORP */

	if ( $var[$i][12] == " Não Localizado" ) {
			//$sql5="select usuario,hostname,ip,ramal,office,contato,dominio from tivitcorp where hostname = '$nome[0]'";
			$sql5= "select h.ipaddr,h.userid,h.lastcome,h.name,h.workgroup  from hardware as h,bios as b WHERE h.id=b.hardware_id and  b.ssn = '$host' ";
			$info3 = mysqli_query($banco3,$sql5);			
			while ($dados_controle = mysqli_fetch_array($info3)){
			
                        $var[$i][7] = $dados_controle[0];
						$var[$i][8] = $dados_controle[1];
						$var[$i][9] = $dados_controle[2];
						$var[$i][11] = $dados_controle[3];
						$var[$i][12] = $dados_controle[4];
						//$var[$i][9] = $dados_controle[5];
						//$var[$i][12] = $dados_controle[6];
		};
		
		$sql6= "select s.name,h.ipaddr as SOFTWARE from hardware as h,softwares as s,bios as b WHERE
			 s.hardware_id=h.id and h.id=b.hardware_id and  b.ssn = '$host' and  s.name  like 'Microsoft Office%' and s.language = 'Neutro' and s.folder <> '' LIMIT 1 ";
			 $info4 = mysqli_query($banco3,$sql6);
				while ($dados_office_corp = mysqli_fetch_array($info4)){
					$var[$i][6] = $dados_office_corp[0]; //OFFICE
					
					};
			
			$sql7="select o.Operacao from hardware as h,bios as b,vw_Operacao as o where b.hardware_id=h.id and o.hardware_id=h.id and b.ssn='$host'";
			$info5 = mysqli_query($banco3,$sql7);
			while ($dados_ocs_corp2 = mysqli_fetch_array($info5)){
			$var[$i][13] = $dados_ocs_corp2[0];
			};
			
			};
			
			
			
			

	$i= $i+1;
	unset($hostname[0]);
	};
	
      echo '{"cadastros":'.json_encode($var).'}';





?>

 
