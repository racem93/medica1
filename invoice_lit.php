<?php
require('extras/fpdf/fpdf.php');

class PDF_Invoice extends FPDF
{
// private variables
var $colonnes;
var $format;
var $angle=0;

// private functions
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
	$k = $this->k;
	$hp = $this->h;
	if($style=='F')
		$op='f';
	elseif($style=='FD' || $style=='DF')
		$op='B';
	else
		$op='S';
	$MyArc = 4/3 * (sqrt(2) - 1);
	$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
	$xc = $x+$w-$r ;
	$yc = $y+$r;
	$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

	$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
	$xc = $x+$w-$r ;
	$yc = $y+$h-$r;
	$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
	$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
	$xc = $x+$r ;
	$yc = $y+$h-$r;
	$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
	$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
	$xc = $x+$r ;
	$yc = $y+$r;
	$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
	$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
	$this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
	$h = $this->h;
	$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
						$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

function Rotate($angle, $x=-1, $y=-1)
{
	if($x==-1)
		$x=$this->x;
	if($y==-1)
		$y=$this->y;
	if($this->angle!=0)
		$this->_out('Q');
	$this->angle=$angle;
	if($angle!=0)
	{
		$angle*=M_PI/180;
		$c=cos($angle);
		$s=sin($angle);
		$cx=$x*$this->k;
		$cy=($this->h-$y)*$this->k;
		$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	}
}

function _endpage()
{
	if($this->angle!=0)
	{
		$this->angle=0;
		$this->_out('Q');
	}
	parent::_endpage();
}

// public functions
function sizeOfText( $texte, $largeur )
{
	$index    = 0;
	$nb_lines = 0;
	$loop     = TRUE;
	while ( $loop )
	{
		$pos = strpos($texte, "\n");
		if (!$pos)
		{
			$loop  = FALSE;
			$ligne = $texte;
		}
		else
		{
			$ligne  = substr( $texte, $index, $pos);
			$texte = substr( $texte, $pos+1 );
		}
		$length = floor( $this->GetStringWidth( $ligne ) );
		$res = 1 + floor( $length / $largeur) ;
		$nb_lines += $res;
	}
	return $nb_lines;
}

	function clausecontrattxt( $txt )
	{
		$x1 = 120;
		$y1 = 94;
		//Positionnement
		$this->SetXY( $x1, $y1 );
		$this->SetFont('Arial','B',13);
		$length = $this->GetStringWidth( $txt );
		$this->Cell( $length, 2, $txt);



	}

// Company
function addSociete( $nom, $adresse )
{
	$x1 = 10;
	$y1 = 30;
	//Positionnement en bas
	$this->SetXY( $x1, $y1 );
	$this->SetFont('Arial','B',12);
	$length = $this->GetStringWidth( $nom );
	$this->Cell( $length, 2, $nom);
	$this->SetXY( $x1, $y1 + 4 );
	$this->SetFont('Arial','',10);
	$length = $this->GetStringWidth( $adresse );
	//Coordonn�es de la soci�t�
	$lignes = $this->sizeOfText( $adresse, $length) ;
	$this->MultiCell($length, 4, $adresse);
}


