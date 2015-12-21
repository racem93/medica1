<?php if (isset($_POST["lit"])){
    extract($_POST);
    include_once("MyPDO.class.php");
    $connect=new MyPDO();
    $etat_lit=1;
    $req1 = "INSERT INTO `lit`( `nom`,`ref_lit`, `ref_moteur_p`, `ref_moteur_s`, `ref_telecommande`, `etat_base`, `etat_barriere`, `etat_panneaux`, `etat_moteur`, `etat_variable`, `etat_releve`, `etat_telecommande`, `etat_perroquet`, `description`, `etat_lit`)
    VALUES ("."'".$nom."'".","."'".$ref_lit."'".","."'".$ref_moteur_p."'".","."'".$ref_moteur_s."'".","."'".$ref_telecommande."'".","."'".$etat_base."'".","."'".$etat_barriere."'".","."'".$etat_panneaux."'".","."'".$etat_moteur."'".","."'".$etat_variable."'".","."'".$etat_releve."'".","."'".$etat_telecommande."'".","."'".$etat_perroquet."'".","."'".$description."'".","."'".$etat_lit."'".")";
    $oPDOStatement=$connect->query($req1); // Le résultat est un objet de la classe PDOStatement


} ?>



<?php require('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="acceuil.php">Accueil</a>
        </li>
        <li>
            <a href="lit.php">Gestion des lits</a>
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

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
<div class="box-content">
    <div class="control-group">
        <form role="form" action="ajout_lit.php" method="post">
            <div class="form-inline">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><label class="control-label"><h3 style="display:inline;"><b>MODELE DE LIT:</b></h3></label></div>
                    <div class="col-md-8"> <input type="text" class="form-control" style="width: 500px;" name="nom" ></div>
                </div>
            </div>
            <br>
            <div class="form-inline">
                <table class="table table-striped table-bordered responsive" border="">
                    <tr>
                    <td class="col-md-2" ><h4 style="display:inline;"><b>REF. DU LIT:</b></h4></td>
                    <td class="col-md-8" ><h1 style="display:inline;">MM2-L
                    <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px;" name="ref_lit" autofocus required>
                    -S</h1></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. MOTEUR PRINCIPAL:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_moteur_p">
                                -MP</h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. MOTEUR R-B:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_moteur_s">
                                -MA</h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. TELECOMMANDE:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px" name="ref_telecommande">
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