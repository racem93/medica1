<?php extract($_POST);
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
}

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Free HTML5 Bootstrap Admin Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
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
<div class="box-content">
    <div class="control-group">

            <div class="form-inline">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><label class="control-label"><h3 style="display:inline;"><b>MODELE DE LIT:</b></h3></label></div>
                    <div class="col-md-8"></div>
                </div>
            </div>
<div class="form-inline">
    <table class="table table-striped table-bordered responsive" border="">
        <tr>
            <td class="col-md-2" ><h4 style="display:inline;"><b>REF. DU LIT:</b></h4></td>
            <td class="col-md-8" ><h1 style="display:inline;">MM2-L <?php echo $ref_lit; ?>
                    -S</h1></td>
        </tr>
        <tr>
            <td class="col-md-2"><b>REF. MOTEUR PRINCIPAL:</b></td>
            <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                    -MP</h3></td>
        </tr>
        <tr>
            <td class="col-md-2"><b>REF. MOTEUR R-B:</b></td>
            <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                    -MA</h3></td>
        </tr>
        <tr>
            <td class="col-md-2"><b>REF. TELECOMMANDE:</b></td>
            <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                    -MC</h3></td>
        </tr>

    </table>
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