	// siege
	function addSiege( $nom, $adresse,$tel )
	{
		$x1 = 10;
		$y1 = 24;
		//Positionnement en bas
		$this->SetXY( $x1, $y1 );
		$this->SetFont('Arial','B',8);
		$length = $this->GetStringWidth( $nom );
		$this->Cell( $length, 2, $nom);

	$this->SetXY( $x1+19, $y1 -1  );
		$this->SetFont('Arial','',8);
		$length = $this->GetStringWidth( $adresse );
		$lignes = $this->sizeOfText( $adresse, $length) ;
		$this->MultiCell($length, 4, $adresse);
//----------------------------------------------
		$this->SetXY( $x1+54, $y1 );
		$this->SetFont('Arial','B',8);
		$length = $this->GetStringWidth( "Tel:" );
		$this->Cell( $length, 2, "Tel:");

		$this->SetXY( $x1+60, $y1  );
		$this->SetFont('Arial','',8);
		$length = $this->GetStringWidth( "71 234 242" );
		$lignes = $this->sizeOfText( "71 234 242", $length) ;
		//$this->MultiCell($length, 4, "71 234 242");
		$this->Cell( $length, 2, "71 234 242");
		$this->SetXY( $x1+74.2, $y1  );
		$this->SetFont('Arial','B',8);
		$length = $this->GetStringWidth( " - Fax:" );
		$this->Cell( $length, 2, " - Fax:");

		$this->SetXY( $x1+84, $y1  );
		$this->SetFont('Arial','',8);
		$length = $this->GetStringWidth( "71 233 836" );
		$lignes = $this->sizeOfText( "71 233 836", $length) ;
		$this->Cell( $length, 2, "71 233 836");


		$this->SetXY( $x1+54, $y1+3.5 );
		$this->SetFont('Arial','B',8);
		$length = $this->GetStringWidth( "Mobile:" );
		$this->Cell( $length, 2, "Mobile:");
		$this->SetXY( $x1+65, $y1+3.5  );
		$this->SetFont('Arial','',8);
		$length = $this->GetStringWidth( "21 396 411 - 22 326 840" );
		$lignes = $this->sizeOfText( "21 396 411 - 22 326 840", $length) ;
		//$this->MultiCell($length, 4, "71 234 242");
		$this->Cell( $length, 2, "21 396 411 - 22 326 840");


		$this->SetXY( $x1+54, $y1+8 );
		$this->SetFont('Arial','B',8);
		$length = $this->GetStringWidth( "E-mail:" );
		$this->Cell( $length, 2, "E-mail:");
		$this->SetXY( $x1+65, $y1+8  );
		$this->SetFont('Arial','',8);
		$length = $this->GetStringWidth( "medicashop@gmail.com" );
		$lignes = $this->sizeOfText( "medicashop@gmail.com", $length) ;
		//$this->MultiCell($length, 4, "71 234 242");
		$this->Cell( $length, 2, "medicashop@gmail.com");
//----------------------------------------------


	}


	function addreflit( $nom, $refmotp,$refmotrb,$reftel )
	{
		$x1 = 12;
		$y1 = 50;
		//Positionnement en bas
		$this->SetXY( $x1, $y1 );
		$this->SetFont('Arial','B',24);
		$length = $this->GetStringWidth( $nom );
		$this->Cell( $length, 2, $nom);


		$this->SetXY( $x1, $y1 + 14 );
		$this->SetFont('Arial','B',18);
		$length = $this->GetStringWidth( $refmotp );
		$this->Cell( $length, 2, $refmotp);

		/*$this->SetXY( $x1, $y1 + 4 );
		$this->SetFont('Arial','',10);
		$length = $this->GetStringWidth( $refmotp );
		//Coordonn�es de la soci�t�
		$lignes = $this->sizeOfText( $refmotp, $length) ;
		$this->MultiCell($length, 4, $refmotp);*/

		$this->SetXY( $x1, $y1 + 22 );
		$this->SetFont('Arial','B',18);
		$length = $this->GetStringWidth( $refmotrb );
		$this->Cell( $length, 2, $refmotrb);

		$this->SetXY( $x1, $y1 + 30 );
		$this->SetFont('Arial','B',18);
		$length = $this->GetStringWidth( $reftel );
		$this->Cell( $length, 2, $reftel);

	}

	function cont_loc( $libelle/*, $num */)
	{
		$r1  = $this->w - 120;
		$r2  = $r1 + 100;
		$y1  = 6;
		$y2  = $y1 + 2;
		$mid = ($r1 + $r2 ) / 2;

		//$texte  = $libelle . " EN " . EURO . " N� : " . $num;
		$texte  = $libelle;
		$szfont = 18;
		$loop   = 0;

		while ( $loop == 0 )
		{
			$this->SetFont( "Arial", "B", $szfont );
			$sz = $this->GetStringWidth( $texte );
			if ( ($r1+$sz) > $r2 )
				$szfont --;
			else
				$loop ++;
		}

		$this->SetLineWidth(0.1);
		$this->SetFillColor(192);
		$this->RoundedRect($r1, $y1, ($r2 - $r1), 17, 2.5, 'DF');
		$this->SetXY( $r1+1, $y1+2);
		$length = $this->GetStringWidth( $texte );
		$this->SetFont( "Arial", "B", 12 );

		$this->MultiCell($length, 4, $texte,0,"C");

		//$this->Cell($r2-$r1 -1,5, $texte, 0, 0, "C" );
	}

// Label and number of invoice/estimate
function fact_dev( $libelle/*, $num */)
{
    $r1  = $this->w - 80;
    $r2  = $r1 + 68;
    $y1  = 6;
    $y2  = $y1 + 2;
    $mid = ($r1 + $r2 ) / 2;
    
    //$texte  = $libelle . " EN " . EURO . " N� : " . $num;
	$texte  = $libelle;
	$szfont = 12;
    $loop   = 0;
    
    while ( $loop == 0 )
    {
       $this->SetFont( "Arial", "B", $szfont );
       $sz = $this->GetStringWidth( $texte );
       if ( ($r1+$sz) > $r2 )
          $szfont --;
       else
          $loop ++;
    }

    $this->SetLineWidth(0.1);
    $this->SetFillColor(192);
    $this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 2.5, 'DF');
    $this->SetXY( $r1+1, $y1+2);
    $this->Cell($r2-$r1 -1,5, $texte, 0, 0, "C" );
}

