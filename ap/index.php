<?php include("../autoload.php");?>		
<?php //include("security.php");?>						
<?php


$action = "";
if(isset($_REQUEST["action"]) and $_REQUEST["action"]!=""){
	$action = $_REQUEST["action"];
}
$values = $_REQUEST;
	switch ($action) {
		case "index":
			executeIndex($values);	
		break;
        case "acceso":
			executeAcceso($values);	
		break;
		case "bienvenida":
			executeBienvenida($values);	
		break;
		case "logout":
			executeLogout($values);	
		break;
		default:
			executeIndex($values);
		break;
	}
						
	function executeIndex($values = null){
	require('login.php');
	}
	function executeBienvenida($values = null){
	
	require('bienvenida.php');
	}
	function executeAcceso($values = null){
	$_SESSION['id_company'] = 1;
	require('bienvenida.php');
	}
	function executeLogout($values = null){
	require('login.php');
	}
