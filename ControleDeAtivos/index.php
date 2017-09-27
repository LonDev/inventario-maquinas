<?php
require_once("view/header.php");

$default = "administracao";
@$page = $_REQUEST["p"];

if(isset($page))
{
	if(file_exists("view/$page.php"))
	{
		include("view/$page.php");	
	}
	else
	{
		include("view/404.php");
	}
	
}
else
{
	include("view/$default.php");	
}

?>