// Estimate
function addDevis( $numdev )
{
	$string = sprintf("DEV%04d",$numdev);
	$this->fact_dev( "Devis", $string );
}

// Invoice
function addFacture( $numfact )
{
	$string = sprintf("FA%04d",$numfact);
	$this->fact_dev( "Facture", $string );
}

function addDate( $date )
{
	$r1  = $this->w - 41;
	$r2  = $r1 + 30;
	$y1  = 17;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Arial", "B", 10);
	$this->Cell(10,5, "DATE", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+9 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$date, 0,0, "C");
}


	function addEtat( $date )
	{
		$r1  = $this->w - 80;
		$r2  = $r1 + 30;
		$y1  = 17;
		$y2  = $y1 ;
		$mid = $y1 + ($y2 / 2);
		$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
		$this->Line( $r1, $mid, $r2, $mid);
		$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
		$this->SetFont( "Arial", "B", 10);
		$this->Cell(10,5, "ETAT DU LIT", 0, 0, "C");
		$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+9 );
		$this->SetFont( "Arial", "", 10);
		$this->Cell(10,5,$date, 0,0, "C");
	}


	function addClient( $ref )
{
	$r1  = $this->w - 31;
	$r2  = $r1 + 19;
	$y1  = 17;
	$y2  = $y1;
	$mid = $y1 + ($y2 / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Arial", "B", 10);
	$this->Cell(10,5, "CLIENT", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$ref, 0,0, "C");
}

function addPageNumber( $page )
{
	$r1  = $this->w - 80;
	$r2  = $r1 + 19;
	$y1  = 17;
	$y2  = $y1;
	$mid = $y1 + ($y2 / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 3.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Arial", "B", 10);
	$this->Cell(10,5, "PAGE", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1 + 9 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$page, 0,0, "C");
}

// Client address
function addbenificiaire( $adresse )
{

	$r1  = $this->w - 94;
	$r2  = $r1 + 85;
	$y1  = 45;
	$y2  = $y1;

	$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 1, 'D');
	$this->Line( $r1, 53, $r2, 53);

	$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
	$this->SetFont( "Arial", "B", 12);
	$this->Cell(10,5, "BENEFICIAIRE:", 0, 0, "C");
	$this->SetXY( $r1  +2, $y1 + 9 );
	$this->SetFont( "Arial", "", 12);
	//$this->Cell(10,5,$ref, 0,0, "C");
	$this->MultiCell( 70, 7, $adresse);
	/*$r1     = $this->w - 80;
	$r2     = $r1 + 68;
	$y1     = 40;
	$this->SetXY( $r1, $y1);
	$this->MultiCell( 60, 4, $adresse);*/
}


	function addClientAdresse( $adresse )
	{

		$r1  = $this->w - 200;
		$r2  = $r1 + 105;
		$y1  = 45;
		$y2  = $y1+8;

		$this->RoundedRect($r1, $y1, ($r2 - $r1), $y2, 1, 'D');

//		$this->SetXY( $r1 + ($r2-$r1)/2 - 5, $y1+3 );
		$this->SetXY( $r1  +2, $y1 + 2 );
		$this->SetFont( "Arial", "", 12);
		//$this->Cell(10,5,$ref, 0,0, "C");
		$this->MultiCell( 70, 7, $adresse);
		/*$r1     = $this->w - 80;
        $r2     = $r1 + 68;
        $y1     = 40;
        $this->SetXY( $r1, $y1);
        $this->MultiCell( 60, 4, $adresse);*/
	}



	function totalettctva( $total_htva,$total_tva,$total_ttc,$total_caution )
	{

		$r1  = $this->w - 50;
		$r2  = $r1 + 40;
		$y1  = 218.2;

		$this->RoundedRect($r1, $y1, ($r2 - $r1), 8.5, 1, 'D');

		$this->SetXY( $r1  -27, $y1 + 0.2 );
		$this->SetFont( "Arial", "B", 11);
		$this->Cell(25,6,"TOTAL HTVA", 0,0, "C");

		$this->SetXY( $r1  +2, $y1 + 2 );
		$this->SetFont( "Arial", "", 12);
		$this->Cell(25,6,number_format($total_htva, 3), 0,0, "C");
//-------------------------------------------------------------------
		$this->RoundedRect($r1, $y1+10.2, ($r2 - $r1), 8.5, 1, 'D');

		$this->SetXY( $r1  -25, $y1 + 12.2 );
		$this->SetFont( "Arial", "B", 11);
		$this->Cell(25,6,"TVA 18%", 0,0, "C");

		$this->SetXY( $r1  +2, $y1 + 12.2 );
		$this->SetFont( "Arial", "", 12);
		$this->Cell(25,6,number_format($total_tva, 3), 0,0, "C");
		//-------------------------------------------------------------------
		$this->RoundedRect($r1, $y1+22, ($r2 - $r1), 10, 1, 'D');

		$this->SetXY( $r1  -26, $y1 + 24 );
		$this->SetFont( "Arial", "B", 11);
		$this->Cell(25,6,"TOTAL TTC", 0,0, "C");

		$this->SetXY( $r1  +2, $y1 + 24 );
		$this->SetFont( "Arial", "", 12);
		$this->Cell(25,6,number_format($total_ttc, 3), 0,0, "C");

		//-------------------------------------------------------------------
		$this->RoundedRect($r1-5, $y1+41.6, ($r2 - $r1)+5, 9, 1, 'D');

		$this->SetXY( $r1 +5 , $y1 + 35.5 );
		$this->SetFont( "Arial", "B", 11);
		$this->Cell(25,6,"TOTAL CAUTION", 0,0, "C");

		$this->SetXY( $r1  +3.5, $y1 + 43.5 );
		$this->SetFont( "Arial", "", 12);
		$this->Cell(25,6,number_format($total_caution, 3), 0,0, "C");
		//-------------------------------------------------------------------



	}

	function Accompte($accompte)
	{
		$r1  = $this->w - 50;
		$r2  = $r1 + 40;
		$y1  = 218.2;


		$this->RoundedRect($r1-150, $y1, ($r2 - $r1), 23, 1, 'D');
		$this->Line( $r1-150, $y1+6, $r2-150, $y1+6);

		$this->SetXY( $r1 + ($r2-$r1)/2 - 156, $y1+1 );
		$this->SetFont( "Arial", "", 10);
		$this->Cell(10,5, "ACOMPTE", 0, 0, "C");

		$this->SetXY( $r1 + ($r2-$r1)/2 - 162, $y1+11 );
		$this->SetFont( "Arial", "", 12);
		$this->Cell(25,6,number_format($accompte, 3)." DT", 0,0, "C");



	}

	function transport()
	{
		$r1  = $this->w - 50;
		$r2  = $r1 + 77;
		$y1  = 218.2;


		$this->RoundedRect($r1-108, $y1, ($r2 - $r1), 23, 1, 'D');
		$this->Line( $r1-108, $y1+6, $r2-108, $y1+6);

		$this->SetXY( $r1 + ($r2-$r1)/2 - 113, $y1+1 );
		$this->SetFont( "Arial", "", 10);
		$this->Cell(10,5, "TRANSPORT", 0, 0, "C");




	}








	function contratenttelettre($numttcattelettre)
	{
		$r1  = $this->w - 50;
		$r2  = $r1 + 119;
		$y1  = 218.2;


		$this->RoundedRect($r1-150, $y1+26, ($r2 - $r1), 22, 1, 'D');
		$this->Line( $r1-150, $y1+31, $r2-150, $y1+31);

		$this->SetXY( $r1 + ($r2-$r1)/2 - 148, $y1+26 );
		$this->SetFont( "Arial", "I", 9);
		$this->Cell(10,5, "Le present contrat est conclu pour la somme de :", 0, 0, "R");

		$this->SetFont( "Arial", "", 10);
		$this->SetXY( $r1 + ($r2-$r1)/2 - 205  , $y1 + 34);

		//$this->Cell(18,4.8,"Ce contrat est lu et approuve.\nFait en double examplaires,a :", 0,0, "C");
		$this->MultiCell( 108, 6, "$numttcattelettre");



	}

// Mode of payment
function addReglement( $mode )
{
	$r1  = 10;
	$r2  = $r1 + 60;
	$y1  = 80;
	$y2  = $y1+10;
	$mid = $y1 + (($y2-$y1) / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2-$r1)/2 -5 , $y1+1 );
	$this->SetFont( "Arial", "B", 10);
	$this->Cell(10,4, "MODE DE REGLEMENT", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 -5 , $y1 + 5 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$mode, 0,0, "C");
}

