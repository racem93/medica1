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
if (isset($_POST["lit"])){
    extract($_POST);
    include_once("config/MyPDO.class.php");
    $connect=new MyPDO();
    if (($etat_base=="fonctionne")&&($etat_variable=="fonctionne")&&($etat_panneaux=="fonctionne")&&($etat_barriere=="fonctionne")&&($etat_moteur=="fonctionne")&&($etat_perroquet=="fonctionne")&&($etat_releve=="fonctionne")&&($etat_telecommande=="fonctionne"))
    {$etat_lit=1;}
    else $etat_lit=0;
    $req2="UPDATE `lit` SET `ref_lit`='$ref_lit' ,`nom`='$nom' ,`ref_moteur_p`='$ref_moteur_p' ,`ref_moteur_s`='$ref_moteur_s',
`ref_telecommande`='$ref_telecommande',`etat_base`='$etat_base',`etat_barriere`='$etat_barriere',`etat_panneaux`='$etat_panneaux',
`etat_moteur`='$etat_moteur',`etat_variable`='$etat_variable',`etat_releve`='$etat_releve',`etat_telecommande`='$etat_telecommande',
`etat_perroquet`='$etat_perroquet',`etat_lit`='$etat_lit',`description`='$description' WHERE `id`=$id ";
    $oPDOStatement=$connect->query($req2);
    echo "<SCRIPT LANGUAGE='JavaScript'>
self.parent.location.href='gestion_lit.php?msg=modifier';
self.parent.$.fancybox.close();
</SCRIPT> ";

}
// Fin Modification du lit

//Début la remplissage des formulaires
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    include_once("config/MyPDO.class.php");
    $connect = new MyPDO();
    $req1 = "SELECT * FROM `lit` WHERE  id= $id";
    $oPDOStatement = $connect->query($req1); // Le résultat est un objet de la classe PDOStatement
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
        $description = $row->description;

        if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
        elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}

        if ($ref_moteur_p<10) {$ref_moteur_p="00".$ref_moteur_p;}
        elseif (($ref_moteur_p<100)&&($ref_moteur_p>=10)) {$ref_moteur_p="0".$ref_moteur_p;}

        if ($ref_moteur_s<10) {$ref_moteur_s="00".$ref_moteur_s;}
        elseif (($ref_moteur_s<100)&&($ref_moteur_s>=10)) {$ref_moteur_s="0".$ref_moteur_s;}

        if ($ref_telecommande<10) {$ref_telecommande="00".$ref_telecommande;}
        elseif (($ref_telecommande<100)&&($ref_telecommande>=10)) {$ref_telecommande="0".$ref_telecommande;}

    }
}
//Fin de la remplissage des formulaires
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
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_base" style="width: 400px">
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
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_barriere" style="width: 400px">
                                            <option <?php if ($etat_barriere=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_barriere=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_barriere=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT DES PANNEAUX</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_panneaux" style="width: 400px">
                                            <option <?php if ($etat_panneaux=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_panneaux=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_panneaux=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT MOTEUR CENTRAL</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_moteur" style="width: 400px">
                                            <option <?php if ($etat_moteur=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_moteur=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_moteur=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT HAUT.VARIABLE</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_variable" style="width: 400px">
                                            <option <?php if ($etat_variable=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_variable=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_variable=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT RELEVE BUSTE</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_releve" style="width: 400px">
                                            <option <?php if ($etat_releve=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_releve=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_releve=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT TELECOMMANDE</div>
                                    <div class="col-md-8">
                                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_telecommande" style="width: 400px">
                                            <option <?php if ($etat_telecommande=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_telecommande=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_telecommande=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">ETAT DU PERROQUET</div>
                                    <div class="col-md-6">
                                        <select id="selectError" data-rel="chosen" class="col-md-6" name="etat_perroquet" style="width: 400px">
                                            <option <?php if ($etat_perroquet=="fonctionne"){ echo "selected"; } ?> value="fonctionne">Fonctionne</option>
                                            <option <?php if ($etat_perroquet=="casse"){ echo "selected"; } ?> value="casse">Cassé</option>
                                            <option <?php if ($etat_perroquet=="perdu"){ echo "selected"; } ?> value="perdu">Perdu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="controls" >
                                <div class="row">
                                    <div class="col-md-4">AUTRES ACCESSOIRES/DESCRIPTION</div>
                                    <div class="col-md-6">
                                        <textarea class="form-control " name="description" value="<?php echo $description; ?>"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <button type="submit" class="btn btn-primary" name="lit" style="width: 200px" >Modifier</button>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                            </div>

                        </form>
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
