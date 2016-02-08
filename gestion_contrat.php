
<?php extract($_POST);
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
$req1="SELECT * FROM `commande` ORDER BY `id` DESC";
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
                <a href="gestion_contrat.php">Gestion des contrats</a>
            </li>
        </ul>
    </div>
<?php
if (isset($_GET["msg"])) {
    $msg=$_GET["msg"];
    if ($msg=="supprimer") { echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                             Le contrat a été supprimer avec succés!!
                                    </div>';}
    elseif ($msg=="modifier") { echo '<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            Le contrat a été modifier avec succés!!
                                    </div>';}
    elseif ($msg=="ajouter") { echo '<div class="alert alert-info">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    Le contrat a été ajouter avec succés!!
                                    </div>';}
}
?>
    <div class="row">
        <div class="box col-md-12">

            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Liste des contrats</h2>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th class="center-text" width="10%">REF. DU CONTRAT</th>
                            <th class="center-text">NOM CLIENT</th>
                            <th class="center-text">NOM BENIFICAIRE</th>
                            <th class="center-text">TOTAL TTC</th>

                            <th class="center-text">Etat</th>

                            <th class="center-text">DATE</th>

                            <th class="center-text">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $oPDOStatement->fetch())
                        {
                            $id=$row->id;
                            $ref_contrat=$row->ref;
                            $nom_client=$row->nom_client;
                            $date_commande1=$row->date_commande;
                            $total_ttc=$row->total_ttc;
                            $total_caution=$row->total_caution;

                            $nom_ben=$row->nom_ben;

                            $date_commande = date("d-m-Y", strtotime($date_commande1));

                        $req2="select etat_louer from ligne_commande where id_commande =$id";
                        $oPDOStatements2=$connect->query($req2); // Le r&eacute;sultat est un objet de la classe PDOStatement
                        $oPDOStatements2->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                            $b=0;
                        while ($data=$oPDOStatements2->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                        {

                            $etat_louer = $data['etat_louer'];
                            if ($etat_louer==1){ $b=1;
                                                break;}

                        }

                        ?>
                        <tr>
                            <td class="center-text"><?php echo $ref_contrat; ?></td>
                            <td class="center-text"><?php echo $nom_client; ?></td>
                            <td class="center-text"><?php echo $nom_ben;  ?></td>
                            <td class="center-text"><?php echo $total_ttc; ?>&nbsp;DT</td>

                            <?php
                            if ($b==1) {
                                echo '<td class="center-text">
                                <span class="label-success label label-default">EN COURS</span>
                            </td>';
                            }
                            elseif ($b==0) {
                                echo '<td class="center-text">
                                <span class="label-default label"">FINI</span>
                            </td>';
                            }
                            ?>

                            <td class="center-text"><?php echo $date_commande; ?></td>

                            <td class="center" width="10%">
                                <a class="btn btn-success" href="details_contrat.php?id=<?php echo $id; ?>" id="iframe">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    Details
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