<?php 

$demais = array();

$banco2 = mysqli_connect('10.221.240.235', 'chafy', 'abc123abc','ocsweb');
$banco3 = mysqli_connect('10.221.18.88', 'guichafy', 'a1b2c3','ocsweb');

$sql1 = "select ac.tag as SITE,h.NAME as NOME,s.name as Office, h.ipaddr as IP, r.regvalue as Ramal
from hardware as h,softwares as s,bios as b, accountinfo as ac, registry as r
	WHERE
	r.hardware_id = h.id and
	s.hardware_id=h.id and 
	h.id=b.hardware_id and  
	ac.TAG like 'MGC'     and  
	ac.HARDWARE_ID = h.ID and
	s.name  like 'Microsoft Office%' and 
	s.language = 'Neutro' order by IP";
	
$dados = mysqli_query($banco2,$sql1); //bpo
$dados2 = mysqli_query($banco3,$sql1); //corp
$i = 0;
$retorno = array();
while ($data = mysqli_fetch_array($dados)) //bpo
{
 	$relatorio['nome'] = $data['NOME'];
	$relatorio['ip'] = $data['IP'];
	$relatorio['site'] = $data['SITE'];
	$relatorio['office'] = $data['Office'];
	$relatorio['ramal'] = $data['Ramal'];

	$retorno[$i] = $relatorio;
	$i++;
}
$relatorio = array();
while ($data2 = mysqli_fetch_array($dados2))//corp
{
 	$relatorio['nome'] = $data2['NOME'];
	$relatorio['ip'] = $data2['IP'];
	$relatorio['site'] = $data2['SITE'];
	$relatorio['office'] = $data2['Office'];
	$relatorio['ramal'] = $data['Ramal'];

	$retorno[$i] = $relatorio;
	$i++;
}

echo json_encode($retorno);

?>