<?php extract($_POST);
include_once("MyPDO.class.php");
$connect=new MyPDO();
$req1="SELECT * FROM `lit`";
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
                <a href="lit.php">Gestion des lits</a>
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
                    <h2><i class="glyphicon glyphicon-user"></i> Liste des lits</h2>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th class="center-text" width="10%">REF. DU LIT</th>
                            <th class="center-text">REF. MOTEUR PRINCIPAL</th>
                            <th class="center-text">REF. MOTEUR R-B</th>
                            <th class="center-text">REF. TELECOMMANDE</th>
                            <th class="center-text">ETAT DU LIT</th>
                            <th class="center-text">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $oPDOStatement->fetch())
                        {
                            $id=$row->id;
                            $ref_lit=$row->ref_lit;
                            $nom=$row->nom;
                            $ref_moteur_p=$row->ref_moteur_p;
                            $ref_moteur_s=$row->ref_moteur_s;
                            $ref_telecommande=$row->ref_telecommande;
                            $etat_lit=$row->etat_lit;

                            if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
                            elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}

                            if ($ref_moteur_p<10) {$ref_moteur_p="00".$ref_moteur_p;}
                            elseif (($ref_moteur_p<100)&&($ref_moteur_p>=10)) {$ref_moteur_p="0".$ref_moteur_p;}

                            if ($ref_moteur_s<10) {$ref_moteur_s="00".$ref_moteur_s;}
                            elseif (($ref_moteur_s<100)&&($ref_moteur_s>=10)) {$ref_moteur_s="0".$ref_moteur_s;}

                            if ($ref_telecommande<10) {$ref_telecommande="00".$ref_telecommande;}
                            elseif (($ref_telecommande<100)&&($ref_telecommande>=10)) {$ref_telecommande="0".$ref_telecommande;}
                        ?>
                        <tr>
                            <td class="center-text">MM2-L<?php echo $ref_lit ?>-S</td>
                            <td class="center-text">MM2-L<?php echo $ref_moteur_p ?>-MP</td>
                            <td class="center-text">MM2-L<?php echo $ref_moteur_s ?>-MA</td>
                            <td class="center-text">MM2-L<?php echo $ref_telecommande ?>-MC</td>
                            <?php
                            if ($etat_lit==1) {
                                                echo '<td class="center-text">
                                                    <span class="label-success label label-default">EN MARCHE</span>
                                                </td>';
                                               }
                            elseif ($etat_lit==0) {
                                                echo '<td class="center-text">
                                                <span class="label-default label label-danger">EN PANNE</span>
                                                </td>';
                                                }
                            ?>
                            <td class="center" width="30%">
                                <a class="btn btn-success" href="details_lit.php?id=<?php echo $id; ?>" id="iframe">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    Details
                                </a>
                                <a class="btn btn-info" href="modifier_lit.php?id=<?php echo $id; ?>" id="iframe">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Modifier
                                </a>
                                <a class="btn btn-danger" href='supprimer_lit.php?id=<?php echo $id; ?>' onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce lit?'))"; >
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