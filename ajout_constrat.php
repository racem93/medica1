
<?php extract($_POST);
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$req1="SELECT * FROM `produit` where `type`=1";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
?>

<?php require('header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="acceuil.php">Accueil</a>
            </li>
            <li>
                <a href="ajout_constrat.php">Ajout Constrat</a>
            </li>
        </ul>
    </div>
<?php
if (isset($_GET["msg"])) {
    $msg=$_GET["msg"];
    if ($msg=="ajout") { echo '<div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                             Le constrat a été cré avec succés!!
                                    </div>';}

}
?>

<div class="row">
    <div class="box col-md-6">

        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Liste des models</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>

            <div class="box-content">

            </div>
        </div>
    </div>

    <div class="box col-md-6">

        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Liste des models</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">

            </div>
        </div>
    </div>
</div>



    <div class="row">
        <div class="box col-md-12">

            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Liste des models</h2>
                    <div class="box-icon">

                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th class="center-text" width="10%">REF. Model</th>
                            <th class="center-text">Nom Model</th>
                            <th class="center-text">Qte</th>
                            <th class="center-text">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $oPDOStatement->fetch())
                        {
                            $id=$row->id;
                            $ref=$row->ref;
                            $nom=$row->nom;
                            $qte=$row->qte;


                        ?>
                        <tr>
                            <td class="center-text"><?php echo $ref ?></td>
                            <td class="center-text"><?php echo $nom ?></td>
                            <td class="center-text"><?php echo $qte ?></td>
                            <?php
                            //here php code
                            ?>
                            <td class="center" width="30%">

                                <a class="btn btn-info center-block" href=".php?id=<?php echo $id; ?>" id="iframe" >
                                    <i class="glyphicon glyphicon-plus-sign icon-white"></i>
                                    Ajouter à la séléction
                                </a>

                            </td>
                        </tr>

                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


<?php require('footer.php'); ?>