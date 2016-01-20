<?php 
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start ();

$id_prod=$_GET["id"];
$qte=$_GET["qte"];
$prix_ht=$_GET["prix_ht"];
$caution=$_GET["caution"];
$semaine=$_GET["semaine"];
$mois=$_GET["mois"];
$type=$_GET["type"];

if($_POST['action'] == 'ajout') {

  if (!isset ($_SESSION['id']) ){
	$_SESSION['id']=array();
	$_SESSION['panier']=array();
	}

	end($_SESSION['id']);
	$i=key($_SESSION['id'])+1;
	$id_article=$id_prod;
	$quantite_article=$qte;
	$prix_article=$prix_ht;
	$caution_article=$caution;

	$_SESSION['id'][$i]=$id_article;
	if ($type==1) {$_SESSION['panier'][$i]=1;
		$_SESSION['lit'][$i]=$quantite_article;
	}
	else{
	$_SESSION['panier'][$i]=$quantite_article;}
	$_SESSION['prix'][$i]=$prix_article;
	$_SESSION['caution'][$i]=$caution_article;
	$_SESSION['semaine'][$i]=$semaine;
	$_SESSION['mois'][$i]=$mois;

	print("Le produit a ete ajoute avec succes");

	}
	
	
	
?>

