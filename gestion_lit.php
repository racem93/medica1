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
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Datatable + Responsive</h2>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th class="center-text">REF. DU LIT</th>
                            <th class="center-text">MODELE DU LIT</th>
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
                        ?>
                        <tr>
                            <td class="center-text"><?php echo $ref_lit ?></td>
                            <td class="center-text"><?php echo  $nom ?></td>
                            <td class="center-text"><?php echo $ref_moteur_p ?></td>
                            <td class="center-text"><?php echo $ref_moteur_s ?></td>
                            <td class="center-text"><?php echo $ref_telecommande ?></td>
                            <td class="center-text">
                                <span class="label-warning label label-default">Pending</span>
                            </td>
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