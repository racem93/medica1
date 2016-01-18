<?php 
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start ();

$id_prod=$_GET["id"];
$qte=$_GET["qte"];
$prix_ht=$_GET["prix_ht"];
$caution=$_GET["caution"];
$periode=$_GET["periode"];

if($_POST['action'] == 'ajout') {

  if (!isset ($_SESSION['id']) ){
	$_SESSION['id']=array();
	$_SESSION['panier']=array();
	}
		
	$i=count($_SESSION['id'])+1;
	$id_article=$id_prod;
	$quantite_article=$qte;
	$prix_article=$prix_ht;
	$caution_article=$caution;
	$periode_article=$periode;

	$_SESSION['id'][$i]=$id_article;
	$_SESSION['panier'][$i]=$quantite_article;
	$_SESSION['prix'][$i]=$prix_article;
	$_SESSION['caution'][$i]=$caution_article;
	$_SESSION['periode'][$i]=$periode_article;

	print("Le produit a ete ajoute avec succes");

	}
	
	
	
?>

