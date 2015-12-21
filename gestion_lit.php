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
                    <h2><i class="glyphicon glyphicon-user"></i> Responsive, Swipable Table</h2>

                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                        <tr>
                            <th>REF. DU LIT</th>
                            <th>MODELE DU LIT</th>
                            <th>REF. MOTEUR PRINCIPAL</th>
                            <th>REF. MOTEUR R-B</th>
                            <th>REF. TELECOMMANDE</th>
                            <th>ETAT DU LIT</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $oPDOStatement->fetch())
                        {
                            $ref_lit=$row->ref_lit;
                            $nom=$row->nom;
                            $ref_moteur_p=$row->ref_moteur_p;
                            $ref_moteur_s=$row->ref_moteur_s;
                            $ref_telecommande=$row->ref_telecommande;
                        ?>
                        <tr>
                            <td><?php echo $ref_lit ?></td>
                            <td class="center"><?php echo  $nom ?></td>
                            <td class="center"><?php echo $ref_moteur_p ?></td>
                            <td class="center"><?php echo $ref_moteur_s ?></td>
                            <td class="center"><?php echo $ref_telecommande ?></td>
                            <td class="center">
                                <span class="label-warning label label-default">Pending</span>
                            </td>
                            <td class="center">
                                <a class="btn btn-success" href="#">
                                    <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                    View
                                </a>
                                <a class="btn btn-info" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger" href="#">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>

                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

<?php require('footer.php'); ?>