<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start ();
	$id_prod=$_GET["id"]; 
unset($_SESSION['panier'][$id_prod]);	
header("location: prod_select.php");
	
?>