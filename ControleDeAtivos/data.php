<?php /* 
Copyright (c) 2007, Gurú Sistemas and/or Gustavo Adolfo Arcila Trujillo 
All rights reserved. 
www.gurusistemas.com 

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met: 

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer. 
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer 
      in the documentation and/or other materials provided with the distribution. 
    * Neither the name of the Gurú Sistemas Intl nor Gustavo Adolfo Arcila Trujillo nor the names of its contributors may be used to 
      endorse or promote products derived from this software without specific prior written permission. 

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS  "AS IS"  AND ANY EXPRESS  OR  IMPLIED WARRANTIES, INCLUDING,  
BUT NOT LIMITED TO,  THE IMPLIED WARRANTIES  OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.  IN NO EVENT 
SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,  INDIRECT,  INCIDENTAL, SPECIAL, EXEMPLARY,  OR CONSEQUENTIAL  
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF  USE, DATA, OR PROFITS;  OR BUSINESS  
INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE  
OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  

phpMyDataGrid is Open Source released under the BSD License, if you like this script and think to use it please make a donation.  
We ask a minimum donation, (as low as USD 10, but if you think you can do a higher donation, don't think twice, just do it ;-)  
if you compare, you can find commercial versions with less features than phpMyDataGrid with prices higher than USD499.   
So, just to make a donation is a cheap.  

Please remember donating is one way to show your support, copy and paste in your internet browser the following link to make your donation 
https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=tavoarcila%40gmail%2ecom&item_name=phpMyDataGrid%202007&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8 

For more info, samples, tips, screenshots, help, contact, forum, please visit phpMyDataGrid site   
http://www.gurusistemas.com/indexdatagrid.php 

For contact author: tavoarcila at gmail dot com or info at gurusistemas dot com 
*/ ?> 
<html lang="pt-br">
  <head>
  	<meta charset="UTF-8">
 <link rel="stylesheet" href="./DataGrid/css/dgstyle.css">
 <script src="./DataGrid/js/dgscripts.js"></script>
<title>CONTROLE DE ATIVOS - TIVIT.CORP</title> 

<?php 

    include ("./DataGrid/phpmydatagrid.class.php"); 
     
    $objGrid = new datagrid; 
     
    $objGrid -> friendlyHTML(); 

    $objGrid -> pathtoimages("./DataGrid/images/"); 

    $objGrid -> closeTags(true);   
     
    $objGrid -> form('employee', true); 
     
    $objGrid -> methodForm("post");  
     
    //$objGrid -> total("salary,workeddays"); 
     
    $objGrid -> searchby("id,ativo,serial"); 
     
    $objGrid -> linkparam("sess=".(isset($_REQUEST["sess"])?$_REQUEST["sess"]:"demo")."&username=".(isset($_REQUEST["username"])?$_REQUEST["username"]:"demo"));      
     
    $objGrid -> decimalDigits(2); 
     
    $objGrid -> decimalPoint(","); 
     
    $objGrid -> conectadb("127.0.0.1", "root", "", "controleativo"); 
     
    $objGrid -> tabla ("tivitcorp"); 

    /* Allow Add, edit, delete or view records */ 
    $objGrid -> buttons(true,true,true,true); 
     
    /* Keyfield must be defined to indentify each row */ 
    $objGrid -> keyfield("id"); 

    /* A code is related with some transactions. so is very dificult to someone to try to do unauthorized process */ 
    /* There are a internal code but you can made it strong by setting this function" */ 
    $objGrid -> salt("Some Code4Stronger(Protection)"); 

    $objGrid -> TituloGrid("CONTROLE DE ATIVOS - TIVIT.CORP"); 

    $objGrid -> FooterGrid("<div style='float:left'>&copy; 2015 Guilherme Chafy</div>"); 

    $objGrid -> datarows(100); 
     
    $objGrid -> paginationmode('links'); 

    $objGrid -> orderby("id", "CRESC"); 

    $objGrid -> noorderarrows(); 
     //(`id`, `usuario`, `hostname`, `ip`, `ramal`, `office`, `contato`, `dominio`)
    $objGrid -> FormatColumn("id", "ID", 5, 5, 1, "50", "center", "left"); 
    $objGrid -> FormatColumn("usuario", "Usuario", 30, 30, 0, "150", "center"); 
    $objGrid -> FormatColumn("hostname", "Hostname", 30, 30, 0, "150", "center"); 
    $objGrid -> FormatColumn("ip", "IP", 5, 5, 0, "150", "center"); 
    $objGrid -> FormatColumn("ramal", "Ramal", 10, 10, 0, "150","center"); 
    $objGrid -> FormatColumn("office", "Office", 5, 5, 0, "150", "center"); 
    $objGrid -> FormatColumn("contato", "Ultimo Contato", 2, 2, 0,"150", "center"); 
    $objGrid -> FormatColumn("dominio", "Dominio", 10, 10, 0, "150", "center"); 
    //$objGrid -> FormatColumn("workeddays", "Work days", 5, 2, 0, "50", "right", "integer"); 

    //$objGrid -> where ("active = '1'"); 

    $objGrid -> setHeader(); 
?> 
</head> 

<body> 
<?php  
    $objGrid -> grid(); 
     
    $objGrid -> desconectar(); 
?> 
</body> 
</html> 

