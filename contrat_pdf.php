<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
require('invoice.php');
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
//************************//
$today = date("d-m-Y");
$nom_client="";
$adresse_client="";
$tel_client="";
$cin_client="";
$date_cin="";
$nom_ben="";
$adresse_ben="";
$tel_ben="";
$cin_ben="";
extract($_POST);

//**************************//
$id=$_GET['id'];

$gsm_client="";
$req1="SELECT * FROM `commande` WHERE `id`=$id; ";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch()) {
    $id = $row->id;
    $ref = $row->ref;
    $nom_client = $row->nom_client;
    $date_commande = $row->date_commande;
    $adresse_client = $row->adresse_client;
    $tel_client = $row->tel_client;
    $gsm_client = $row->gsm_client;
    $cin_client = $row->cin_client;
    $date_cin = $row->date_cin;
    $nom_ben = $row->nom_ben;
    $adresse_ben = $row->adresse_ben;
    $tel_ben = $row->tel_ben;
    $cin_ben = $row->cin_ben;
    $total_caution = $row->total_caution;
    $total_htva = $row->total_htva;
    $total_tva = $row->total_tva;
    $total_ttc = $row->total_ttc;

}

//***********************//
$contrat="contrats";
if (!is_dir($contrat))
{
    mkdir($contrat);
}
//************************//
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "$nom_client",
                  "$adresse_client\n" .
                  "75000 PARIS\n".
                  "R.C.S. PARIS B 000 000 007\n" .
                  "Capital : 18000" );

//$pdf->fact_dev( "Constrat ", "TEMPO" );
$pdf->cont_loc( "CONTRAT DE LOCATION\n".
 "DE\n".
    "MATERIEL RESPIRATOIR N $ref" );
//$pdf->temporaire( "Technique" );
//$pdf->addDate( "$today");
$pdf->Image('img/Sigle.jpg',27,5,-680);
$pdf->Image('img/LOGO.jpg',10,5,-680);



//$pdf->addClient("CL01");
//$pdf->addPageNumber("1");
$pdf->addClientAdresse("Ste\nM. XXXX\n3�me �tage\n33, rue d'ailleurs\n75000 PARIS");
//$pdf->addReglement("Ch�que � r�ception de facture");
//$pdf->addEcheance("03/12/2003");
//$pdf->addReference("Devis ... du ....");





$pdf->addsignature();


//$pdf->Output("$repconstratlit\CL"."$reflit"."_"."$today.pdf",'F');

$pdf->Output();

//unset($_SESSION['id']);
//unset($_SESSION['panier']);
//unset($_SESSION['prix']);
//unset($_SESSION['semaine']);
//unset($_SESSION['mois']);
//unset($_SESSION['caution']);
?>
