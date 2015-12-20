<?php require('header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="acceuil.php">Accueil</a>
        </li>
        <li>
            <a href="lit.php">Lit</a>
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
        <form role="form">
            <div class="form-inline">
                <table class="table table-striped table-bordered responsive" border="">
                    <tr>
                    <td class="col-md-2" ><h4 style="display:inline;"><b>REF. DU LIT:</b></h4></td>
                    <td class="col-md-8" ><h1 style="display:inline;">MM2-L
                    <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px">
                    -S</h1></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. MOTEUR PRINCIPAL:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px">
                                -MP</h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. MOTEUR R-B:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px">
                                -MA</h3></td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><b>REF. TELECOMMANDE:</b></td>
                        <td class="col-md-8" ><h3 style="display:inline;">MM2-L
                                <input type="text" class="form-control" id="exampleInputEmail1"  style="width: 50px">
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
            <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
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
                        <select id="selectError" data-rel="chosen" class="col-md-8">
                            <option selected value="fonctionne">Fonctionne</option>
                            <option value="casse">Cassé</option>
                            <option value="perdu">Perdu</option>
                        </select>
                    </div>
                </div>
            </div>
            </form>
    </div>
    </div>
            </div>
        </div>
    </div>
<?php require('footer.php'); ?>