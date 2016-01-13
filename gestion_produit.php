<?php extract($_POST);
include_once("MyPDO.class.php");
$connect=new MyPDO();
$req1="SELECT * FROM `produit`";
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
            <a href="gestion_produit.php">Gestion des produits</a>
        </li>
    </ul>
</div>
<?php
if (isset($_GET["msg"])) {
    $msg=$_GET["msg"];
    if ($msg=="supprimer") { echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                             Le lit a été supprimer avec succés!!
                                    </div>';}
    elseif ($msg=="modifier") { echo '<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Le lit a été modifier avec succés!!
                                    </div>';}
    elseif ($msg=="ajouter") { echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Le lit a été ajouter avec succés!!
                                    </div>';}
}
?>
<div class="row">
    <div class="box col-md-12">

        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Liste des produits</h2>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                    <tr>
                        <th class="center-text" width="20%">NOM</th>
                        <th class="center-text">REFERENCE</th>
                        <th class="center-text">PRIX_UNIT</th>
                        <th class="center-text">QUANTITE</th>
                        <th class="center-text">CAUTION</th>
                        <th class="center-text">TVA</th>
                        <th class="center-text">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $oPDOStatement->fetch())
                    {
                        $id=$row->id;
                        $nom=$row->nom;
                        $ref=$row->ref;
                        $prix_unit=$row->prix_unit;
                        $qte=$row->qte;
                        $caution=$row->caution;
                        $tva_produit=$row->tva_produit;
                    ?>

                        <tr>
                            <td class="center-text"><?php echo $nom; ?></td>
                            <td class="center-text"><?php echo $ref; ?></td>
                            <td class="center-text"><?php echo $prix_unit; ?>&nbsp dt</td>
                            <td class="center-text"><?php echo $qte; ?></td>
                            <td class="center-text"><?php echo $caution; ?>&nbsp dt</td>
                            <td class="center-text"><?php echo $tva_produit; ?>%</td>

                            <td class="center" width="25%">
                                <a class="btn btn-info" href="modifier_produit.php?id=<?php echo $id; ?>" id="iframe">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Modifier
                                </a>
                                <a class="btn btn-danger" href='supprimer_produit.php?id=<?php echo $id; ?>' onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce lit?'))"; >
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Supprimer
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