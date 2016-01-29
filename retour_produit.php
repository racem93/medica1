<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
//

session_start();
if(!isset($_SESSION['admin']))
{
    header("location:login.html");
}

include_once("config/MyPDO.class.php");
$connect=new MyPDO();

$id_lcommande=$_GET['id'];
$req2="select * from ligne_commande where id=$id_lcommande";
$oPDOStatements2=$connect->query($req2); // Le r&eacute;sultat est un objet de la classe PDOStatement
$oPDOStatements2->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
while ($data=$oPDOStatements2->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
{
    $id = $data['id'];
    $id_produit = $data['id_produit'];
    $id_lit = $data['id_lit'];
    $etat_louer = $data['etat_louer'];
}
$req3 = "UPDATE `ligne_commande` SET `etat_louer`=0  WHERE `id`=$id_lcommande ";
$oPDOStatement3 = $connect->query($req3);
if ($id_lit==0) {
    $req4 = "UPDATE `produit` SET `qte_louer`=`qte_louer`-1  WHERE `id`=$id_produit ";
    $oPDOStatement4 = $connect->query($req4);
}
if ($id_lit!=0) {
    $req6 = "UPDATE `lit` SET `etat_louer`=0  WHERE `id`=$id_lit";
    $oPDOStatement6 = $connect->query($req6);
    $req7 = "UPDATE `produit` SET `qte_louer`=`qte_louer`-1  WHERE `id`=$id_produit ";
    $oPDOStatement7 = $connect->query($req7);
}

?>