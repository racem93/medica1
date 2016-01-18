

<?php
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
if (isset($_POST["contrat"])) {
    $nom_client="";
    $adresse_client="";
    $tel_client="";
    $gsm_client="";
    $cin_client="";
    $date_cin="";
    $nom_ben="";
    $adresse_ben="";
    $tel_ben="";
    $cin_ben="";
    extract($_POST);
}
if (isset($_POST["ajout"])) {
    $cin_client="";
    extract($_POST);
$req1 = "INSERT INTO commande (ref,nom_client,adresse_client,tel_client,gsm_client,cin_client,date_cin,nom_ben,adresse_ben,tel_ben,cin_ben,total_htva,total_tva,total_ttc,total_caution,date_commande)
VALUES (" ."'".$ref."'"."," ."'".$nom_client."'".","."'".$adresse_client."'".","."'".$tel_client."'".","."'".$gsm_client."'".","."'".$cin_client."'".","."'".$date_cin."'".",
"."'".$nom_ben."'".","."'".$adresse_ben."'".","."'".$tel_ben."'".","."'".$cin_ben."'".",
"."'".$total_htva."'".","."'".$total_tva."'".","."'".$total_ttc."'".","."'".$total_caution."'".","."'".$date_commande."'".")";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement

    //id_dernier d'une commande
    $req2 = "SELECT * FROM commande WHERE id=(SELECT MAX(id) as 'DERNIER_ID' from commande)";


    $oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
    $oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);

    while ($row2=$oPDOStatement2->fetch())
    {
        $iddernier=$row2->id;

    }
}
?>
<?php require('header.php'); ?>
<div class="row">
    <div class="col-md-2"><label>N°</label><input type="text" name="ref" class="form-control" value="<?php echo $ref; ?>" disabled></div>
    <div class="col-md-2"><label>Date creation</label><input type="text" name="date_commande" class="form-control" value="<?php echo $date_commande ?>" disabled></div>
    </div>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Détails contrat</h2>
                </div>
                <div class="box-content">
                    <div class="control-group">
                        <div class="row">
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <th colspan="2">Cordonnées du client</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Nom:&nbsp;<?php echo $nom_client;?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Adresse:&nbsp;<?php echo $adresse_client;?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel:&nbsp;<?php echo $tel_client;?></td>
                                        <td>GSM:&nbsp;<?php echo $gsm_client;?></td>
                                    </tr>
                                    <tr>
                                        <td>CIN N°:&nbsp;<?php echo $cin_client;?></td>
                                        <td>Tunis le:&nbsp;<?php echo $date_cin;?></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <th colspan="2">Cordonnées du beneficiare</th>
                                    </tr>
                                    <tr>
                                        <td >Nom:&nbsp;<?php echo $nom_ben;?></td>
                                    </tr>
                                    <tr>
                                        <td >Adresse:&nbsp;<?php echo $adresse_ben;?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel:&nbsp;<?php echo $tel_ben;?></td>
                                    </tr>
                                    <tr>
                                        <td>CIN N°:&nbsp;<?php echo $cin_ben;?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">Liste des produits séléctionnés</h2>
                            </div>
                            <div class="panel-body">
                                <?php
                                //On prépare l'utilisation des variables de fonctions (variable qui sont stockées sur le serveur pour chaque session ouverte)
                                //test

                                if(!empty($_SESSION['id']))
                                {
                                // on extrait les id du caddie
                                $id_liste=$_SESSION['id'];


                                // on fait notre requête
                                /*$req="select id,nom from produit where id IN(".$id_liste.")";
                                $oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.*/
                                $i=0;
                                $total_htva=0;
                                $total_caution=0;
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" >
                                        <thead>
                                        <tr>
                                            <th style="width:40%;">Produit</th>
                                            <th style="width:15%;">Période</th>
                                            <th style="width:15%;">Qte</th>
                                            <th style="width:30%;">P.U HTVA</th>
                                            <th style="width:15%;">Montant</th>
                                            <th style="width:15%;">Caution/Unité</th>



                                        </tr>
                                        </thead>

                                        <?php foreach($id_liste as $val){
                                        $i++;
                                        $req="select id,nom from produit where id =$val";
                                        $oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                        $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                                        while ($data=$oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                        {
                                            $idd=$data['id'];
                                            $prix_total=$_SESSION['prix'][$i]*$_SESSION['panier'][$i];

                                            $total_htva=$total_htva+$prix_total;
                                            $total_caution=$total_caution+$_SESSION['caution'][$i];
                                            echo "<tr>

                                          <td>".$data['nom']."</td>
                                          <td>".$_SESSION['periode'][$i]."</td>
                                          <td>".$_SESSION['panier'][$i]."</td>
                                          <td>".$_SESSION['prix'][$i]."</td>
                                          <td>".$prix_total."</td>
                                          <td>".$_SESSION['caution'][$i]."</td>

                                          </tr>";//Lecture des résultats
                                        //insertion  dans ligne commande
                                            if(isset($_POST['ajout']))
                                            {
                                                $req = "INSERT INTO ligne_commande ( id_commande,id_produit,periode,qte,prix_unit_ht,prix_caution)
                                                VALUES ("."'".$iddernier."'".","."'".$idd."'".","."'".$_SESSION['periode'][$i]."'".","."'".$_SESSION['panier'][$i]."'".","."'".$_SESSION['prix'][$i]."'".","."'".$_SESSION['caution'][$i]."'".")";
                                                $oPDOStatement4=$connect->query($req); // Le résultat est un objet de la classe PDOStatement



                                            }
                                        }}
                                        ?>

                                    </table>
                                </div>
                            </div>
                            <?php } ?>


                        </div>

                        <?php
                        if(!empty($_SESSION['id']))
                        {
                            $total_tva=$total_htva*0.18;
                            $totat_ttc=$total_htva+$total_tva;
                            echo "
                            <div class='row'>
                            <div class='col-md-8'></div>
                            <div class='col-md-4' align='right'><div class='form-inline'> <b>TOTAL HTVA</b> &nbsp;<input type='text' class='form-control' value='".$total_htva."&nbsp Dt' disabled><br>
                             <b>TVA 18%</b> &nbsp;<input type='text' class='form-control' value='".$total_tva."&nbsp Dt' disabled><br>
                             <b>TOTAL TTC </b>&nbsp;<input type='text' class='form-control' value='".$totat_ttc."&nbsp Dt' disabled><br><br>
                             <b>TOTAL CAUTION</b> &nbsp;<input type='text' class='form-control' value='".$total_caution."&nbsp Dt' disabled></div></div>
                            </div>";


                        ?>
                        <form action="commande_contrat.php" method="post">
                            <input type="hidden" name="nom_client" value="<?php echo $nom_client; ?>" >
                            <input type="hidden" name="adresse_client" value="<?php echo $adresse_client; ?>" >
                            <input type="hidden" name="tel_client" value="<?php echo $tel_client; ?>" >
                            <input type="hidden" name="gsm_client" value="<?php echo $gsm_client; ?>" >
                            <input type="hidden" name="cin_client" value="<?php echo $cin_client; ?>" >
                            <input type="hidden" name="date_cin" value="<?php echo $date_cin; ?>" >
                            <input type="hidden" name="nom_ben" value="<?php echo $nom_ben; ?>" >
                            <input type="hidden" name="adresse_ben" value="<?php echo $adresse_ben; ?>" >
                            <input type="hidden" name="tel_ben" value="<?php echo $tel_ben; ?>" >
                            <input type="hidden" name="cin_ben" value="<?php echo $cin_ben; ?>" >
                            <input type="hidden" name="total_htva" value="<?php echo $total_htva; ?>" >
                            <input type="hidden" name="total_tva" value="<?php echo $total_tva; ?>" >
                            <input type="hidden" name="total_ttc" value="<?php echo $totat_ttc; ?>" >
                            <input type="hidden" name="total_caution" value="<?php echo $total_caution; ?>" >
                            <input type="hidden" name="ref" value="<?php echo $ref; ?>" >
                            <input type="hidden" name="date_commande" value="<?php echo $date_commande; ?>" >
                            <?php }?>
                        <div class="row">
                            <div class="col-md-1"><a href="javascript:history.go(-1)"><button type="button" class="btn btn-default" name="retour" style="width: 200px" ><i class="glyphicon glyphicon-fast-backward"></i> &nbsp;Retour</button></a></div>
                            <div class="col-md-3"></div>
                            <button type="submit" class="btn btn-primary" name="ajout" style="width: 200px" >Ajouter</button>
                        </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require('footer.php'); ?>
<?php
//
if(isset($_POST['ajout'])) {
echo "<SCRIPT LANGUAGE='JavaScript'>
    self.parent.location.href='gestion_contrat.php?msg=ajouter';
</SCRIPT> ";
    unset($_SESSION['id']);
    unset($_SESSION['panier']);
    unset($_SESSION['prix']);
    unset($_SESSION['periode']);
    unset($_SESSION['caution']);
}
?>