// Expiry date
function addEcheance( $date )
{
	$r1  = 80;
	$r2  = $r1 + 40;
	$y1  = 80;
	$y2  = $y1+10;
	$mid = $y1 + (($y2-$y1) / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + ($r2 - $r1)/2 - 5 , $y1+1 );
	$this->SetFont( "Arial", "B", 10);
	$this->Cell(10,4, "DATE D'ECHEANCE", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 - 5 , $y1 + 5 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$date, 0,0, "C");
}

// VAT number
function addNumTVA($tva)
{
	$this->SetFont( "Arial", "B", 10);
	$r1  = $this->w - 80;
	$r2  = $r1 + 70;
	$y1  = 80;
	$y2  = $y1+10;
	$mid = $y1 + (($y2-$y1) / 2);
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $mid, $r2, $mid);
	$this->SetXY( $r1 + 16 , $y1+1 );
	$this->Cell(40, 4, "TVA Intracommunautaire", '', '', "C");
	$this->SetFont( "Arial", "", 10);
	$this->SetXY( $r1 + 16 , $y1+5 );
	$this->Cell(40, 5, $tva, '', '', "C");
}

function addReference($ref)
{
	$this->SetFont( "Arial", "", 10);
	$length = $this->GetStringWidth( "R�f�rences : " . $ref );
	$r1  = 10;
	$r2  = $r1 + $length;
	$y1  = 92;
	$y2  = $y1+5;
	$this->SetXY( $r1 , $y1 );
	$this->Cell($length,4, "R�f�rences : " . $ref);
}


	function addCols2( $tab )
	{
		global $colonnes;

		$r1  = 10;
		$r2  = $this->w - ($r1 * 2) ;
		$y1  = 100;
		$y2  = $this->h - 80 - $y1;
		$this->SetXY( $r1, $y1 );
		$this->Rect( $r1, $y1, $r2, $y2, "D");
		$this->Line( $r1, $y1+6, $r1+$r2, $y1+6);
		$colX = $r1;
		$colonnes = $tab;
		while ( list( $lib, $pos ) = each ($tab) )
		{
			$this->SetXY( $colX, $y1+2 );
			$this->Cell( $pos, 1, $lib, 0, 0, "C");
			$colX += $pos;
			$this->Line( $colX, $y1, $colX, $y1+$y2);
		}
	}

