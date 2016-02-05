<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
//

session_start();
if(!isset($_SESSION['admin']))
{
    header("location:login.html");
}

?>
<?php extract($_POST);
$id=$_GET['id'];
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$gsm_client="";
$req1="SELECT * FROM `commande` WHERE `id`=$id; ";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch()) {
    $id_commande = $row->id;
    $ref = $row->ref;
    $nom_client = $row->nom_client;
    $date_commande1 = $row->date_commande;
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
    $acompte = $row->acompte;
    $transport= $row->prix_transport;

    $date_commande=date("d-m-Y", strtotime($date_commande1));
    $DateDebut=date("d-m-Y", strtotime($date_commande));



}
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>MEDICA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.jpg">


</head>
<body>

<div class="row">
    <div class="col-md-2"><label>N°</label><input type="text" name="ref" class="form-control" value="<?php echo $ref; ?>" disabled></div>
    <div class="col-md-2"><label>Date creation</label><input type="text" name="date_commande" class="form-control" value="<?php echo $date_commande ?>" disabled></div>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Détails contrat</h2>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <div class="row">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <th colspan="2">Cordonnées du client</th>
                                </tr>
                                <tr>
                                    <td colspan="2">Nom:&nbsp;<?php echo $nom_client;?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Adresse:&nbsp;<?php echo $adresse_client;?></td>
                                </tr>
                                <tr>
                                    <td>Tel:&nbsp;<?php echo $tel_client;?></td>
                                    <td>GSM:&nbsp;<?php echo $gsm_client;?></td>
                                </tr>
                                <tr>
                                    <td>CIN N°:&nbsp;<?php echo $cin_client;?></td>
                                    <td>Tunis le:&nbsp;<?php echo $date_cin;?></td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <th colspan="2">Cordonnées du beneficiare</th>
                                </tr>
                                <tr>
                                    <td >Nom:&nbsp;<?php echo $nom_ben;?></td>
                                </tr>
                                <tr>
                                    <td >Adresse:&nbsp;<?php echo $adresse_ben;?></td>
                                </tr>
                                <tr>
                                    <td>Tel:&nbsp;<?php echo $tel_ben;?></td>
                                </tr>
                                <tr>
                                    <td>CIN N°:&nbsp;<?php echo $cin_ben;?></td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title">Liste des produits séléctionnés</h2>
                        </div>
                        <div class="panel-body">


                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                    <tr>
                                        <th style="width:40%;">Produit</th>
                                        <th style="width:15%;">Période</th>
                                        <th style="width:20%;">Date Fin</th>
                                        <th style="width:10%;">Qte</th>
                                        <th style="width:20%;">P.U HTVA</th>
                                        <th style="width:15%;">Montant</th>
                                        <th style="width:15%;">Caution/Unité</th>
                                        <th style="width:13%;">Etat</th>
                                        <th style="width:9%;">Retour.Produit</th>

                                    </tr>
                                    </thead>
                                    <?php
                                    $req2="select * from ligne_commande where id_commande =$id";
                                    $oPDOStatements2=$connect->query($req2); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                    $oPDOStatements2->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                                    while ($data=$oPDOStatements2->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                    {
                                        $id=$data['id'];
                                        $id_produit = $data['id_produit'];
                                        $id_lit = $data['id_lit'];
                                        $prix_unit_s = $data['prix_unit_s'];
                                        $prix_unit_m = $data['prix_unit_m'];
                                        $qte = $data['qte'];
                                        $semaine = $data['semaine'];
                                        $mois = $data['mois'];
                                        $prix_caution = $data['prix_caution'];
                                        $etat_louer=$data['etat_louer'];

                                        $prix_unit=($prix_unit_s*$semaine+$prix_unit_m*$mois);
                                        $prix_total=$qte*$prix_unit;
                                        $jours=$semaine*7;
                                        $DateFin = date('d-m-Y', strtotime($DateDebut.' +'.$jours.' days'));
                                        $DateFin = date('d-m-Y', strtotime($DateFin.' +'.$mois.' month'));
                                        $date = date("d-m-Y");

                                    $req3="select * from produit where id =$id_produit";
                                    $oPDOStatements3=$connect->query($req3); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                    $oPDOStatements3->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                                    while ($data3=$oPDOStatements3->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                    {
                                        $idd=$data3['id'];
                                        $type=$data3['type'];
                                        ?>

                                        <tr <?php if (($date >= $DateFin)&&($etat_louer==1)){ echo "style='color: #ff0000'"; } ?> >
                                        <?php

                                            echo "<td>".$data3['nom'];
                                        if ($type==1) {
                                            $req1="SELECT ref_lit FROM `lit` WHERE id=$id_lit";
                                            $oPDOStatement1=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
                                            $oPDOStatement1->setFetchMode(PDO::FETCH_ASSOC);;
                                            while ($row=$oPDOStatement1->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                            {
                                                $ref_lit=$row['ref_lit'];
                                            }
                                            if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
                                            elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}
                                            echo"<br><b>Ref: &nbsp;</b>MM2-L".$ref_lit."-S";}
                                        echo "</td>

                                          <td>";if ($semaine!=0) {echo $semaine." Semaine <br>";}
                                        if ($mois!=0) {echo $mois." Mois";}
                                        echo "</td>
                                          <td>".$DateFin."</td>
                                          <td>".$qte."</td>
                                          <td>";if ($semaine!=0) {echo $prix_unit_s." DT/S <br>";}
                                        if ($mois!=0) {echo $prix_unit_m." DT/M";}

                                        echo "</td>
                                          <td>".$prix_total."DT</td>
                                          <td>".$prix_caution."DT</td>";
                                        }

                                        if ($etat_louer==1) {
                                                echo '<td class="center-text">
                                                    <span class="label-success label label-default">EN COURS</span>
                                                </td>';
                                               }
                                         elseif ($etat_louer==0) {
                                                echo '<td class="center-text">
                                                <span class="label-default label"">FINI</span>
                                                </td>';
                                                }
                                         ?>
                                        <td>
                                        <?php
                                                if ($etat_louer!=0) { ?>
                                                <a class="btn btn-danger" href='retour_produit.php?id=<?php echo $id; ?>' onclick="return(confirm('Etes-vous sûr que le produit est retourné en stock?'))"; >
                                                    <i class="glyphicon glyphicon-download-alt"></i>
                                                    Retour
                                                </a>
                                            </td></tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </table>
                            </div>
                        </div>



                    </div>

                    <?php

                    echo "
                            <div class='row'>
                            <div class='col-md-8'>

                            <div class='row'>
                            <div class='col-md-1'></div>
                            <div class='col-md-2' align='center'>
                            <b>ACOMPTE</b><br>".$acompte."&nbsp; DT
                            </div>
                            <div class='col-md-1'></div>
                            <div class='col-md-2' align='center'>
                            <b>TRANSPORT</b><br>".$transport."&nbsp; DT
                            </div>
                            </div>

                            </div>
                            <div class='col-md-4' align='right'><div class='form-inline'> <b>TOTAL HTVA</b> &nbsp;<input type='text' class='form-control' value='".$total_htva."&nbsp Dt' disabled><br>
                             <b>TVA 18%</b> &nbsp;<input type='text' class='form-control'value='".$total_tva."&nbsp Dt' disabled><br>
                             <b>TOTAL TTC </b>&nbsp;<input type='text' class='form-control' value='".$total_ttc."&nbsp Dt' disabled><br><br>
                             <b>TOTAL CAUTION</b> &nbsp;<input type='text' class='form-control' value='".$total_caution."&nbsp Dt' disabled></div></div>
                            </div>";

                    ?>


                    <div class="row">
                        <div class="col-md-2"></div>
                        <a href="contrat_pdf.php?id=<?php echo $id_commande;?>" class="btn btn-info btn-lg">
                            <i class="glyphicon glyphicon-print"></i> IMPRIMER</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->

<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>



</body>
</html>