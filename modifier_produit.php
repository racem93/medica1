<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:login.html");
}

?>

<?php
//début la modification du lit
if (isset($_POST["produit"])){
    $qte=0;
    extract($_POST);
    include_once("config/MyPDO.class.php");
    $connect=new MyPDO();

    $msg1="";$a=0;
    $msg2="";$b=0;
    $msg3="";$c=0;
    $msg4="";$d=0;
    $msg5="";$e=0;
    $msg6="";$f=0;

    if(!preg_match('/^[[:digit:]]+((\.[[:digit:]]{1,3})?)$/',$semaine))
    { $msg2='Le PRIX du semaine n est pas valide \n';
        $b=1;

    }
    if(!preg_match('/^[[:digit:]]+((\.[[:digit:]]{1,3})?)$/',$mois))
    { $msg6='Le PRIX du mois n est pas valide \n';
        $f=1;

    }

    if(!preg_match('/^[[:digit:]]*$/',$qte))
    { $msg3='La QUANTITE n est pas valide \n' ;
        $c=1;


    }

    if(!preg_match('/^[[:digit:]]+((\.[[:digit:]]{1,3})?)$/',$caution))
    { $msg4='Le CAUTION n est pas valide \n';
        $d=1;

    }

    if(!preg_match('/^[[:digit:]]+$/',$tva_produit))
    { $msg5='La QUANTITE n est pas valide ';
        $e=1;

    }

    if (($b == 1)||($f == 1) ||($c == 1)||($d == 1)||($e == 1)) { ?>
        <SCRIPT LANGUAGE='JavaScript'>
            alert('<?php echo $msg2.$msg6.$msg3.$msg4.$msg5 ?>');
            //location='ajout_lit.php';
            history.go(-1);
        </SCRIPT>
    <?php }

    else {

        $req2 = "UPDATE `produit` SET `ref`='$ref' ,`nom`='$nom' ,`prix_semaine`='$semaine',`prix_mois`='$mois' ,`qte`='$qte',
`caution`='$caution',`tva_produit`='$tva_produit',`type`='$type' WHERE `id`=$id ";
        $oPDOStatement = $connect->query($req2);
        echo "<SCRIPT LANGUAGE='JavaScript'>
self.parent.location.href='gestion_produit.php?msg=modifier';
self.parent.$.fancybox.close();
</SCRIPT> ";
    }
}
?>

<?php
//Début la remplissage des formulaires
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    include_once("config/MyPDO.class.php");
    $connect = new MyPDO();
    $req1 = "SELECT * FROM `produit` WHERE  id= $id";
    $oPDOStatement = $connect->query($req1); // Le résultat est un objet de la classe PDOStatement
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    while ($row = $oPDOStatement->fetch()) {
        $id=$row->id;
        $type=$row->type;
        $nom=$row->nom;
        $ref=$row->ref;
        $semaine=$row->prix_semaine;
        $mois=$row->prix_mois;
        $qte=$row->qte;
        $caution=$row->caution;
        $tva_produit=$row->tva_produit;
    }
}
//Fin la remplissage des formulaires
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
                    <h2><i class="glyphicon glyphicon-edit"></i> Ajout nouveau produit</h2>
                </div>
                <div class="box-content">
                    <div class="control-group">
                        <form role="form" action="modifier_produit.php" method="post" >
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <label>Type de produit: &nbsp &nbsp</label>
                                    <input type="radio" name="type" id="type" value="1" <?php if ($type==1){ echo "checked";} ?> > lit
                                    &nbsp &nbsp &nbsp
                                    <input type="radio" name="type" id="type" value="2" <?php if ($type==2){ echo "checked";} ?>> autres

                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Nom produit </label></div>
                                    <input type="text" name="nom" value="<?php echo $nom; ?>" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom" style="width: 500px;" autofocus required>
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Reférence produit </label></div>
                                    <input type="text" name="ref" value="<?php echo $ref; ?>" class="form-control" id="exampleInputEmail1" placeholder="Entrer la ref"  autofocus required disabled >
                                    <input type="hidden" name="ref"  value="<?php echo $ref; ?>">
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Prix produit: </label></div>
                                    <div class="col-md-3"><input type="text" name="semaine" value="<?php echo $semaine; ?>" class="form-control" id="exampleInputEmail1" style="width: 150px;" placeholder="prix du semaine" autofocus required>&nbsp DT/semaine
                                    </div>

                                    <div class="col-md-3"><input type="text" name="mois" value="<?php echo $mois; ?>" class="form-control" id="exampleInputEmail1" style="width: 150px;" placeholder="prix du mois" autofocus required>&nbsp DT/mois
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-inline" id="qte">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Quantité</label></div>
                                    <input type="text" name="qte" value="<?php echo $qte; ?>" class="form-control" id="qte" placeholder="Entrer la quantité" >
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Caution  </label></div>
                                    <input type="text" name="caution" value="<?php echo $caution; ?>" class="form-control" id="exampleInputEmail1" placeholder="Entrer la caution" autofocus required>&nbsp dt
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >TVA </label></div>
                                    <input type="text" name="tva_produit" value="<?php echo $tva_produit; ?>" class="form-control" id="exampleInputEmail1" placeholder="Entrer la TVA" autofocus required>&nbsp %
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <button type="submit" class="btn btn-primary" name="produit" style="width: 200px" >Modifier</button>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
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
