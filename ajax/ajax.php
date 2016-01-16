<?php 
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start ();

$id_prod=$_GET["id"];
$qte=$_GET["qte"];
$prix_ht=$_GET["prix_ht"];
$caution=$_GET["caution"];
$periode=$_GET["periode"];

if($_POST['action'] == 'ajout') {

  if (!isset ($_SESSION['panier']) ){
	$_SESSION['panier']=array();
	}
		
			
	$id_article=$id_prod;
	$quantite_article=$qte;
	$prix_article=$prix_ht;
	$caution_article=$caution;
	$periode_article=$periode;


	$_SESSION['panier'][$id_article]=$quantite_article;
	$_SESSION['prix'][$id_article]=$prix_article;
	$_SESSION['caution'][$id_article]=$caution_article;
	$_SESSION['periode'][$id_article]=$periode_article;


	}else{
	print("$id_prod-$qte-$prix_ht-$caution-$periode");

}


	
?>

