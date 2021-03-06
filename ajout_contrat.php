
<?php extract($_POST);
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
$req1="SELECT * FROM `produit`";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);

$req2="SELECT MAX(`ref`)AS max_commande FROM `commande`";
$oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);
$max_commande=1;
while ($row2 = $oPDOStatement2->fetch()) {
    $max_commande = $row2->max_commande+1;
}
if ($max_commande<10) {$max_commande="000".$max_commande;}
elseif (($max_commande<100)&&($max_commande>=10)) {$max_commande="00".$max_commande;}
elseif (($max_commande<1000)&&($max_commande>=100)) {$max_commande="0".$max_commande;}
?>

<?php require('header.php'); ?>
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="acceuil.php">Accueil</a>
            </li>
            <li>
                <a href="ajout_contrat.php">Ajout Contrat</a>
            </li>
        </ul>
    </div>
<?php
if (isset($_GET["msg"])) {
    $msg=$_GET["msg"];
    if ($msg=="ajout") { echo '<div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                             Le contrat a été crée avec succés!!
                                    </div>';}

}
?>
<form action="commande_contrat.php" name="formulaire" method="post">
<div class="row">
    <div class="col-md-2"><label>N°</label><input type="text" name="numero" class="form-control" value="<?php echo $max_commande; ?>" disabled></div>
    <input type="hidden" name="numero" value="<?php echo $max_commande; ?>" >
    <div class="col-md-2"><label>Date creation</label><input type="date" name="date_commande" class="form-control" value="<?php  echo date("Y-m-d"); ?>"></div>
    <div class="col-md-2"></div>
    <div class="col-md-6"><a href="prod_select.php" id="iframe" align="lepht"> <div align="right"><button type="submit" class="btn btn-lg btn-primary" style="background-color:#0C6;"><i class="glyphicon glyphicon-th-large"></i> Consulter Les Models Séléctionnés </button></div> </a>
    </div>
</div>
    <div class="row">
    <div class="box col-md-6">

        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i>Cordonnées du client</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>

            <div class="box-content">

                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-2"><label >Nom: </label></div>
                        <input type="text" name="nom_client" class="form-control" style="width: 400px;" id="exampleInputEmail1" placeholder="Entrer le nom du client"  autofocus required>
                    </div>
                </div>
                <br>
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-2"><label >Adresse: </label></div>
                        <textarea class="form-control " name="adresse_client" cols="51" placeholder="Entrer l'adresse du client"  autofocus required ></textarea>
                    </div>
                </div>
                <br>
                    <div class="row">
                        <div class="col-md-1"><label >Tel: </label></div>
                        <div class="col-md-5"><input type="text" name="tel_client" class="form-control"  id="exampleInputEmail1"   autofocus required>
                    </div>
                        <div class="col-md-1"><label >Gsm: </label></div>
                        <div class="col-md-5"><input type="text" name="gsm_client" class="form-control"  id="exampleInputEmail1"  >
                        </div>
                    </div>
                <br>
                <div class="row">
                    <div class="col-md-2"><label >CIN N: </label></div>
                    <div class="col-md-4"><input type="text" name="cin_client" class="form-control"  id="exampleInputEmail1" pattern="[0-9]{8,10}" title="Le CIN doit être composer de 8 à 10 chiffres "   autofocus required>
                    </div>
                    <div class="col-md-2"><label >Tunis,le: </label></div>
                    <div class="col-md-4"><input type="text" name="date_cin" class="form-control"  id="exampleInputEmail1" pattern="\d{1,2}/\d{1,2}/\d{4}" title="Le date doit être se forme dd/mm/yyyy"   autofocus required>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <div class="box col-md-6">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i>Cordonnées du beneficiare</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-2"><label >Nom: </label></div>
                        <input type="text" name="nom_ben" class="form-control" style="width: 400px;" id="exampleInputEmail1" placeholder="Entrer le nom du beneficiare"  autofocus required>
                    </div>
                </div>
                <br>
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-2"><label >Adresse: </label></div>
                        <textarea class="form-control " name="adresse_ben" cols="51" placeholder="Entrer l'adresse du beneficiare"  autofocus required ></textarea>
                    </div>
                </div>
                <br>
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-2"><label >Tel:</label></div>
                        <input type="text" name="tel_ben" class="form-control" style="width: 400px;" id="exampleInputEmail1" placeholder="Entrer le tel du beneficiare"  autofocus required>
                    </div>
                </div>
                <br>
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-2"><label >CIN N:</label></div>
                        <input type="text" name="cin_ben" class="form-control" style="width: 400px;" id="exampleInputEmail1" placeholder="Entrer le cin du benefecirae" pattern="[0-9]{8,10}" title="Le CIN doit être composer de 8 à 10 chiffres "  autofocus required>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>



    <div class="row">
        <div class="box col-md-12">

            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Liste des produits</h2>
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
                            <th class="center-text">Qte.Stock</th>
                            <th class="center-text">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $oPDOStatement->fetch())
                        {
                            $id=$row->id;
                            $ref_produit=$row->ref;
                            $nom=$row->nom;
                            $type=$row->type;
                            $qte_total=$row->qte;
                            $qte_louer=$row->qte_louer;
                            if ($type==1){
                                $req2="SELECT COUNT(`id`) AS qte_stock FROM `lit` WHERE `nom`=$id AND `etat_lit`=1 AND `etat_louer`!=1 ";
                                $oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
                                $oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);
                                while ($row2 = $oPDOStatement2->fetch()) {
                                    $qte_stock = $row2->qte_stock;
                                }}
                            else {
                                $qte_stock = $qte_total - $qte_louer;
                            }

                        ?>
                        <tr>
                            <td class="center-text"><?php echo $ref_produit ?></td>
                            <td class="center-text"><?php echo $nom ?></td>
                            <td class="center-text"><?php echo $qte_stock ?></td>
                            <?php
                            //here php code
                            ?>
                            <td class="center" width="30%">

                                <a class="btn btn-info center-block" href="ajout_selection.php?id=<?php echo $id; ?>" id="iframe" >
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

<div class="row">
    <div class="box col-md-12">

        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Autres Informations</h2>
                <div class="box-icon">

                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="form-inline">
                <div class="row">
                    <div class="col-md-4" align="center"><label >Nombre du KM</label>
                    <br><input type="number" name="transport" class="form-control"  id="exampleInputEmail1" value="0" style="width: 100px" autofocus required>&nbsp;</div>
                        <div class="col-md-4" align="center"><label >Frais de mise en oeuvre</label>
                        <br><input type="text" name="frais" class="form-control"  id="exampleInputEmail1" value="15" style="width: 100px" autofocus required  <?php if (isset($_SESSION['user1'])) {echo "disabled";} ?>  >&nbsp;DT
                            <?php if (isset($_SESSION['user1'])){ ?>
                            <input type="hidden" name="frais" class="form-control"  id="exampleInputEmail1" value="15" style="width: 100px" autofocus required>
                            <?php } ?>
                    </div>
                    <div class="col-md-4" align="center"><label >Nombre d'etage</label>
                        <br><input type="number" name="etage" class="form-control"  id="exampleInputEmail1" value="0" style="width: 100px" autofocus required  >&nbsp;
                    </div>
                </div>
                    </div>
            </div>
        </div>
    </div>
</div>

 <div align="center"><button type="submit" name="contrat"  class="btn btn-lg btn-primary" style="background-color:#0C6;"><i class="glyphicon glyphicon-shopping-cart"></i> Enregitrer la contrat </button></div>
</form>
<?php require('footer.php'); ?>