<?php
	$usuario = $_POST['user'];
	
	require_once("/../dao/UsuarioDAO.php");
	    
	$usuarioDao = new UsuarioDAO;

 	if($usuarioDao->getAcesso($usuario))
	{
		session_start();
		$_SESSION['user'] = $usuario;

	}
	else {
	   http_response_code(404);
	}

?>