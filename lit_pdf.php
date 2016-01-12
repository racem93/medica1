<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF

require('invoice.php');

//************************//
$today = date("d-m-Y");
$modellit=$_GET["modellit"];
$reflit=$_GET["reflit"];
$refmoteurpr=$_GET["refmoteurpr"];
$refmoteursec=$_GET["refmoteursec"];
$reftelecommande=$_GET["reftelecommande"];
$etatbase=$_GET["etatbase"];
$etatbarriere=$_GET["etatbarriere"];
$etatpanneaux=$_GET["etatpanneaux"];
$etatmoteur=$_GET["etatmoteur"];
$etatvariable=$_GET["etatvariable"];
$etatreleve=$_GET["etatreleve"];
$etattelecommande=$_GET["etattelecommande"];
$etatperroquet=$_GET["etatperroquet"];
if ($_GET["description"]!=""){
$description=$_GET["description"];
}else{
    $description="-";
}
//************************//
$repconstratlit="constratlits";
if (!is_dir($repconstratlit))
{
    mkdir($repconstratlit);
}
//************************//
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
/*$pdf->addSociete( "MedicA Shop",
                  "MonAdresse\n" .
                  "75000 PARIS\n".
                  "R.C.S. PARIS B 000 000 007\n" .
                  "Capital : 18000" );*/
$pdf->addreflit( "REF. DU LIT : "."MM2- L".$reflit." - S",
    "REF. MOTEUR PRINCIPAL : "."MM2- L".$refmoteurpr." - MP" ,
    "REF. MOTEUR R-B : "."MM2- L". $refmoteurpr." - MA",
    "REF. TELECOMMANDE : "."MM2- L".$reftelecommande." - MC"


);
//$pdf->fact_dev( "Constrat ", "TEMPO" );
$pdf->fact_dev( "CONSTRAT LIT DE LOCATION" );
$pdf->temporaire( "Technique" );
$pdf->addDate( "$today");
//$pdf->addClient("CL01");
//$pdf->addPageNumber("1");
//$pdf->addClientAdresse("Ste\nM. XXXX\n3�me �tage\n33, rue d'ailleurs\n75000 PARIS");
//$pdf->addReglement("Ch�que � r�ception de facture");
//$pdf->addEcheance("03/12/2003");
//$pdf->addNumTVA("FR888777666");
//$pdf->addReference("Devis ... du ....");
$cols=array( "ETATS"    => 67,
             "OBSERVATIONS"  => 142,
);
$pdf->addCols( $cols);
$cols=array( "ETATS"    => "L",
             "OBSERVATIONS"  => "C",

             );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;
$line = array( "ETATS"    => "ETAT DE LA BASE DU LIT",
               "OBSERVATIONS"  => "$etatbase",
               );
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;

$line = array( "ETATS"    => "ETAT DES BARRIERES",
               "OBSERVATIONS"  => "$etatbarriere",
                );
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;


$line = array( "ETATS"    => "ETAT DES PANNEAUX",
    "OBSERVATIONS"  => "$etatpanneaux",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;

$line = array( "ETATS"    => "ETAT MOTEUR CENTRAL",
    "OBSERVATIONS"  => "$etatmoteur",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;

$line = array( "ETATS"    => "MOTEUR HAUT.VARIABLE",
    "OBSERVATIONS"  => "$etatvariable",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;


$line = array( "ETATS"    => "MOTEUR RELEVE BUSTE",
    "OBSERVATIONS"  => "$etatreleve",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;

$line = array( "ETATS"    => "ETAT TELECOMMANDE",
    "OBSERVATIONS"  => "$etattelecommande",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;

$line = array( "ETATS"    => "ETAT DU PERROQUET",
    "OBSERVATIONS"  => "$etatperroquet",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 12;

$line = array( "ETATS"    => "AUTRES ACCESSOIRES",
    "OBSERVATIONS"  => "$description",
);
$size = $pdf->addLine( $y, $line );
$y   += $size + 4;

$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );

$pdf->addTVAs( $params, $tab_tva, $tot_prods);
$pdf->addCadreEurosFrancs();

/*
$pdf->Output("$repconstratlit\CL"."_"."$today.pdf",'F');
*/
$pdf->Output();
?>
