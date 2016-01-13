<?php
if (isset($_POST["produit"])) {
    $qte=0;
    extract($_POST);
    include_once("MyPDO.class.php");
    $connect = new MyPDO();

    $req1 = "INSERT INTO `produit`( `type`,`nom`,`ref`, `prix_unit`, `qte`, `caution`, `tva_produit`)
    VALUES ("."'".$type."'".","."'".$nom."'".","."'".$ref."'".","."'".$prix_unit."'".","."'".$qte."'".","."'".$caution."'".","."'".$tva_produit."'".")";
    $oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
    echo "<SCRIPT LANGUAGE='JavaScript'>
    self.parent.location.href='gestion_produit.php?msg=ajouter';
    </SCRIPT> ";
}
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
            <li>
                <a href="ajout_produit.php">Ajout</a>
            </li>

        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-edit"></i> Ajout nouveau produit</h2>
                </div>
                <div class="box-content">
                    <div class="control-group">
                        <form role="form" action="ajout_produit.php" method="post" >
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                <label>Type de produit: &nbsp &nbsp</label>
                                    <input type="radio" name="type" id="type" value="1" checked> lit
                                &nbsp &nbsp &nbsp
                                    <input type="radio" name="type" id="type" value="2"> autres

                                    </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Nom produit </label></div>
                                <input type="text" name="nom" class="form-control" id="exampleInputEmail1" placeholder="Entrer le nom" style="width: 500px;" autofocus required>
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Reférence produit </label></div>
                                    <input type="text" name="ref" class="form-control" id="exampleInputEmail1" placeholder="Entrer la ref"  autofocus required>
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Prix produit </label></div>
                                <input type="text" name="prix_unit" class="form-control" id="exampleInputEmail1" placeholder="Entrer le prix" autofocus required>&nbsp dt
                                    </div>
                            </div>
                            <br>
                            <div class="form-inline" id="qte">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Quantité</label></div>
                                <input type="text" name="qte" class="form-control" id="qte" placeholder="Entrer la quantité" >
                                    </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >Caution  </label></div>
                                <input type="text" name="caution" class="form-control" id="exampleInputEmail1" placeholder="Entrer la caution" autofocus required>&nbsp dt
                                </div>
                            </div>
                            <br>
                            <div class="form-inline">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1"><label >TVA </label></div>
                                    <input type="text" name="tva_produit" class="form-control" id="exampleInputEmail1" placeholder="Entrer la TVA" autofocus required>&nbsp %
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-3"></div>
                                <button type="submit" class="btn btn-primary" name="produit" style="width: 200px" >Ajouter</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require('footer.php'); ?>