function addCols( $tab )
{
	global $colonnes;
	
	$r1  = 10;
	$r2  = $this->w - ($r1 * 2) ;
	$y1  = 100;
	$y2  = $this->h - 50 - $y1;
	$this->SetXY( $r1, $y1 );
	$this->Rect( $r1, $y1, $r2, $y2, "D");
	$this->Line( $r1, $y1+6, $r1+$r2, $y1+6);
	$colX = $r1;
	$colonnes = $tab;
	while ( list( $lib, $pos ) = each ($tab) )
	{
		$this->SetXY( $colX, $y1+2 );
		$this->Cell( $pos, 1, $lib, 0, 0, "C");
		$colX += $pos;
		$this->Line( $colX, $y1, $colX, $y1+$y2);
	}
}

function addLineFormat( $tab )
{
	global $format, $colonnes;
	
	while ( list( $lib, $pos ) = each ($colonnes) )
	{
		if ( isset( $tab["$lib"] ) )
			$format[ $lib ] = $tab["$lib"];
	}
}

function lineVert( $tab )
{
	global $colonnes;

	reset( $colonnes );
	$maxSize=0;
	while ( list( $lib, $pos ) = each ($colonnes) )
	{
		$texte = $tab[ $lib ];
		$longCell  = $pos -2;
		$size = $this->sizeOfText( $texte, $longCell );
		if ($size > $maxSize)
			$maxSize = $size;
	}
	return $maxSize;
}

// add a line to the invoice/estimate
/*    $ligne = array( "REFERENCE"    => $prod["ref"],
                      "DESIGNATION"  => $libelle,
                      "QUANTITE"     => sprintf( "%.2F", $prod["qte"]) ,
                      "P.U. HT"      => sprintf( "%.2F", $prod["px_unit"]),
                      "MONTANT H.T." => sprintf ( "%.2F", $prod["qte"] * $prod["px_unit"]) ,
                      "TVA"          => $prod["tva"] );
*/
function addLine( $ligne, $tab )
{
	global $colonnes, $format;

	$ordonnee     = 10;
	$maxSize      = $ligne;
	$this->SetFont( "Arial", "", 14.2);

	reset( $colonnes );
	while ( list( $lib, $pos ) = each ($colonnes) )
	{
		$longCell  = $pos -2;
		$texte     = $tab[ $lib ];
		$length    = $this->GetStringWidth( $texte );
		$tailleTexte = $this->sizeOfText( $texte, $length );
		$formText  = $format[ $lib ];
		$this->SetXY( $ordonnee, $ligne-1);
		$this->MultiCell( $longCell, 4 , $texte, 0, $formText);
		if ( $maxSize < ($this->GetY()  ) )
			$maxSize = $this->GetY() ;
		$ordonnee += $pos;
	}
	return ( $maxSize - $ligne );
}

