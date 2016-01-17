<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();

?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>Free HTML5 Bootstrap Admin Template</title>
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
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.jpg">




</head>
<body>
<div id="content" class="col-lg-12 col-sm-12">

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
                                        <td colspan="2">Nom:<?php echo"";?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Adresse:<?php echo"";?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel:<?php echo"";?></td>
                                        <td>GSM:<?php echo"";?></td>
                                    </tr>
                                    <tr>
                                        <td>CIN N°:<?php echo"";?></td>
                                        <td>Tunis le:<?php echo"";?></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <th colspan="2">Cordonnées du beneficiare</th>
                                    </tr>
                                    <tr>
                                        <td >Nom:<?php echo"";?></td>
                                    </tr>
                                    <tr>
                                        <td >Adresse:<?php echo"";?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel:<?php echo"";?></td>
                                    </tr>
                                    <tr>
                                        <td>CIN N°:<?php echo"";?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Liste des produits séléctionnés</h2>
                            </div>
                            <div class="panel-body">
                                <?php
                                //On prépare l'utilisation des variables de fonctions (variable qui sont stockées sur le serveur pour chaque session ouverte)
                                //test
                                include_once("config/MyPDO.class.php");
                                $connect=new MyPDO();

                                if(!empty($_SESSION['panier']))
                                {
                                // on extrait les id du caddie
                                $id_liste=implode(',',array_keys($_SESSION['panier']));


                                // on fait notre requête
                                $req="select id,nom from produit where id IN(".$id_liste.")";
                                $oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.


                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" >
                                        <thead>
                                        <tr>
                                            <th style="width:40%;">Produit</th>
                                            <th style="width:15%;">Qte</th>
                                            <th style="width:30%;">Prix HT</th>
                                            <th style="width:15%;">Periode</th>
                                            <th style="width:15%;">Caution</th>



                                        </tr>
                                        </thead>

                                        <?php while ($data=$oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                        {
                                            $idd=$data['id'];

                                            echo "<tr>

      <td>".$data['nom']."</td>
      <td>".$_SESSION['panier'][$idd]."</td>
      <td>".$_SESSION['prix'][$idd]."</td>
      <td>".$_SESSION['periode'][$idd]."</td>
      <td>".$_SESSION['caution'][$idd]."</td>

      </tr>";//Lecture des résultats


                                        }
                                        ?>

                                    </table>
                                </div>
                            </div>
                            <?php } ?>


                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
