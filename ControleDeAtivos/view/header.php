<?php require_once("/../controller/config.php");

session_start();
if(empty($_SESSION["user"]))
{
    header("Location: login.php");
    //exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <!--meta http-equiv="pragma" content="no-cache"-->
        <meta charset="utf-8">    
		<link rel="stylesheet" href="css/bootstrap.min.css?<?php echo VERSION;?>">
                <script src="js/jquery.min.js?<?php echo VERSION;?>"></script>
                <script src="js/bootstrap.min.js?<?php echo VERSION;?>"></script>
                
                <link rel="stylesheet" href="css/style.css?<?php echo VERSION;?>"/>
                <link  rel="stylesheet" href="css/base-admin.css?<?php echo VERSION;?>"/>
				
                <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
				<title>NEOBPO Controle de Ativos</title>
	</head>
	<body>
		<div id="header">
        <div class="title">
              <a href="/">
               <img alt="Logo Neobpo" src="Img/neo_logo.png">
                Controle de Ativos
              </a>
        </div>
        <br>
        <div class="info-usuario">
            Seja bem-vindo, <?php echo $_SESSION['user']; ?></   span> | <a onclick="#" href="/Functions/logoff.php">Efetuar
                    logoff</a>
        </div>
        <div class="conteudo">
            <div class="menu">
                <ul>                    
                    <li>
                        <a onclick="#" href="?p=administracao">
                        Administração do Sistema</a> </li>
                    
                        <li><span class="divisor"></span>
                           <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Cadastro de equipamentos
                            <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Máquinas</li>
                                <li><a href="?p=solo-equipamento-maquina">Uma máquina</a></li>
                                <li><a href="?p=varios-equipamento-maquinas">Varias máquinas</a>
                                
                                <li class="divider" role="separator">

                                <li class="dropdown-header">Monitores</li>
                                <li><a href="?p=solo-equipamento-monitor">Um monitor</a></li>
                                <li><a href="?p=varios-equipamento-monitors">Varios monitores</a>
                            </ul>
                        </li>
                                                
                        <li><span class="divisor"></span><a onclick="#" href="?p=movimentacao">
                        Movimentação de Equipamentos</a> </li>            
                    
                    <li><span class="divisor"></span><a onclick="#" href="?p=consulta">
                        Pesquisar Movimentação</a> </li>
						
                    <li><span class="divisor"></span>
                           <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Relatórios
                            <span class="caret"></span></a>
                            
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="?p=relatorioop">Máquinas</a></li>
                                <li><a href="?p=relatoriomonitors">Monitores</a>
                                <li><a href="?p=relatorioCPU">Máquinas disponiveis</a>
                                
                            </ul>
                        </li>

                </ul>
            </div>
        </div>
    </div>
	<div class="container-fluid">