function addRemarque($remarque)
{
	$this->SetFont( "Arial", "", 10);
	$length = $this->GetStringWidth( "Remarque : " . $remarque );
	$r1  = 10;
	$r2  = $r1 + $length;
	$y1  = $this->h - 45.5;
	$y2  = $y1+5;
	$this->SetXY( $r1 , $y1 );
	$this->Cell($length,4, "Remarque : " . $remarque);
}

function addCadreTVAs()
{
	$this->SetFont( "Arial", "B", 8);
	$r1  = 10;
	$r2  = $r1 + 120;
	$y1  = $this->h - 40;
	$y2  = $y1+20;
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1, $y1+4, $r2, $y1+4);
	$this->Line( $r1+5,  $y1+4, $r1+5, $y2); // avant BASES HT
	$this->Line( $r1+27, $y1, $r1+27, $y2);  // avant REMISE
	$this->Line( $r1+43, $y1, $r1+43, $y2);  // avant MT TVA
	$this->Line( $r1+63, $y1, $r1+63, $y2);  // avant % TVA
	$this->Line( $r1+75, $y1, $r1+75, $y2);  // avant PORT
	$this->Line( $r1+91, $y1, $r1+91, $y2);  // avant TOTAUX
	$this->SetXY( $r1+9, $y1);
	$this->Cell(10,4, "BASES HT");
	$this->SetX( $r1+29 );
	$this->Cell(10,4, "REMISE");
	$this->SetX( $r1+48 );
	$this->Cell(10,4, "MT TVA");
	$this->SetX( $r1+63 );
	$this->Cell(10,4, "% TVA");
	$this->SetX( $r1+78 );
	$this->Cell(10,4, "PORT");
	$this->SetX( $r1+100 );
	$this->Cell(10,4, "TOTAUX");
	$this->SetFont( "Arial", "B", 6);
	$this->SetXY( $r1+93, $y2 - 8 );
	$this->Cell(6,0, "H.T.   :");
	$this->SetXY( $r1+93, $y2 - 3 );
	$this->Cell(6,0, "T.V.A. :");
}


	function addsignature()
	{
		$r1  = $this->w - 160;
		$r2  = $r1 + 150;
		$y1  = $this->h - 40;
		$y2  = $y1+30;
		$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
		$this->Line( $r1+20,  $y1, $r1+20, $y2); // avant EUROS
		$this->Line( $r1+20, $y1+12, $r2, $y1+12); // Sous Euros & Francs
		$this->Line( $r1+60,  $y1, $r1+60, $y2); // Entre Euros & Francs
		$this->Line( $r1+100,  $y1, $r1+100, $y2); // Entre Euros & Francs

		$this->SetFont( "Arial", "B", 9);
		$this->SetXY( $r1+32, $y1 );
		$this->Cell(15,4, "Nom Magasignier:", 0, 0, "C");
		$this->SetFont( "Arial", "B", 9);
		$this->SetXY( $r1+72, $y1 );
		$this->Cell(15,4, "Nom Verificateur:", 0, 0, "C");

		$this->SetFont( "Arial", "B", 9);
		$this->SetXY( $r1+116, $y1 );
		$this->Cell(15,4, "Nom Responsable:", 0, 0, "C");


		$this->SetFont( "Arial", "B", 8);

		$this->SetXY( $r1, $y1+5 );
		//$this->Cell(20,4, "TOTAL TTC", 0, 0, "C");
		$this->SetXY( $r1, $y1+11 );
		$this->Cell(20,8, "Signatures", 0, 0, "C");
		$this->SetXY( $r1, $y1+15 );
		//$this->Cell(20,4, "NET A PAYER", 0, 0, "C");
	}



