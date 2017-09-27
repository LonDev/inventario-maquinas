<?php
session_start();
set_time_limit(0);


/* Teste Sem Autenticar LDAP 
$usuario = $_POST['user'];
include ('conexao.php');
 $connect->set("sql","select nivel_acesso from usuarios WHERE login = '$usuario' LIMIT 1");
 $resultado=$connect->executar();
while ($dados = mysql_fetch_array($resultado)) {
                $nivel = $dados['nivel_acesso'];							
            }  
            if (empty($nivel)) {
                header("Location: erro.php");
            } else {
                
            
    $_SESSION['user'] = $usuario;

}
 Fim Do teste aqui */
    
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

if (valida_ldap($ip_server, $user, $pass)) {
   /*include ('conexao.php');
     $connect->set("sql","select nivel_acesso from usuarios WHERE login = '$usuario' LIMIT 1");
     resultado=$connect->executar();
    while ($dados = mysql_fetch_array($resultado)) {
                $nivel = $dados['nivel_acesso'];							
            }  
            if (empty($nivel)) {
                header("Location: erro.php");
            } else {
                
            
    $_SESSION['user'] = $usuario;
    $_SESSION['nivel'] = $nivel;

    header("Location: ../administracao.php");
    exit;
    }
    */
    require_once("../dao/UsuarioDAO.php");
    
    $usuarioDao = new UsuarioDAO;
 	$_SESSION["user"] = $usuario;
 	$_SESSION["nivel"] = $usuarioDao->getAcesso($usuario);   

}else {
    header("Location: error.php");
}

?>