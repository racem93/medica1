<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start ();
	$id_prod=$_GET["id"]; 
unset($_SESSION['id'][$id_prod]);
unset($_SESSION['panier'][$id_prod]);
unset($_SESSION['prix_s'][$id_prod]);
unset($_SESSION['prix_m'][$id_prod]);
unset($_SESSION['semaine'][$id_prod]);
unset($_SESSION['mois'][$id_prod]);
unset($_SESSION['caution'][$id_prod]);
header("location: prod_select.php");
	
?>