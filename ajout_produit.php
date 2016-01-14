<?php
if (isset($_POST["produit"])) {
    $qte=0;
    extract($_POST);
    include_once("MyPDO.class.php");
    $connect = new MyPDO();
    $msg1="";$a=0;
    $msg2="";$b=0;
    $msg3="";$c=0;
    $msg4="";$d=0;
    $msg5="";$e=0;
    $req="SELECT * FROM `produit` WHERE ref='$ref'";
    $oPDOStatement=$connect->query($req);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $a=0;
    while ($row = $oPDOStatement->fetch())
    {
        $a++;
        $id=$row->id;
    }
    if ($a != 0) {
        $msg1='La RRFERENCE du produit est déja existe \n';
        $a=1;


    }
    if(!preg_match('/^[[:digit:]]+((\.[[:digit:]]{1,3})?)$/',$prix_unit))
        { $msg2='Le PRIX n est pas valide \n';
          $b=1;

        }

    if(!preg_match('/^[[:digit:]]*$/',$qte))
    { $msg3='La QUANTITE n est pas valide \n' ;
        $c=1;


    }

    if(!preg_match('/^[[:digit:]]+((\.[[:digit:]]{1,3})?)$/',$caution))
    { $msg4='Le CAUTION n est pas valide \n';
        $d=1;

        }

    if(!preg_match('/^[[:digit:]]+$/',$tva_produit))
    { $msg5='La QUANTITE n est pas valide ';
        $e=1;

        }

    if (($a == 1) || ($b == 1) ||($c == 1)||($d == 1)||($e == 1)) { ?>
        <SCRIPT LANGUAGE='JavaScript'>
            alert('<?php echo $msg1.$msg2.$msg3.$msg4.$msg5 ?>');
            //location='ajout_lit.php';
            history.go(-1);
        </SCRIPT>
    <?php }
    else {
        $req1 = "INSERT INTO `produit`( `type`,`nom`,`ref`, `prix_unit`, `qte`, `caution`, `tva_produit`)
    VALUES (" . "'" . $type . "'" . "," . "'" . $nom . "'" . "," . "'" . $ref . "'" . "," . "'" . $prix_unit . "'" . "," . "'" . $qte . "'" . "," . "'" . $caution . "'" . "," . "'" . $tva_produit . "'" . ")";
        $oPDOStatement = $connect->query($req1); // Le résultat est un objet de la classe PDOStatement
        echo "<SCRIPT LANGUAGE='JavaScript'>
    self.parent.location.href='gestion_produit.php?msg=ajouter';
    </SCRIPT> ";
    }
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

