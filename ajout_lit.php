<?php
include_once("MyPDO.class.php");
$connect=new MyPDO();
$req1="SELECT MAX(`ref_lit`)AS max_lit,MAX(`ref_moteur_p`)AS max_moteur_p, MAX(`ref_moteur_s`)AS max_moteur_s, MAX(`ref_telecommande`) AS max_telecommande FROM `lit`";
$oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement->setFetchMode(PDO::FETCH_OBJ);

while ($row = $oPDOStatement->fetch()) {
    $max_lit = $row->max_lit+1;
    $max_moteur_p = $row->max_moteur_p+1;
    $max_moteur_s = $row->max_moteur_s+1;
    $max_telecommande = $row->max_telecommande+1;
}
if ($max_lit<10) {$max_lit="00".$max_lit;}
elseif (($max_lit<100)&&($max_lit>=10)) {$max_lit="0".$max_lit;}

if ($max_moteur_p<10) {$max_moteur_p="00".$max_moteur_p;}
elseif (($max_moteur_p<100)&&($max_moteur_p>=10)) {$max_moteur_p="0".$max_moteur_p;}

if ($max_moteur_s<10) {$max_moteur_s="00".$max_moteur_s;}
elseif (($max_moteur_s<100)&&($max_moteur_s>=10)) {$max_moteur_s="0".$max_moteur_s;}

if ($max_telecommande<10) {$max_telecommande="00".$max_telecommande;}
elseif (($max_telecommande<100)&&($max_telecommande>=10)) {$max_telecommande="0".$max_telecommande;}

//Début d'ajout d'un nouveau lit
if (isset($_POST["lit"])){
    extract($_POST);
    include_once("MyPDO.class.php");
    $connect=new MyPDO();

    // Début test ref lit

    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $req1="SELECT * FROM `lit` WHERE `ref_lit`='$ref_lit'";
    $oPDOStatement=$connect->query($req1);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $a=0;
    while ($row = $oPDOStatement->fetch())
    {
        $a++;
        $id=$row->id;
    }
    if ($a==1) {

        $msg1 = 'la REF. DU LIT est déja existe \n ';
    }




    //Fin test ref lit

    // Début test ref lit
    $req1="SELECT * FROM `lit` WHERE `ref_moteur_p`='$ref_moteur_p'";
    $oPDOStatement=$connect->query($req1);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $b=0;
    while ($row = $oPDOStatement->fetch())
    {
        $b++;
        $id=$row->id;
    }

    if ($b==1){

                    $msg2='la REF.MOTEUR PRINCIPAL est déja existe \n ';
                    }

    //Fin test ref lit

    // Début test ref lit
    $req1="SELECT * FROM `lit` WHERE `ref_moteur_s`='$ref_moteur_s'";
    $oPDOStatement=$connect->query($req1);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $c=0;
    while ($row = $oPDOStatement->fetch())
    {
        $c++;
        $id=$row->id;
    }
    if ($c==1){

                    $msg3='la REF. MOTEUR R-B est déja existe \n ' ;
                   }
    //Fin test ref lit

    // Début test ref lit
    $req1="SELECT * FROM `lit` WHERE `ref_telecommande`='$ref_telecommande'";
    $oPDOStatement=$connect->query($req1);
    $oPDOStatement->setFetchMode(PDO::FETCH_OBJ);
    $d=0;
    while ($row = $oPDOStatement->fetch())
    {
        $d++;
        $id=$row->id;
    }
    if ($d==1) {

        $msg4= 'la REF. TELECOMMANDE de lit est déja existe  ';
    }

    //Fin test ref lit

    if (($a == 1)||($b == 1)||($c == 1)||($d == 1)) { ?>
        <SCRIPT LANGUAGE='JavaScript'>
                    alert('<?php echo $msg1.$msg2.$msg3.$msg4 ?>');
                    //location='ajout_lit.php';
                    history.go(-1);
                    </SCRIPT>
        <?php }
    else {


    if (($etat_base=="fonctionne")&&($etat_variable=="fonctionne")&&($etat_panneaux=="fonctionne")&&($etat_barriere=="fonctionne")&&($etat_moteur=="fonctionne")&&($etat_releve=="fonctionne")&&($etat_telecommande=="fonctionne"))
    {$etat_lit=1;}
    else $etat_lit=0;
    $req1 = "INSERT INTO `lit`( `nom`,`ref_lit`, `ref_moteur_p`, `ref_moteur_s`, `ref_telecommande`, `etat_base`, `etat_barriere`, `etat_panneaux`, `etat_moteur`, `etat_variable`, `etat_releve`, `etat_telecommande`, `etat_perroquet`, `description`, `etat_lit`)
    VALUES ("."'".$nom."'".","."'".$ref_lit."'".","."'".$ref_moteur_p."'".","."'".$ref_moteur_s."'".","."'".$ref_telecommande."'".","."'".$etat_base."'".","."'".$etat_barriere."'".","."'".$etat_panneaux."'".","."'".$etat_moteur."'".","."'".$etat_variable."'".","."'".$etat_releve."'".","."'".$etat_telecommande."'".","."'".$etat_perroquet."'".","."'".$description."'".","."'".$etat_lit."'".")";
    $oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement
    echo "<SCRIPT LANGUAGE='JavaScript'>
    self.parent.location.href='gestion_lit.php?msg=ajouter';
    </SCRIPT> ";
    }
}
//Fin l'ajout d'un nouveau lit

