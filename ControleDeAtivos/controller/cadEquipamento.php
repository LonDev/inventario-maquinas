<?php
//include("conexao.php");
$link = mysqli_connect("localhost", "root", "", "controleativo");
session_start();
$tipo=$_POST['TIPO'];
$ativo=$_POST['ATIVO'];
$serial=$_POST['SERIAL'];
$local=$_POST['LOCAL'];
$sublocal=$_POST['SUBLOCAL'];
$data=$_POST['DATA'];
$motivo="Cadastro Inicial";
$usuario=$_SESSION['user'];


$sql="INSERT INTO equipamento (cod,cod_tipo,ativo,serial) VALUES (null,$tipo,'$ativo','$serial');";
$sql .= "SELECT LAST_INSERT_ID() INTO @ID;";
$sql .= "INSERT INTO movimentacao (cod,cod_equipamento,data,motivo,localizacao,sublocal,usuario,status) VALUES(null,@ID,'$data','$motivo',$local,$sublocal,'$usuario',1);";



if (mysqli_multi_query($link,$sql)) {
    $response_array['status'] = 'success';  
    } else {
     header("Location:erro.php");
    }
       

?>