function addCadreEurosFrancs()
{
	$r1  = $this->w - 70;
	$r2  = $r1 + 60;
	$y1  = $this->h - 40;
	$y2  = $y1+20;
	$this->RoundedRect($r1, $y1, ($r2 - $r1), ($y2-$y1), 2.5, 'D');
	$this->Line( $r1+20,  $y1, $r1+20, $y2); // avant EUROS
	$this->Line( $r1+20, $y1+4, $r2, $y1+4); // Sous Euros & Francs
	$this->Line( $r1+38,  $y1, $r1+38, $y2); // Entre Euros & Francs
	$this->SetFont( "Arial", "B", 8);
	$this->SetXY( $r1+22, $y1 );
	$this->Cell(15,4, "EUROS", 0, 0, "C");
	$this->SetFont( "Arial", "", 8);
	$this->SetXY( $r1+42, $y1 );
	$this->Cell(15,4, "FRANCS", 0, 0, "C");
	$this->SetFont( "Arial", "B", 6);
	$this->SetXY( $r1, $y1+5 );
	$this->Cell(20,4, "TOTAL TTC", 0, 0, "C");
	$this->SetXY( $r1, $y1+10 );
	$this->Cell(20,4, "ACOMPTE", 0, 0, "C");
	$this->SetXY( $r1, $y1+15 );
	$this->Cell(20,4, "NET A PAYER", 0, 0, "C");
}

