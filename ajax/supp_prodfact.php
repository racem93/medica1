<?php 
session_start ();
	$id_prod=$_GET["id"]; 
unset($_SESSION['panier'][$id_prod]);	
header("location:../prod_select1.php");
	
?>