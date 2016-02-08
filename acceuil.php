<?php
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
$req1="SELECT COUNT(id) AS total_lit FROM `lit`";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch())
{
    $total_lit=$row->total_lit;
}
$req1="SELECT COUNT(id) AS total_lit_f FROM `lit` WHERE etat_lit=1";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch())
{
    $lit_marche=$row->total_lit_f;
}

$lit_panne=$total_lit-$lit_marche;

$req1="SELECT COUNT(id) AS lit_louer FROM `lit` WHERE etat_lit=1 AND etat_louer=1";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch())
{
    $lit_louer=$row->lit_louer;
}

$lit_stock=$lit_marche-$lit_louer;

$req1="SELECT COUNT(id) AS total_produit FROM `produit`";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch())
{
    $total_produit=$row->total_produit;
}
$req1="SELECT COUNT(id) AS total_contrat FROM `commande`";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch())
{
    $total_contrat=$row->total_contrat;
}

$req1="SELECT COUNT(id) AS total_contrat_c FROM `commande` WHERE etat_commande=1 ";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
while ($row = $oPDOStatement->fetch())
{
    $total_contrat_c=$row->total_contrat_c;
}
?>
<?php require('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="acceuil.php">Home</a>
        </li>

    </ul>
</div>
<div class=" row">
    <div class="col-md-4 col-sm-4 col-xs-6">
        <a data-toggle="tooltip"  class="well top-block" href="gestion_produit.php">
            <i class="glyphicon glyphicon-briefcase blue"></i>

            <div>Total Produits</div>
            <div><?php echo $total_produit; ?></div>
        </a>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-6">
        <a data-toggle="tooltip" title="<?php echo $total_contrat_c ?> contarts en cours" class="well top-block" href="gestion_contrat.php">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Total contrats</div>
            <div><?php echo $total_contrat; ?></div>
            <span class="notification green"><?php echo $total_contrat_c; ?></span>
        </a>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-6">
        <a data-toggle="tooltip"  class="well top-block" href="gestion_lit.php">
            <i class="glyphicon glyphicon-hdd yellow"></i>

            <div>Total lits</div>
            <div><?php echo $total_lit; ?></div>
        </a>
    </div>


</div>
<br>
<div class="row">
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Statistiques sur les etas des lits</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <div class="center"><h4>Total des lits:<?php echo $total_lit; ?></h4></div>
                <div id="piechart1" style="height:300px"></div>
                <div id="hover1" style="height:300px"></div>
            </div>
        </div>
    </div>
    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i>Statistique sur les lits louer</h2>

                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>

                </div>
            </div>
            <div class="box-content">
                <div class="center"><h4>Total des lits en marche:<?php echo $lit_marche ?></h4></div>
                <div id="piechart2" style="height:300px"></div>
                <div id="hover2" style="height:300px"></div>
            </div>
        </div>
    </div>
</div>

<!-- chart libraries start -->

<script src="bower_components/flot/excanvas.min.js"></script>
<script src="bower_components/flot/jquery.flot.js"></script>
<script src="bower_components/flot/jquery.flot.pie.js"></script>
<script src="bower_components/flot/jquery.flot.stack.js"></script>
<script src="bower_components/flot/jquery.flot.resize.js"></script>
<!-- chart libraries end -->
<script src="js/init-chart.js"></script>

<script>
    var data = [

        { label: "EN MARCHE", data: <?php echo $lit_marche; ?> ,color:"rgb(77,167,77)"},
        { label: "EN PANNE", data: <?php echo $lit_panne; ?> ,color:"rgb(203,75,75)"}
    ];

    if ($("#piechart1").length) {
        $.plot($("#piechart1"), data,
            {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                legend: {
                    show: true
                }
            });

        function pieHover1(event, pos, obj) {
            if (!obj)
                return;
            percent = parseFloat(obj.series.percent).toFixed(2);
            $("#hover1").html('<span style="font-weight: bold; color: ' + obj.series.color + '">' + obj.series.label + ' (' + obj.series.value + ')</span>');
        }

        $("#piechart1").bind("plothover", pieHover1);
    }

    var data = [

        { label: "LITS.LOUER", data: <?php echo $lit_louer; ?> ,color:"rgb(175,216,248)"},
        { label: "LITS.STOCK", data: <?php echo $lit_stock; ?> ,color:"rgb(237,194,64)"}

    ];

    if ($("#piechart2").length) {
        $.plot($("#piechart2"), data,
            {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                legend: {
                    show: true
                }
            });

        function pieHover2(event, pos, obj) {
            if (!obj)
                return;
            percent = parseFloat(obj.series.percent).toFixed(2);
            $("#hover2").html('<span style="font-weight: bold; color: ' + obj.series.color + '">' + obj.series.label + ' (' + obj.series.value + ')</span>');
        }

        $("#piechart2").bind("plothover", pieHover2);
    }
</script>

<?php require('footer.php'); ?>