// remplit les cadres TVA / Totaux et la remarque
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
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
function addTVAs( $params, $tab_tva, $invoice )
{
	$this->SetFont('Arial','',8);
	
	reset ($invoice);
	$px = array();
	while ( list( $k, $prod) = each( $invoice ) )
	{
		$tva = $prod["tva"];
		@ $px[$tva] += $prod["qte"] * $prod["px_unit"];
	}

	$prix     = array();
	$totalHT  = 0;
	$totalTTC = 0;
	$totalTVA = 0;
	$y = 261;
	reset ($px);
	natsort( $px );
	while ( list($code_tva, $articleHT) = each( $px ) )
	{
		$tva = $tab_tva[$code_tva];
		$this->SetXY(17, $y);
		$this->Cell( 19,4, sprintf("%0.2F", $articleHT),'', '','R' );
		if ( $params["RemiseGlobale"]==1 )
		{
			if ( $params["remise_tva"] == $code_tva )
			{
				$this->SetXY( 37.5, $y );
				if ($params["remise"] > 0 )
				{
					if ( is_int( $params["remise"] ) )
						$l_remise = $param["remise"];
					else
						$l_remise = sprintf ("%0.2F", $params["remise"]);
					$this->Cell( 14.5,4, $l_remise, '', '', 'R' );
					$articleHT -= $params["remise"];
				}
				else if ( $params["remise_percent"] > 0 )
				{
					$rp = $params["remise_percent"];
					if ( $rp > 1 )
						$rp /= 100;
					$rabais = $articleHT * $rp;
					$articleHT -= $rabais;
					if ( is_int($rabais) )
						$l_remise = $rabais;
					else
						$l_remise = sprintf ("%0.2F", $rabais);
					$this->Cell( 14.5,4, $l_remise, '', '', 'R' );
				}
				else
					$this->Cell( 14.5,4, "ErrorRem", '', '', 'R' );
			}
		}
		$totalHT += $articleHT;
		$totalTTC += $articleHT * ( 1 + $tva/100 );
		$tmp_tva = $articleHT * $tva/100;
		$a_tva[ $code_tva ] = $tmp_tva;
		$totalTVA += $tmp_tva;
		$this->SetXY(11, $y);
		$this->Cell( 5,4, $code_tva);
		$this->SetXY(53, $y);
		$this->Cell( 19,4, sprintf("%0.2F",$tmp_tva),'', '' ,'R');
		$this->SetXY(74, $y);
		$this->Cell( 10,4, sprintf("%0.2F",$tva) ,'', '', 'R');
		$y+=4;
	}

	if ( $params["FraisPort"] == 1 )
	{
		if ( $params["portTTC"] > 0 )
		{
			$pTTC = sprintf("%0.2F", $params["portTTC"]);
			$pHT  = sprintf("%0.2F", $pTTC / 1.196);
			$pTVA = sprintf("%0.2F", $pHT * 0.196);
			$this->SetFont('Arial','',6);
			$this->SetXY(85, 261 );
			$this->Cell( 6 ,4, "HT : ", '', '', '');
			$this->SetXY(92, 261 );
			$this->Cell( 9 ,4, $pHT, '', '', 'R');
			$this->SetXY(85, 265 );
			$this->Cell( 6 ,4, "TVA : ", '', '', '');
			$this->SetXY(92, 265 );
			$this->Cell( 9 ,4, $pTVA, '', '', 'R');
			$this->SetXY(85, 269 );
			$this->Cell( 6 ,4, "TTC : ", '', '', '');
			$this->SetXY(92, 269 );
			$this->Cell( 9 ,4, $pTTC, '', '', 'R');
			$this->SetFont('Arial','',8);
			$totalHT += $pHT;
			$totalTVA += $pTVA;
			$totalTTC += $pTTC;
		}
		else if ( $params["portHT"] > 0 )
		{
			$pHT  = sprintf("%0.2F", $params["portHT"]);
			$pTVA = sprintf("%0.2F", $params["portTVA"] * $pHT / 100 );
			$pTTC = sprintf("%0.2F", $pHT + $pTVA);
			$this->SetFont('Arial','',6);
			$this->SetXY(85, 261 );
			$this->Cell( 6 ,4, "HT : ", '', '', '');
			$this->SetXY(92, 261 );
			$this->Cell( 9 ,4, $pHT, '', '', 'R');
			$this->SetXY(85, 265 );
			$this->Cell( 6 ,4, "TVA : ", '', '', '');
			$this->SetXY(92, 265 );
			$this->Cell( 9 ,4, $pTVA, '', '', 'R');
			$this->SetXY(85, 269 );
			$this->Cell( 6 ,4, "TTC : ", '', '', '');
			$this->SetXY(92, 269 );
			$this->Cell( 9 ,4, $pTTC, '', '', 'R');
			$this->SetFont('Arial','',8);
			$totalHT += $pHT;
			$totalTVA += $pTVA;
			$totalTTC += $pTTC;
		}
	}

	$this->SetXY(114,266.4);
	$this->Cell(15,4, sprintf("%0.2F", $totalHT), '', '', 'R' );
	$this->SetXY(114,271.4);
	$this->Cell(15,4, sprintf("%0.2F", $totalTVA), '', '', 'R' );

	$params["totalHT"] = $totalHT;
	$params["TVA"] = $totalTVA;
	$accompteTTC=0;
	if ( $params["AccompteExige"] == 1 )
	{
		if ( $params["accompte"] > 0 )
		{
			$accompteTTC=sprintf ("%.2F", $params["accompte"]);
			if ( strlen ($params["Remarque"]) == 0 )
				$this->addRemarque( "Accompte de $accompteTTC Euros exig� � la commande.");
			else
				$this->addRemarque( $params["Remarque"] );
		}
		else if ( $params["accompte_percent"] > 0 )
		{
			$percent = $params["accompte_percent"];
			if ( $percent > 1 )
				$percent /= 100;
			$accompteTTC=sprintf("%.2F", $totalTTC * $percent);
			$percent100 = $percent * 100;
			if ( strlen ($params["Remarque"]) == 0 )
				$this->addRemarque( "Accompte de $percent100 % (soit $accompteTTC Euros) exig� � la commande." );
			else
				$this->addRemarque( $params["Remarque"] );
		}
		else
			$this->addRemarque( "Dr�le d'acompte !!! " . $params["Remarque"]);
	}
	else
	{
		if ( strlen ($params["Remarque"]) > 0 )
			$this->addRemarque( $params["Remarque"] );
	}
	$re  = $this->w - 50;
	$rf  = $this->w - 29;
	$y1  = $this->h - 40;
	$this->SetFont( "Arial", "", 8);
	$this->SetXY( $re, $y1+5 );
	$this->Cell( 17,4, sprintf("%0.2F", $totalTTC), '', '', 'R');
	$this->SetXY( $re, $y1+10 );
	$this->Cell( 17,4, sprintf("%0.2F", $accompteTTC), '', '', 'R');
	$this->SetXY( $re, $y1+14.8 );
	$this->Cell( 17,4, sprintf("%0.2F", $totalTTC - $accompteTTC), '', '', 'R');
	$this->SetXY( $rf, $y1+5 );
	$this->Cell( 17,4, sprintf("%0.2F", $totalTTC * EURO_VAL), '', '', 'R');
	$this->SetXY( $rf, $y1+10 );
	$this->Cell( 17,4, sprintf("%0.2F", $accompteTTC * EURO_VAL), '', '', 'R');
	$this->SetXY( $rf, $y1+14.8 );
	$this->Cell( 17,4, sprintf("%0.2F", ($totalTTC - $accompteTTC) * EURO_VAL), '', '', 'R');
}

// add a watermark (temporary estimate, DUPLICATA...)
// call this method first
function temporaire( $texte )
{
	$this->SetFont('Arial','B',50);
	$this->SetTextColor(203,203,203);
	$this->Rotate(45,55,190);
	$this->Text(55,190,$texte);
	$this->Rotate(0);
	$this->SetTextColor(0,0,0);
}

}
?>
