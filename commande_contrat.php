

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
    $transport=$transport*0.6+15;
}
if (isset($_POST["ajout"])) {
    $cin_client="";
    extract($_POST);
    $req1 = "INSERT INTO commande (ref,nom_client,adresse_client,tel_client,gsm_client,cin_client,date_cin,nom_ben,adresse_ben,tel_ben,cin_ben,total_htva,total_tva,total_ttc,total_caution,date_commande,acompte,prix_transport,etat_commande)
VALUES (" ."'".$ref."'"."," ."'".$nom_client."'".","."'".$adresse_client."'".","."'".$tel_client."'".","."'".$gsm_client."'".","."'".$cin_client."'".","."'".$date_cin."'".",
"."'".$nom_ben."'".","."'".$adresse_ben."'".","."'".$tel_ben."'".","."'".$cin_ben."'".",
"."'".$total_htva."'".","."'".$total_tva."'".","."'".$total_ttc."'".","."'".$total_caution."'".","."'".$date_commande."'".","."'".$acompte."'".","."'".$transport."'".",1)";
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
    <div class="col-md-2"><label>N°</label><input type="text" name="ref" class="form-control" value="<?php echo $numero; ?>" disabled></div>
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

                                        <?php foreach($id_liste as $i => $val){

                                        $req="select * from produit where id =$val";
                                        $oPDOStatements=$connect->query($req); // Le r&eacute;sultat est un objet de la classe PDOStatement
                                        $oPDOStatements->setFetchMode(PDO::FETCH_ASSOC);;//retourne true on success, false otherwise.
                                        while ($data=$oPDOStatements->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                        {
                                            $idd=$data['id'];
                                            $type=$data['type'];
                                            $prix_unit=($_SESSION['prix_s'][$i]*$_SESSION['semaine'][$i]+$_SESSION['prix_m'][$i]*$_SESSION['mois'][$i]);
                                            $prix_total=$prix_unit*$_SESSION['panier'][$i];

                                            $total_htva=$total_htva+$prix_total;
                                            $total_caution=$total_caution+$_SESSION['caution'][$i];
                                            echo "<tr>
                                            <td>".$data['nom'];
                                            $id_lit=0;
                                            if ($type==1) {
                                                $id_lit=$_SESSION['lit'][$i];
                                                $req1="SELECT ref_lit FROM `lit` WHERE id=$id_lit";
                                                $oPDOStatement1=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
                                                $oPDOStatement1->setFetchMode(PDO::FETCH_ASSOC);;
                                                while ($row=$oPDOStatement1->fetch())//Récupère la ligne suivante d'un jeu de résultat PDO
                                                {
                                                    $ref_lit=$row['ref_lit'];
                                                }
                                                if ($ref_lit<10) {$ref_lit="00".$ref_lit;}
                                                elseif (($ref_lit<100)&&($ref_lit>=10)) {$ref_lit="0".$ref_lit;}
                                                echo"<br><b>Ref: &nbsp;</b>MM2-L".$ref_lit."-S";}
                                            echo "</td>

                                          <td>";if ($_SESSION['semaine'][$i]!=0) {echo $_SESSION['semaine'][$i]." Semaine <br>";}
                                                if ($_SESSION['mois'][$i]!=0) {echo $_SESSION['mois'][$i]." Mois";}

                                          echo "</td>

                                          <td>".$_SESSION['panier'][$i]."</td>
                                          <td>".$prix_unit."DT</td>
                                          <td>".$prix_total."DT</td>
                                          <td>".$_SESSION['caution'][$i]."DT</td>

                                          </tr>";//Lecture des résultats
                                        //insertion  dans ligne commande

                                            if(isset($_POST['ajout']))
                                            {
                                                $req = "INSERT INTO ligne_commande ( id_commande,id_produit,id_lit,semaine,mois,qte,prix_unit_ht,prix_caution,etat_louer)
                                                VALUES ("."'".$iddernier."'".","."'".$idd."'".","."'".$id_lit."'".","."'".$_SESSION['semaine'][$i]."'".","."'".$_SESSION['mois'][$i]."'".","."'".$_SESSION['panier'][$i]."'".","."'".$prix_unit."'".","."'".$_SESSION['caution'][$i]."'".",1)";
                                                $oPDOStatement4=$connect->query($req); // Le résultat est un objet de la classe PDOStatementmo
                                                $qte_select=$_SESSION['panier'][$i];
                                                if ($type!=1) {
                                                    $req5 = "UPDATE `produit` SET `qte_louer`=`qte_louer`+$qte_select  WHERE `id`=$idd ";
                                                    $oPDOStatement5 = $connect->query($req5);
                                                }
                                                if ($type==1) {
                                                    $req6 = "UPDATE `lit` SET `etat_louer`=1  WHERE `id`=$id_lit AND `nom`=$idd";
                                                    $oPDOStatement6 = $connect->query($req6);
                                                    $req7 = "UPDATE `produit` SET `qte_louer`=`qte_louer`+1  WHERE `id`=$idd ";
                                                    $oPDOStatement7 = $connect->query($req7);
                                                }




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
                            $total_ttc=$total_htva+$total_tva;
                            echo "
                            <div class='row'>
                            <div class='col-md-8'>
                            <div class='row'>
                            <div class='col-md-1'></div>
                            <div class='col-md-2' align='center'>
                            <b>ACOMPTE</b><br>".$acompte."&nbsp; DT
                            </div>
                            <div class='col-md-1'></div>
                            <div class='col-md-2' align='center'>
                            <b>TRANSPORT</b><br>".$transport."&nbsp; DT
                            </div>
                            </div>

                            </div>
                            <div class='col-md-4' align='right'><div class='form-inline'> <b>TOTAL HTVA</b> &nbsp;<input type='text' class='form-control' value='".$total_htva."&nbsp Dt' disabled><br>
                             <b>TVA 18%</b> &nbsp;<input type='text' class='form-control' value='".$total_tva."&nbsp Dt' disabled><br>
                             <b>TOTAL TTC </b>&nbsp;<input type='text' class='form-control' value='".$total_ttc."&nbsp Dt' disabled><br><br>
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
                            <input type="hidden" name="total_ttc" value="<?php echo $total_ttc; ?>" >
                            <input type="hidden" name="total_caution" value="<?php echo $total_caution; ?>" >
                            <input type="hidden" name="ref" value="<?php echo $numero; ?>" >
                            <input type="hidden" name="date_commande" value="<?php echo $date_commande; ?>" >
                            <input type="hidden" name="acompte" value="<?php echo $acompte; ?>" >
                            <input type="hidden" name="transport" value="<?php echo $transport; ?>" >
                            <?php }?>
                        <div class="row">
                            <div class="col-md-1"><a href="javascript:history.go(-1)"><button type="button" class="btn btn-default" name="retour" style="width: 200px" ><i class="glyphicon glyphicon-fast-backward"></i> &nbsp;Retour</button></a></div>
                            <div class="col-md-3"></div>
                            <button type="submit" class="btn btn-primary" name="ajout" style="width: 200px" >Confirmer</button>
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
    self.parent.location.href='gestion_contrat.php?msg=ajouter'
</SCRIPT> ";

}
?>
