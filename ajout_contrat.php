
<?php extract($_POST);
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$req1="SELECT * FROM `produit`";
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

    <a href="prod_select.php" id="iframe" align="lepht"> <div align="right"><button type="submit" class="btn btn-lg btn-primary" style="background-color:#0C6;"><i class="glyphicon glyphicon-th-large"></i> Consulter Les Models Séléctionnés </button></div> </a>
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
                <form action="commande_contrat.php" method="post">
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
                        <div class="col-md-5"><input type="text" name="gsm_client" class="form-control"  id="exampleInputEmail1"   autofocus required>
                        </div>
                    </div>
                <br>
                <div class="row">
                    <div class="col-md-2"><label >CIN N: </label></div>
                    <div class="col-md-4"><input type="text" name="cin_client" class="form-control"  id="exampleInputEmail1"   autofocus required>
                    </div>
                    <div class="col-md-2"><label >Tunis,le: </label></div>
                    <div class="col-md-4"><input type="text" name="date_cin" class="form-control"  id="exampleInputEmail1"   autofocus required>
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
                        <input type="text" name="cin_ben" class="form-control" style="width: 400px;" id="exampleInputEmail1" placeholder="Entrer le cin du benefecirae"  autofocus required>
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
                    <h2><i class="glyphicon glyphicon-user"></i> Liste des models</h2>
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
                            <th class="center-text">Qte</th>
                            <th class="center-text">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = $oPDOStatement->fetch())
                        {
                            $id=$row->id;
                            $ref=$row->ref;
                            $nom=$row->nom;
                            $qte=$row->qte;


                        ?>
                        <tr>
                            <td class="center-text"><?php echo $ref ?></td>
                            <td class="center-text"><?php echo $nom ?></td>
                            <td class="center-text"><?php echo $qte ?></td>
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
            </div>
        </div>
    </div>
</div>

<a href="commande_contrat.php" id="iframe" align="lepht"> <div align="lepht"><button type="submit"  class="btn btn-lg btn-primary" style="background-color:#0C6;"><i class="glyphicon glyphicon-shopping-cart"></i> Enregitrer la contrat </button></div> </a>
</form>
<?php require('footer.php'); ?>