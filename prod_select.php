<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();

include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
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





<body >
<div class="container">
<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Liste des produits séléctionnés</h2>
                            </div>
 <div class="panel-body">
	<?php 
//On prépare l'utilisation des variables de fonctions (variable qui sont stockées sur le serveur pour chaque session ouverte)

if(!empty($_SESSION['id']))
{
// on extrait les id du caddie
$id_liste=$_SESSION['id'];

// on fait notre requête
/*$req="select id,nom from produit where id IN(".$id_liste.")";
$oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
$oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.*/

$i=0;
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

                        <th >Action</th>

					</tr>
					</thead>

 <?php /*while ($data=$oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
     {
	 $idd=$data['id'];*/
 foreach($id_liste as $i => $val){

     $req="select * from produit where id =$val";
     $oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
     $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
 while ($data=$oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
 {
     $idd=$data['id'];
     $type=$data['type'];
      echo "<tr>
      <td>".$data['nom'];
     if ($type==1) {
         $id_lit=$_SESSION['lit'][$i];
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
      <td>".$_SESSION['panier'][$i]."</td>
      <td>".($_SESSION['prix_s'][$i]*$_SESSION['semaine'][$i]+$_SESSION['prix_m'][$i]*$_SESSION['mois'][$i])."</td>
      <td>";if ($_SESSION['semaine'][$i]!=0) {echo $_SESSION['semaine'][$i]." Semaine <br>";}
            if ($_SESSION['mois'][$i]!=0) {echo $_SESSION['mois'][$i]." Mois";}
      echo "</td>
      <td>".$_SESSION['caution'][$i]."</td>



      <td> <a href='supp_prodfact.php?id=$i' onclick=\"return(confirm('Etes-vous sûr de vouloir supprimer ce produit?'));\"><img src='img/cross.png' ></a> </td>

      </tr>";//Lecture des résultats


	  
}}
?>
                      
</table>
</div>
</div>
<?php } ?>

  
</div>
</div>


<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">




    $(document).ready(function() {
        $("#iframe").fancybox({
            'width'          : '80%',
            'minHeight'   : 450,
            'transitionIn'      : 'elastic',
            'transitionOut'     : 'elastic',
            'type'              : 'iframe'
        });
    });

    $(document).ready(function() {
        /*
         *  Simple image gallery. Uses default settings
         */

        $("input[name=type]:radio").click(function() { // attack a click event on all radio buttons with name 'radiogroup'
            if($(this).val() == '2') {//check which radio button is clicked
                $("#qte").show();
            } else if($(this).val() == '1') {
                $("#qte").hide();
            }
        });

        $("#qte").hide();

        $('.fancybox').fancybox();

        /*
         *  Different effects
         */

        // Change title type, overlay closing speed
        $(".fancybox-effects-a").fancybox({
            helpers: {
                title : {
                    type : 'outside'
                },
                overlay : {
                    speedOut : 0
                }
            }
        });

        // Disable opening and closing animations, change title type
        $(".fancybox-effects-b").fancybox({
            openEffect  : 'none',
            closeEffect : 'none',

            helpers : {
                title : {
                    type : 'over'
                }
            }
        });

        // Set custom style, close if clicked, change title type and overlay color
        $(".fancybox-effects-c").fancybox({
            wrapCSS    : 'fancybox-custom',
            closeClick : true,

            openEffect : 'none',

            helpers : {
                title : {
                    type : 'inside'
                },
                overlay : {
                    css : {
                        'background' : 'rgba(238,238,238,0.85)'
                    }
                }
            }
        });

        // Remove padding, set opening and closing animations, close if clicked and disable overlay
        $(".fancybox-effects-d").fancybox({
            padding: 0,


            openEffect : 'elastic',
            openSpeed  : 150,

            closeEffect : 'elastic',
            closeSpeed  : 150,

            closeClick : true,

            helpers : {
                overlay : null
            }
        });



        /*
         *  Open manually
         */

        $("#fancybox-manual-a").click(function() {
            $.fancybox.open('1_b.jpg');
        });

        $("#fancybox-manual-b").click(function() {
            $.fancybox.open({

                href : 'iframe.html',
                type : 'iframe',
                padding : 5
            });
        });

        $("#fancybox-manual-c").click(function() {
            $.fancybox.open([
                {
                    href : '1_b.jpg',
                    title : 'My title'
                }, {
                    href : '2_b.jpg',
                    title : '2nd title'
                }, {
                    href : '3_b.jpg'
                }
            ], {
                helpers : {
                    thumbs : {
                        width: 75,
                        height: 50
                    }
                }
            });
        });


    });
</script>


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