// select les modele de lit
$req2="SELECT * FROM `produit` where `type`=1";
$oPDOStatement2=$connect->query($req2); // Le résultat est un objet de la classe PDOStatement
$oPDOStatement2->setFetchMode(PDO::FETCH_OBJ);

//Fin select
?>



<?php require('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="acceuil.php">Accueil</a>
        </li>
        <li>
            <a href="gestion_lit.php">Gestion des lits</a>
        </li>
        <li>
            <a href="ajout_lit.php">Ajout</a>
        </li>

    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Constrat lit de location</h2>


            </div>
<div class="box-content">
    <div class="control-group">
        <form role="form" action="ajout_lit.php" method="post">
            <div class="form-inline">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><label class="control-label"><h3 style="display:inline;"><b>MODELE DE LIT:</b></h3></label></div>
                    <div class="col-md-8">

                        <select id="selectError" data-rel="chosen" class="col-md-8" name="nom">
                            <?php
                        while ($row = $oPDOStatement2->fetch()) {
                            $id = $row->id;
                            $nom = $row->nom;
                           ?>
                            <option  value="<?php echo $id; ?>"><?php echo $nom; ?></option>

                       <?php  }?>
                        </select>

                    </div>
                </div>
            </div>
            <br>
            <div class="form-inline">
                <table class="table table-striped table-bordered responsive" border="">
                    <tr>
                    <td class="col-md-2" ><h4 style="display:inline;"><b>REF. DU LIT:</b></h4></td>
                    <td class="col-md-8" ><h1 style="display:inline;">MM2-L
                    <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px;" name="ref_lit" VALUE="<?php echo $max_lit ?>" autofocus required>
                    -S</h1></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. MOTEUR PRINCIPAL:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_moteur_p" VALUE="<?php echo $max_moteur_p ?>">
                                -MP</h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. MOTEUR R-B:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_moteur_s" VALUE="<?php echo $max_moteur_s ?>">
                                -MA</h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. TELECOMMANDE:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_telecommande" VALUE="<?php echo $max_telecommande ?>">
                                -MC</h3></td>
                    </tr>

                </table>
            </div>
        <div class="center"><h4>_______________________OBSERVATIONS_______________________</h4></div>
            <br>
        <div class="controls" >
            <div class="row">
                <div class="col-md-4">ETAT DE LA BASE DU LIT</div>
                <div class="col-md-8">
            <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_base">
                <option selected value="fonctionne">Fonctionne</option>
                <option value="casse">Cassé</option>
                <option value="perdu">Perdu</option>
            </select>
                </div>
            </div>
        </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT DES BARRIERES</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_barriere">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT DES PANNEAUX</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_panneaux">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT MOTEUR CENTRAL</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_moteur">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT HAUT.VARIABLE</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_variable">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT RELEVE BUSTE</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_releve">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT TELECOMMANDE</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_telecommande">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">ETAT DU PERROQUET</div>
                    <div class="col-md-8">
                        <select id="selectError" data-rel="chosen" class="col-md-8" name="etat_perroquet">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="controls" >
                <div class="row">
                    <div class="col-md-4">AUTRES ACCESSOIRES/DESCRIPTION</div>
                    <div class="col-md-6">
                        <textarea class="form-control " name="description"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
            <button type="submit" class="btn btn-primary" name="lit" style="width: 200px" >Ajouter</button>
            </div>
            </form>
    </div>
    </div>
            </div>
        </div>
    </div>
<?php require('footer.php'); ?>