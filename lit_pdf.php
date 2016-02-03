<?php
// (c) Xavier Nicolay
// Exemple de g�n�ration de devis/facture PDF

require('invoice_lit.php');

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
$etatlit=$_GET["etatlit"];

//**************************//
if ($_GET["description"]!=""){
$description=$_GET["description"];
}else{
    $description="-";
}
//************************//
if ($etatlit==0){
    $etatlitdesc="EN PANNE";

}else{
    $etatlitdesc="EN MARCHE";
}

//***********************//
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
$pdf->fact_dev( "CONTRAT LIT DE LOCATION" );
$pdf->temporaire( "Technique" );
$pdf->addDate( "$today");
$pdf->addEtat("$etatlitdesc");
$pdf->Image('img/Sigle.jpg',10,10,-360);

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


$pdf->addsignature();


//$pdf->Output("$repconstratlit\CL"."$reflit"."_"."$today.pdf",'F');

$pdf->Output();
?>
