
<?php extract($_POST);
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
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
                             Le produit a été supprimer avec succés!!
                                    </div>';}
    elseif ($msg=="modifier") { echo '<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Le produit a été modifier avec succés!!
                                    </div>';}
    elseif ($msg=="ajouter") { echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Le produit a été ajouter avec succés!!
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
                        <th class="center-text">P.U.SEMAINE</th>
                        <th class="center-text">P.U.MOIS</th>
                        <th class="center-text">Qte.T</th>
                        <th class="center-text">Qte.Stock</th>
                        <th class="center-text">Qte.Louer</th>
                        <th class="center-text">CAUTION</th>
                        <?php if (isset($_SESSION['superadmin'])){ ?>

                        <th class="center-text">ACTION</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = $oPDOStatement->fetch())
                    {
                        $id=$row->id;
                        $nom=$row->nom;
                        $type=$row->type;
                        $ref=$row->ref;
                        $prix_semaine=$row->prix_semaine;
                        $prix_mois=$row->prix_mois;
                        $qte_total=$row->qte;
                        $qte_louer=$row->qte_louer;
                        $caution=$row->caution;
                        $tva_produit=$row->tva_produit;
                        if ($type==1){
                            $req2="SELECT COUNT(`id`) AS qte_total FROM `lit` WHERE `nom`=$id AND `etat_lit`=1 ";
                            $oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
                            $oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);
                            while ($row2 = $oPDOStatement2->fetch()) {
                                $qte_total = $row2->qte_total;
                            }
                            $req3="SELECT COUNT(`id`) AS qte_louer FROM `lit` WHERE `nom`=$id AND `etat_lit`=1 AND `etat_louer`=1 ";
                            $oPDOStatement3=$connect->query($req3); // Le résultat est un objet de la classe PDOStatement
                            $oPDOStatement3->setFetchMode(PDO::FETCH_OBJ);
                            while ($row3 = $oPDOStatement3->fetch()) {
                                $qte_louer = $row3->qte_louer;
                            }}

                        $qte_stock=$qte_total-$qte_louer;
                    ?>

                        <tr>
                            <td class="center-text"><?php echo $nom; ?></td>
                            <td class="center-text"><?php echo $ref; ?></td>
                            <td class="center-text"><?php echo $prix_semaine; ?>&nbsp DT</td>
                            <td class="center-text"><?php echo $prix_mois; ?>&nbsp DT</td>
                            <td class="center-text"><?php echo $qte_total; ?></td>
                            <td class="center-text"><?php echo $qte_stock; ?></td>
                            <td class="center-text"><?php echo $qte_louer; ?></td>
                            <td class="center-text"><?php echo $caution; ?>&nbsp DT</td>

                            <?php if (isset($_SESSION['superadmin'])){ ?>

                            <td class="center" width="25%">
                                <a class="btn btn-info" href="modifier_produit.php?id=<?php echo $id; ?>" id="iframe">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Modifier
                                </a>
                                <a class="btn btn-danger" href='supprimer_produit.php?id=<?php echo $id; ?>' onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce produit?'))"; >
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Supprimer
                                </a>
                            </td>
                            <?php } ?>
                        </tr>

                        <?php } ?>


                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>