
<?php
/**
 * Created by PhpStorm.
 * User: Racem
 * Date: 16/01/2016
 * Time: 16:24
 */

$id_prod=$_GET["id"];
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
?>
<?php extract($_POST);
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
$req1="SELECT * FROM `produit` WHERE `id`=$id_prod ";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch()) {
    $id = $row->id;
    $nom = $row->nom;
    $ref = $row->ref;
    $prix_semaine = $row->prix_semaine;
    $prix_mois = $row->prix_mois;
    $qte = $row->qte;
    $qte_louer = $row->qte_louer;
    $caution = $row->caution;
    $tva_produit = $row->tva_produit;
    $type = $row->type;
}if ($type==1){
$req2="SELECT COUNT(`id`) AS qte_stock FROM `lit` WHERE `nom`=$id AND `etat_lit`=1 AND `etat_louer`!=1 ";
$oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);
while ($row2 = $oPDOStatement2->fetch()) {
    $qte_stock = $row2->qte_stock;
}}
else {
    $qte_stock = $qte - $qte_louer;
}
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






<div class="list-group">
    <b class="list-group-item"> Reference : <?php echo "$ref"; ?></b>

    <b class="list-group-item"> Nom du Produit :  <?php echo "$nom"; ?> </b>
    <b class="list-group-item"> Quantité en stock : <?php echo "$qte_stock"; ?></b>
</div>
<br>
<div>
           <center><div class="form-inline"><b> Préciser la periode Souhaitée : </b>&nbsp;Semaine <input type="number" value="0" data-rule="quantity" style="width:50px; margin-bottom:-25px; height:30px" id="semaine" >&nbsp; Mois <input type="number" value="0" data-rule="quantity" style="width:50px; margin-bottom:-25px; height:30px" id="mois" ></div>
               <br>

               <center> <?php if ($type==1){$req1="SELECT * FROM `lit` WHERE nom=$id_prod AND `etat_lit`=1 AND `etat_louer`!=1";
                       $oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
                       $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
                       ?>
                   <div class="form-inline"> <h4><b> Préciser le lit : </b></h4>

                       <select id="quant" data-rel="chosen" class="col-md-8" name="nom"  >
                       <?php
                       while ($row = $oPDOStatement->fetch()) {
                           $id = $row->id;
                           $ref_lit = $row->ref_lit;
                           if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
                           elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}
                           ?>
                           <option  value="<?php echo $id; ?>">MM2-L<?php echo $ref_lit ?>-S</option>

                       <?php  }?>
                   </select>
                       </div>
                   <?php
                   }
                    else {
                        echo '<br>';
                   echo '<b>  Quantité : </b> <input type="number"  value="1" data-rule="quantity" style="width:50px; margin-bottom:-25px; height:30px" id="quant"></h4>';
                        echo '<br>';

                    }
                ?>
                   <br>
                <div class="form-inline">
               <center><b> Caution  : </b>  <input type="number"   value= "<?php echo "$caution"; ?>" data-rule="quantity" style="width:100px; margin-bottom:-25px; height:30px" id="caution" <?php if (isset($_SESSION['user1'])) {echo "disabled";} ?> >
                </div>

                  <?php if (isset($_SESSION['user1'])){ ?>

                   <input type="hidden"  value= "<?php echo "$caution"; ?>"  data-rule="quantity" style="width:50px; margin-bottom:-25px; height:30px" id="caution" >

                   <?php } ?>
                        <br>
                   <br>
                   <center><div class="form-inline"><b>  Prix : </b> <input type="number"  value= "<?php echo "$prix_semaine"; ?>" data-rule="price" style="width:100px; margin-bottom:-25px; height:30px" id="nv_prix_s" <?php if (isset($_SESSION['user1'])) {echo "disabled";} ?> >DT/Semaine &nbsp;&nbsp;&nbsp;<input type="number" value= "<?php echo "$prix_mois"; ?>"  data-rule="price" style="width:70px; margin-bottom:-25px; height:30px" id="nv_prix_m" <?php if (isset($_SESSION['user1'])) {echo "disabled";} ?> >DT/Mois
            </div>


                       <?php if (isset($_SESSION['user1'])){ ?>
                           <input type="hidden" value= "<?php echo "$prix_semaine"; ?>" data-rule="price" class="form-control" style="width:100px; margin-bottom:-25px; height:30px" id="nv_prix_s" > <input type="hidden" value= "<?php echo "$prix_mois"; ?>" data-rule="price" style="width:100px; margin-bottom:-25px; height:30px" id="nv_prix_m" >
                        <?php } ?>
                       <br>
            <br>
            <center><button type="submit" class="btn btn-lg btn-primary" onClick="myAjax();" >Ajouter aux séléctions <i class="glyphicon glyphicon-shopping-cart"></i></button></center>
            <!--<h5><b style = " font-size : 20px;"><a onClick="myAjax();" style="margin-left:10px;"><img src='images/icons/add2basket.png' > Ajouter ce produit aux séléctions</a></b> </h5></center>-->
</center>










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

<script language="javascript">
    <?php if ($type==1) {?>
    $(document).ready(function(){
        qte =  $("#quant option:selected").val();
        $('#quant').change(function () {
                qte =  $("#quant option:selected").val();


            })


    })
    <?php }
    ?>
    function myAjax() {
        <?php if ($type!=1) {?>
        var qte=document.getElementById("quant").value;
        <?php } ?>
        $.ajax({
            type: "POST",
            url: 'ajax.php?id=<?php echo $id_prod; ?>&qte='+qte+'&prix_s='+document.getElementById("nv_prix_s").value+'&prix_m='+document.getElementById("nv_prix_m").value+'&caution='+document.getElementById("caution").value+'&semaine='+document.getElementById("semaine").value+'&mois='+document.getElementById("mois").value+'&type=<?php echo $type; ?>',
            data:{action:'ajout'},
            success:function(html) {
                alert(html);
                // document.location.href="BL.php";
               self.parent.$.fancybox.close();

            }

        });
    }
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

