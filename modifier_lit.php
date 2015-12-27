<?php
$id=$_GET['id'];
include_once("MyPDO.class.php");
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
    $description= $row->description;

}
if (isset($_POST["lit"])){
    extract($_POST);


} ?>


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
        <link rel="shortcut icon" href="img/favicon.ico">




    </head>
    <body>
    <div id="content" class="col-lg-12 col-sm-12">

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Modifier lit </h2>


                </div>
                <div class="box-content">
                    <div class="control-group">
                        <form role="form" action="modifier_lit.php" method="post">
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1" width="10%"></div>
                                    <div class="col-md-3" width="30%"><label class="control-label"><h3 style="display:inline;"><b>MODELE DE LIT:</b></h3></label></div>
                                    <div class="col-md-8" width="60%"> <input type="text" class="form-control" style="width: 500px;" name="nom" value="<?php echo $nom; ?>" ></div>
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <table class="table table-striped table-bordered responsive" border="">
                                    <tr>
                                        <td class="col-md-2" ><h4 style="display:inline;"><b>REF. DU LIT:</b></h4></td>
                                        <td class="col-md-8" ><h1 style="display:inline;">MM2-L
                                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px;" name="ref_lit" value="<?php echo $ref_lit; ?>" autofocus required>
                                                -S</h1></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><b>REF. MOTEUR PRINCIPAL:</b></td>
                                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_moteur_p" value="<?php echo $ref_moteur_p; ?>">
                                                -MP</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><b>REF. MOTEUR R-B:</b></td>
                                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_moteur_s" value="<?php echo $ref_moteur_s; ?>">
                                                -MA</h3></td>
                                    </tr>
                                    <tr>
                                        <td class="col-md-2"><b>REF. TELECOMMANDE:</b></td>
                                        <td class="col-md-8" style="width: 100px" ><h3 style="display:inline;">MM2-L
                                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_telecommande" value="<?php echo $ref_telecommande; ?>">
                                                -MC</h3></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="center"><h4>_______________________OBSERVATIONS_______________________</h4></div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT DE LA BASE DU LIT</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_base" style="width: 200px">
                                            <option <?php if ($etat_base=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_base=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_base=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4" width="30%">ETAT DES BARRIERES</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_barriere" width="70%">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT DES PANNEAUX</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_panneaux">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT MOTEUR CENTRAL</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_moteur">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT HAUT.VARIABLE</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_variable">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT RELEVE BUSTE</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_releve">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT TELECOMMANDE</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_telecommande">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT DU PERROQUET</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_perroquet">
                                            <option selected value="fonctionne">Fonctionne</option>
                                            <option value="casse">Cassé</option>
                                            <option value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">AUTRES ACCESSOIRES/DESCRIPTION</div>
                                    <div class="col-md-6">
                                        <textarea class="form-control " name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <button type="submit" class="btn btn-primary" name="lit" style="width: 200px" >Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>

    <!--POP-PUP begin-------------------------------------------------------------------------------------------------->
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.mousewheel-3.0.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript">
        $(document).ready(function() {
            $("#iframe").fancybox({
                'width'          : '70%',
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
    <style type="text/css">
        .fancybox-custom .fancybox-skin {
            box-shadow: 0 0 50px #222;
        }


    </style>

    <!-- POP-UP END --------------------------------------------------------------------------------------------------->


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
