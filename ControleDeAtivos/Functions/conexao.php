<?php
function conecta(){
	$host		= "localhost";
	$dbName 	= "controleativo";
	$user		= "root";
	$password	=""; 
	try{
		$pdo = new PDO("mysql:host=$host;dbname=$dbName",$user,$password);
		
	}catch(PDOException $e){
		echo "Erro ao conectar-se com o banco de dados <br>
		Erro: ".$e->getMessage();
	}
	return $pdo;
}

function insere($dado)
{
	$pdo = conecta();
	
	//cadastrar cpu, memoria ram, hd, no banco local
	$busca = $pdo->prepare("UPDATE equipamento SET cpu=:cpu, mem_ram=:ram, hd=:hd, ultimo_contato=:contato WHERE ativo=:ativo");
	
	$busca->bindValue(":cpu",$dado[2]);
	$busca->bindValue(":ram",$dado[1]);
	$busca->bindValue(":hd",$dado[3]);
	$busca->bindValue(":contato",$dado[4]);
	$busca->bindValue(":ativo",$dado[0]);

	if(!$busca->execute())
	{
		die("erro ao cadastrar informaçãoes adicionais");
	}
	/*else
	{
		echo("<script>console.log('$dado[0] foi atualizado.')</script>");

	}
	*/
}

?>