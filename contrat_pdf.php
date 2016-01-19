<?php

require('invoice.php');
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
//************************//
$today = date("d-m-Y");
$nom_client="";
$adresse_client="";
$tel_client="";
$gsm_client="";
$cin_client="";
$date_cin="";
$nom_ben="";
$adresse_ben="";
$tel_ben="";
$cin_ben="";
extract($_POST);

//**************************//
if (isset($_POST["ajout"])) {
    $cin_client="";
    extract($_POST);
    $req1 = "INSERT INTO commande (ref,nom_client,adresse_client,tel_client,gsm_client,cin_client,date_cin,nom_ben,adresse_ben,tel_ben,cin_ben,total_htva,total_tva,total_ttc,total_caution,date_commande)
VALUES (" ."'".$ref."'"."," ."'".$nom_client."'".","."'".$adresse_client."'".","."'".$tel_client."'".","."'".$gsm_client."'".","."'".$cin_client."'".","."'".$date_cin."'".",
"."'".$nom_ben."'".","."'".$adresse_ben."'".","."'".$tel_ben."'".","."'".$cin_ben."'".",
"."'".$total_htva."'".","."'".$total_tva."'".","."'".$total_ttc."'".","."'".$total_caution."'".","."'".$date_commande."'".")";
    $oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement

    //id_dernier d'une commande
    $req2 = "SELECT * FROM commande WHERE id=(SELECT MAX(id) as 'DERNIER_ID' from commande)";


    $oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
    $oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);

    while ($row2=$oPDOStatement2->fetch())
    {
        $iddernier=$row2->id;

    }
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
$pdf->fact_dev( "CONTRAT DE LOCATION DE MATERIEL RESPIRATOIR N $ref" );
//$pdf->temporaire( "Technique" );
//$pdf->addDate( "$today");
//$pdf->Image('img/Sigle.jpg',10,10,-360);

if(!empty($_SESSION['id']))
{
// on extrait les id du caddie
$id_liste=$_SESSION['id'];


// on fait notre requête
/*$req="select id,nom from produit where id IN(".$id_liste.")";
$oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
$oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.*/
$total_htva=0;
$total_caution=0;
//ligne par ligne
 foreach($id_liste as $i => $val){
    $req="select * from produit where id =$val";
    $oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
    $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
    while ($data=$oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
    {
        $idd=$data['id'];
        $type=$data['type'];
        $prix_total=$_SESSION['prix'][$i]*$_SESSION['panier'][$i];

        $total_htva=$total_htva+$prix_total;
        $total_caution=$total_caution+$_SESSION['caution'][$i];
        echo "<tr>
                                            <td>".$data['nom'];
        if ($type==1) {
            $ref_lit=$_SESSION['lit'][$i];
            if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
            elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}
            echo"<br><b>Ref: &nbsp;</b>MM2-L".$ref_lit."-S";}
        echo "</td>

                                          <td>".$_SESSION['periode'][$i]."</td>
                                          <td>".$_SESSION['panier'][$i]."</td>
                                          <td>".$_SESSION['prix'][$i]."</td>
                                          <td>".$prix_total."</td>
                                          <td>".$_SESSION['caution'][$i]."</td>

                                          </tr>";//Lecture des résultats
        //insertion  dans ligne commande
        if(isset($_POST['ajout']))
        {
            $req = "INSERT INTO ligne_commande ( id_commande,id_produit,periode,qte,prix_unit_ht,prix_caution)
                                                VALUES ("."'".$iddernier."'".","."'".$idd."'".","."'".$_SESSION['periode'][$i]."'".","."'".$_SESSION['panier'][$i]."'".","."'".$_SESSION['prix'][$i]."'".","."'".$_SESSION['caution'][$i]."'".")";
            $oPDOStatement4=$connect->query($req); // Le résultat est un objet de la classe PDOStatement



        }
    }
 }
}

//$pdf->addClient("CL01");
//$pdf->addPageNumber("1");
$pdf->addClientAdresse("Ste\nM. XXXX\n3�me �tage\n33, rue d'ailleurs\n75000 PARIS");
//$pdf->addReglement("Ch�que � r�ception de facture");
//$pdf->addEcheance("03/12/2003");
//$pdf->addReference("Devis ... du ....");

if(!empty($_SESSION['id'])) {
    $total_tva = $total_htva * 0.18;
    $totat_ttc = $total_htva + $total_tva;
}

$pdf->addsignature();


//$pdf->Output("$repconstratlit\CL"."$reflit"."_"."$today.pdf",'F');

$pdf->Output();

//unset($_SESSION['id']);
//unset($_SESSION['panier']);
//unset($_SESSION['prix']);
//unset($_SESSION['periode']);
//unset($_SESSION['caution']);
?>
