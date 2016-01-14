<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
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
$req1="SELECT * FROM `lit` WHERE  id= $id";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch()) {
    $id = $row->id;
    $ref_lit = $row->ref_lit;
    $nom = $row->nom;
    $ref_moteur_p = $row->ref_moteur_p;
    $ref_moteur_s = $row->ref_moteur_s;
    $ref_telecommande = $row->ref_telecommande;
    $etat_base = $row->etat_base;
    $etat_barriere = $row->etat_barriere;
    $etat_panneaux = $row->etat_panneaux;
    $etat_moteur = $row->etat_moteur;
    $etat_variable = $row->etat_variable;
    $etat_releve = $row->etat_releve;
    $etat_telecommande = $row->etat_telecommande;
    $etat_perroquet = $row->etat_perroquet;
    $etat_lit=$row->etat_lit;
    $description= $row->description;

    if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
    elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}

    if ($ref_moteur_p<10) {$ref_moteur_p="00".$ref_moteur_p;}
    elseif (($ref_moteur_p<100)&&($ref_moteur_p>=10)) {$ref_moteur_p="0".$ref_moteur_p;}

    if ($ref_moteur_s<10) {$ref_moteur_s="00".$ref_moteur_s;}
    elseif (($ref_moteur_s<100)&&($ref_moteur_s>=10)) {$ref_moteur_s="0".$ref_moteur_s;}

    if ($ref_telecommande<10) {$ref_telecommande="00".$ref_telecommande;}
    elseif (($ref_telecommande<100)&&($ref_telecommande>=10)) {$ref_telecommande="0".$ref_telecommande;}

}

?>
<html>
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
    <link rel="shortcut icon" href="img/favicon.ico">


</head>
<body>
<div class="box-content">
    <div class="control-group">
        <div class="row">
            <div class="col-md-8"><h2>CONSTRAT LIT DE LOCATION</h2></div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <a data-toggle="tooltip" title="" class="well top-block " >
                    <?php if ($etat_lit==0){
                                            echo'<i class="glyphicon glyphicon-warning-sign red"></i>
                                            <div class="red">EN PANNE</div>';
                                            }
                        elseif ($etat_lit==1) {
                                                echo'<i class="glyphicon glyphicon-thumbs-up green"></i>
                                                <div class="green">EN MARCHE</div>';
                                               }
                    ?>
                </a>
            </div>
        </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><h3 style="display:inline;"><b>MODELE DE LIT:</b></h3></div>
                    <div class="col-md-8"><b><?php echo $nom; ?></b></div>
                </div>
        <br>
    <table class="table table-striped table-bordered responsive" border="">
        <tr>
            <td width="30%" ><h4 style="display:inline;"><b>REF. DU LIT:</b></h4></td>
            <td width="70%" ><h1 style="display:inline;">MM2-L<?php echo $ref_lit; ?>
                    -S</h1></td>
        </tr>
        <tr>
            <td  width="30%""><b>REF. MOTEUR PRINCIPAL:</b></td>
            <td  width="70%" ><h3 style="display:inline;">MM2-L<?php echo $ref_moteur_p; ?>
                    -MP</h3></td>
        </tr>
        <tr>
            <td  width="30%"><b>REF. MOTEUR R-B:</b></td>
            <td  width="70%" ><h3 style="display:inline;">MM2-L<?php echo $ref_moteur_s; ?>
                    -MA</h3></td>
        </tr>
        <tr>
            <td  width="30%"><b>REF. TELECOMMANDE:</b></td>
            <td  width="70%" ><h3 style="display:inline;">MM2-L<?php echo $ref_telecommande; ?>
                    -MC</h3></td>
        </tr>

    </table>
        <div class="center"><h4>_______________________OBSERVATIONS_______________________</h4></div>
        <br>

        <table class="table table-striped table-bordered responsive" border="">
            <tr>
                <td width="30%" >ETAT DE LA BASE DE LIT</td>
                <td width="70%" ><?php echo $etat_base; ?></td>
            </tr>

            <tr>
                <td width="30%" >ETAT DES BARRIERES</td>
                <td width="70%" ><?php echo $etat_barriere; ?></td>
            </tr>

            <tr>
                <td width="30%" >ETAT DES PANNEAUX</td>
                <td width="70%" ><?php echo $etat_panneaux; ?></td>
            </tr>

            <tr>
                <td width="30%" >ETAT MOTEUR CENTRAL</td>
                <td width="70%" ><?php echo $etat_moteur; ?></td>
            </tr>
            <tr>
                <td width="30%" >ETAT HAUT.VARIABLE</td>
                <td width="70%" ><?php echo $etat_variable; ?></td>
            </tr>

            <tr>
                <td width="30%" >ETAT RELEVE BUSTE</td>
                <td width="70%" ><?php echo $etat_releve; ?></td>
            </tr>
            <tr>
                <td width="30%" >ETAT TELECOMMANDE</td>
                <td width="70%" ><?php echo $etat_telecommande; ?></td>
            </tr>

            <tr>
                <td width="30%" >ETAT DU PERROQUET</td>
                <td width="70%" ><?php echo $etat_perroquet; ?></td>
            </tr>

            <tr>
                <td width="30%" >AUTRES ACCESSOIRES/DESCRIPTION</td>
                <td width="70%" ><?php echo $description; ?></td>
            </tr>

        </table>
        <div class="row">
            <div class="col-md-8"></div>
            <a href="lit_pdf.php?modellit=<?php echo $nom; ?>&reflit=<?php echo $ref_lit; ?>&refmoteurpr=<?php echo $ref_moteur_p; ?>&refmoteursec=<?php echo $ref_moteur_s; ?>
&reftelecommande=<?php echo $ref_telecommande; ?>&etatbase=<?php echo $etat_base; ?>&etatbarriere=<?php echo $etat_barriere; ?>
&etatpanneaux=<?php echo $etat_panneaux; ?>&etatmoteur=<?php echo $etat_moteur; ?>&etatvariable=<?php echo $etat_variable; ?>&etatreleve=<?php echo $etat_releve; ?>
&etattelecommande=<?php echo $etat_telecommande; ?>&etatperroquet=<?php echo $etat_perroquet; ?>&description=<?php echo $description; ?>&etatlit=<?php echo $etat_lit; ?>" class="btn btn-info btn-lg">
                <i class="glyphicon glyphicon-print"></i> IMPRIMER</a>
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