<?php
class Usuario{
	
	private $id;
	private $nome;
	private $senha;
	private $email;
	private $acesso;
	private $imagem;
	
	//setters
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setSenha($senha){
		$this->senha = $senha;
	}
	function setEmail($email){
		$this->email = $email;
	}
	function setAcesso($acesso){
		$this->acesso = $acesso;
	}
	function setImagem($url_imagem){
		$this->imagem = $url_imagem;
	}
	
	//getters
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	function getSenha(){
		return $this->senha;
	}
	function getEmail(){
		return $this->email;
	}
	function getAcesso(){
		return $this->acesso;
	}
	function getImagem(){
		return $this->imagem;
	}
}
?>