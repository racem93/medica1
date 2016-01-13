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
                        <form role="form" action="ajout_lit.php" method="post">
                            <div class="form-group">
                                <label>Type de produit</label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
                                </label>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require('footer.php'); ?>