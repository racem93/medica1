<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
require('invoice.php');
require('config/fonctions.php');

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
/*$pdf->addSociete( "$nom_client",
                  "$adresse_client\n" .
                  "75000 PARIS\n".
                  "R.C.S. PARIS B 000 000 007\n" .
                  "Capital : 18000" );*/
$pdf->addSiege("Siege Social:","12bis Av. Tarak Ibn Ziad.\n".
    "El Menzah V\n".
    "2037 Ariana - Tunisie","TEL");

//$pdf->fact_dev( "Constrat ", "TEMPO" );
$pdf->cont_loc( "CONTRAT DE LOCATION\n".
 "DE\n".
    "MATERIEL RESPIRATOIR N $ref" );
$pdf->clausecontrattxt( ">> Clauses du Contrat au Verso >>" );
//$pdf->addDate( "$today");
$pdf->Image('img/Sigle.jpg',27,5,-680);
$pdf->Image('img/LOGO.jpg',10,5,-680);



//$pdf->addClient("CL01");
//$pdf->addPageNumber("1");
$pdf->addClientAdresse("Nom : $nom_client \nAdresse : $adresse_client \nTel : $tel_client \nGSM : $gsm_client \nCIN N : $cin_client  Tunis,le : $date_cin");
$pdf->addbenificiaire("M/Mme : $nom_ben\nAdresse : $adresse_ben\nTel : $tel_ben\nCIN N : $cin_ben");

$pdf->totalettctva($total_htva,$total_tva,$total_ttc,$total_caution);

$accompte=300;
$pdf->Accompte($accompte);
$pdf->transport();

$let=strtoupper(int2str($total_ttc));

$pdf->contratenttelettre("$let");



$cols=array( "Ref."    => 11,
    "DESIGNATION"  => 70,
    "Periode"     => 20,

    "Qte"     => 9,
    "P.U. HT"      => 25,
    "MT H.T." => 27,
    "Caution/Unite"          => 28 );
$pdf->addCols2( $cols);
$cols=array( "REFERENCE"    => "L",
    "DESIGNATION"  => "L",
    "Periode"     => "C",

    "Qte"     => "C",
    "P.U. HT"      => "R",
    "MT H.T." => "R",
    "Caution/Unite"          => "C" );

$y    = 109;


                                    $req2="select * from ligne_commande where id_commande =$id";
                                    $oPDOStatements2=$connect->query($req2); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                    $oPDOStatements2->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.

$k=0;
$nbPage=1;
                while ($data=$oPDOStatements2->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                {
                    $id_produit = $data['id_produit'];
                    $id_lit = $data['id_lit'];
                    $prix_unit_ht = $data['prix_unit_ht'];
                    $qte = $data['qte'];
                    $semaine = $data['semaine'];
                    $mois = $data['mois'];
                    $prix_caution = $data['prix_caution'];
                    $etat_louer = $data['etat_louer'];

                    $prix_total = $qte * $prix_unit_ht;


                    $req3 = "select * from produit where id =$id_produit";
                    $oPDOStatements3 = $connect->query($req3); // Le r&eacute;sultat est un objet de la classe PDOStatement
                    $oPDOStatements3->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                    while ($data3 = $oPDOStatements3->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                    {
                        $idd = $data3['id'];
                        $type = $data3['type'];
                       $nomprod= $data3['nom'];
                      //  echo "<tr>
                                    //        <td>" . $data3['nom'];
                        if ($type == 1) {
                            $req1 = "SELECT ref_lit FROM `lit` WHERE id=$id_lit";
                            $oPDOStatement1 = $connect->query($req1); // Le résultat est un objet de la classe PDOStatement
                            $oPDOStatement1->setFetchMode(PDO::FETCH_ASSOC);;
                            while ($row = $oPDOStatement1->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                            {
                                $ref_lit = $row['ref_lit'];
                            }
                            if ($ref_lit < 10) {
                                $ref_lit = "00" . $ref_lit;
                            } elseif (($ref_lit < 100) && ($ref_lit >= 10)) {
                                $ref_lit = "0" . $ref_lit;
                            }
                            echo "<br><b>Ref: &nbsp;</b>MM2-L" . $ref_lit . "-S";
                            $reflittotal="MM2-L".$ref_lit . "-S";
                        }

                        $semainetot=0;
                        if ($semaine != 0) {
                          //  echo $semaine . " Semaine <br>";
                            $semainetot=$semaine . " Sem";
                        }
                        $moistot=0;
                        if ($mois != 0) {
                            //echo $mois . " Mois";
                            $moistot=$mois . " Mois";
                        }



                        $k++;
                        if ($k < 27) {




                            $line = array("Ref." => "$ref",
                                "DESIGNATION" => "$nomprod",
                                "Periode" => "$semainetot\n$moistot",

                                "Qte" => "$qte",
                                "P.U. HT" => number_format($prix_unit_ht, 3),
                                "MT H.T." => number_format($prix_total, 3),

                                "Caution/Unite" => number_format($prix_caution, 3));
                            $size = $pdf->addLine($y, $line);
                            $y += $size + 4.2;

                        }

                        /*else {

                            $k = 0;
                            $nbPage++;
                            $y = 109;
                        }*/

                    }


                }




//$pdf->addsignature();


//$pdf->Output("$repconstratlit\CL"."$reflit"."_"."$today.pdf",'F');

$pdf->Output();

//unset($_SESSION['id']);
//unset($_SESSION['panier']);
//unset($_SESSION['prix']);
//unset($_SESSION['semaine']);
//unset($_SESSION['mois']);
//unset($_SESSION['caution']);
?>
