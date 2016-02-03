<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:login.html");
}

?>
<?php include 'config.php';
 include_once("config/MyPDO.class.php");
                    $connect=new MyPDO();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
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

    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        }


    </style>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.jpg">


<?php if (isset($_GET["comm"])) {


    echo "<script type='text/javascript'>

        function autoClick() {
            document.getElementById('iframe').click();
        }

    </script>";
}
?>

</head>

<body <?php if (isset($_GET["comm"])) { echo 'onLoad="autoClick();"'; } ?> > <!--onLoad="autoClick();"!-->
<?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar starts -->
<?php if (isset($_GET["comm"])) {
        $id=$_GET["comm"];
        ?>
    <a href="details_contrat.php?id=<?php echo $id; ?>" id="iframe"></a>
    <?php } ?>
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="acceuil.php"> <img alt="MedicA Logo" src="img/logo.jpg" class="hidden-xs" width="20" height="20"/>
                <span>MEDICA </span>SHOP</a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $_SESSION['pseudo'];?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="deconnexion.php">Logout</a></li>
                </ul>


            </div>



            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right ">
                |
                </div>
            <div class="btn-group pull-right ">
            </div>
            <div class="btn-group pull-right theme-container animated tada ">
                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-bell  "></i>
                    <?php
                    $a=0;
                    $req2="select * from ligne_commande where etat_louer =1";
                    $oPDOStatements2=$connect->query($req2); // Le r&eacute;sultat est un objet de la classe PDOStatement
                    $oPDOStatements2->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                    while ($data=$oPDOStatements2->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                    {
                    $id = $data['id'];
                    $id_commande = $data['id_commande'];
                    $id_produit = $data['id_produit'];
                    $semaine = $data['semaine'];
                    $mois = $data['mois'];
                    $jours=$semaine*7;

                    $req3="select ref,date_commande from commande where id =$id_commande";
                    $oPDOStatements3=$connect->query($req3); // Le r&eacute;sultat est un objet de la classe PDOStatement
                    $oPDOStatements3->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                    while ($data3=$oPDOStatements3->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                    {

                    $DateDebut = $data3['date_commande'];
                    $ref=$data3['ref'];
                    $DateFin = date('Y-m-d', strtotime($DateDebut.' +'.$jours.' days'));
                    $DateFin = date('Y-m-d', strtotime($DateFin.' +'.$mois.' month'));
                    $date = date("Y-m-d");

                    if ($date >= $DateFin) {
                        $a++;

                    }
                    }
                    }
                    ?>
                    <span class="notification red"><?php echo $a; ?></span>

                </button>
                <ul class="dropdown-menu" >
                    <?php

                    $req2="select * from ligne_commande where etat_louer =1";
                    $oPDOStatements2=$connect->query($req2); // Le r&eacute;sultat est un objet de la classe PDOStatement
                    $oPDOStatements2->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                    while ($data=$oPDOStatements2->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                    {
                        $id = $data['id'];
                        $id_commande = $data['id_commande'];
                        $id_produit = $data['id_produit'];
                        $semaine = $data['semaine'];
                        $mois = $data['mois'];
                        $jours=$semaine*7;

                    $req3="select ref,date_commande from commande where id =$id_commande";
                    $oPDOStatements3=$connect->query($req3); // Le r&eacute;sultat est un objet de la classe PDOStatement
                    $oPDOStatements3->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                    while ($data3=$oPDOStatements3->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                    {

                        $DateDebut = $data3['date_commande'];
                        $ref=$data3['ref'];
                        $DateFin = date('Y-m-d', strtotime($DateDebut.' +'.$jours.' days'));
                        $DateFin = date('Y-m-d', strtotime($DateFin.' +'.$mois.' month'));
                        $date = date("Y-m-d");

                        if ($date >= $DateFin)
                        {
                            $req4="select nom from produit where id =$id_produit";
                            $oPDOStatements4=$connect->query($req4); // Le r&eacute;sultat est un objet de la classe PDOStatement
                            $oPDOStatements4->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                            while ($data3=$oPDOStatements4->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                            {
                                $nom=$data3['nom'];
                            }
                            //echo '<li class="divider"></li>';
                            echo '<li><a  href="gestion_contrat.php?comm='.$id_commande.'"><i class="glyphicon glyphicon-warning-sign red"></i> La période de la prdouit <b>'.$nom.'</b><br> de la contrat N° <b>'.$ref.'</b> a été terminer <br></a></li>';
                            echo '<li class="divider"></li>';

                        }

                    }

                    }

                    ?>




                </ul>
            </div>

            <!-- theme selector ends -->
            <!--
            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><i class="glyphicon glyphicon-globe"></i> Visit Site</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Dropdown <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li>
                    <form class="navbar-search pull-left">
                        <input placeholder="Search" class="search-query form-control col-md-10" name="query"
                               type="text">
                    </form>
                </li>
            </ul>
            !-->

        </div>
    </div>
    <!-- topbar ends -->
<?php } ?>
<div class="ch-container">
    <div class="row">
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="index.html"><i class="glyphicon glyphicon-home"></i><span> Accueil</span></a>
                        </li>
                        <li class="accordion">
                                                    <a href="#"><i class="glyphicon glyphicon-hdd"></i><span> Gestion des lits</span></a>
                                                    <ul class="nav nav-pills nav-stacked">
                                                        <li><a href="gestion_lit.php">Liste des lits</a></li>
                                                        <li><a href="ajout_lit.php">Ajouter un lit</a></li>
                                                    </ul>
                        </li>
                        <li class="accordion">
                                                       <a href="#"><i class="glyphicon glyphicon-briefcase"></i><span> Gestion des produits</span></a>
                                                       <ul class="nav nav-pills nav-stacked">
                                                          <li><a href="gestion_produit.php">Liste des produits</a></li>
                                                          <li><a href="ajout_produit.php">ajouter un produit</a></li>
                                                       </ul>
                        </li>
                        <li class="accordion">
                                                       <a href="#"><i class="glyphicon glyphicon-list-alt"></i><span> Gestion des contrats</span></a>
                                                       <ul class="nav nav-pills nav-stacked">
                                                          <li><a href="gestion_contrat.php">Liste des contrats</a></li>
                                                          <li><a href="ajout_contrat.php">Ajouter un contrat</a></li>
                                                       </ul>
                        </li>

                       <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php } ?>
