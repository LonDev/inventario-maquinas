<?php
/*
function valida_ldap($srv, $usr, $pwd)
{

    $ldap_server = $srv;
    $auth_user = $usr;
    $auth_pass = $pwd;

    // Tenta se conectar com o servidor
    if (!($connect = @ldap_connect($ldap_server))){
       return FALSE;
    }

    // Tenta autenticar no servidor
    if (!($bind = @ldap_bind($connect, $auth_user, $auth_pass))) {
        // se nao validar retorna false
        return FALSE;
    } else {
        // se validar retorna true
        return TRUE;
    }

} // fim funcao conectar ldap

$dominio = "@TIVIT.CORP";
$usuario = $_POST['user'];
$user = $usuario.$dominio;
$pass = $_POST['pass'];
$ip_server = "TIVIT.CORP";

/*
if (valida_ldap($ip_server, $user, $pass))
{*/

	require_once("/../dao/UsuarioDAO.php");
	$usuarioDao = new UsuarioDAO;
	@$usuario = $_POST['user'];
	
	if($usuarioDao->getAcesso($usuario))
	{
		session_start();
		$_SESSION["user"] = $usuario;
		header("location: http://10.220.30.10:8080/");
	}
	else
	{
		http_response_code(404);
	}
/*}
else
{	
	http_response_code(404);
}
*/
?>