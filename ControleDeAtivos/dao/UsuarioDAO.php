<?php
	require_once("/../Functions/conexao.php");
class UsuarioDAO{
	
function getAcesso($usuario){
	$pdo = conecta();
	$valida = $pdo->prepare("SELECT login FROM usuarios WHERE login=:login");
	$valida->bindValue(":login", $usuario);
	$valida->execute();
	
	//caso usuario seja valido ira retornar o seu ID, caso contrario retorna 0 que
	//é o resultado da contagem de linha da pesquisa 
	if($valida->rowCount() > 0)
	{
		//$dados = $valida->fetch(PDO::FETCH_ASSOC);
		return true;
	}
	
	return false;
}

function buscaUsuario($id){
	$pdo = conecta();
	$usuario = new Usuario();
	$busca = $pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
	$busca->bindValue(":id",$id);
	$busca->execute();
	
	if($busca->rowCount() > 0)
	{
		$dados = $busca->fetch(PDO::FETCH_ASSOC);
		
		$usuario->setId($dados['id']);
		$usuario->setNome($dados['nome']);
		$usuario->setSenha($dados['senha']);
		$usuario->setEmail($dados['email']);
		$usuario->setAcesso($dados['acesso']);
		$usuario->setImagem($dados['imagem']);
		return $usuario;
	}
	else
	{
		return 0;
	}
}
	
function listaUsuario(){
	$pdo = conecta();
	$array[] = null;
	$i = 0;//contator
	$busca = $pdo->prepare("SELECT * FROM usuarios ORDER BY id DESC");
	
	if(!$busca->execute())
	{
		echo "Erro ao buscar(user.x01)";
		die();
	}
	if($busca->rowCount() > 0)
	{
		$data = $busca->fetchAll(PDO::FETCH_ASSOC);
		foreach($data as $dados)
		{
			$usuario = new Usuario();
			
			$usuario->setId($dados['id']);
			$usuario->setNome($dados['nome']);
			$usuario->setSenha($dados['senha']);
			$usuario->setEmail($dados['email']);
			$usuario->setAcesso($dados['acesso']);
			$usuario->setImagem($dados['imagem']);
			
			$array[$i] = $usuario;
			
			$i++;
		}
	}	
return $array;
}
function gravarUsuario($usuario){
	$pdo = conecta();			
	if($usuario->getImagem() =="")
	{
		$insere = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, acesso) VALUES (:nome,:email,:senha,:acesso)");		
	}
	else
	{
		$insere = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, acesso,imagem) VALUES (:nome,:email,:senha,:acesso,:imagem)");
		$insere->bindValue(":imagem", $usuario->getImagem());
	}
	$insere->bindValue(":nome", $usuario->getNome());
	$insere->bindValue(":email", $usuario->getEmail());
	$insere->bindValue(":senha", $usuario->getSenha());
	$insere->bindValue(":acesso",$usuario->getAcesso());
	
	if(!$insere->execute())
	{
		echo "Erro ao cadastrar(user.x02)";
		die();
	}
}
		
function atualizarUsuario($usuario){
	$pdo = conecta();			
	if($usuario->getImagem() =="")
	{
		$atualiza = $pdo->prepare("UPDATE usuarios SET nome=:nome, email=:email, senha=:senha, acesso=:acesso WHERE id=:id");
	}
	else
	{
		$atualiza = $pdo->prepare("UPDATE usuarios SET nome=:nome, email=:email, senha=:senha, acesso=:acesso, imagem=:imagem WHERE id=:id");
		$atualiza->bindValue(":imagem", $usuario->getImagem());
	}
	$atualiza->bindValue(":nome", $usuario->getNome());
	$atualiza->bindValue(":email", $usuario->getEmail());
	$atualiza->bindValue(":senha", $usuario->getSenha());
	$atualiza->bindValue(":acesso",$usuario->getAcesso());
	$atualiza->bindValue(":id",$usuario->getId());
	if(!$atualiza->execute())
	{
		echo "Erro ao atualizar(user.x03)";
		die();
	}
}
	
function excluirImagem($id_usuario){
	$pdo = conecta();	
	$exclui = $pdo->prepare("UPDATE usuarios SET imagem=:imagem WHERE id=:id");
	$exclui->bindValue(":imagem","");
	$exclui->bindValue(":id",$id_usuario);
		
	if(!$exclui->execute())
	{
		echo "Erro ao excluir a foto do usuario(user.x04).";
		die();
	}
}
		
function removerUsuario($usuario){
	$pdo = conecta();
	$exclui = $pdo->prepare("DELETE FROM usuarios WHERE id=:id");
	$exclui->bindValue(":id", $usuario->getId());
	
	if(!$exclui->execute())
	{
		echo "Erro ao excluir o usuario(user.x05).";
		die();
	}		

}
		
}

?>